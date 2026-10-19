<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        // Free shipping if subtotal >= 500.000, else 20.000
        $shippingCost = $subtotal >= 500000 ? 0 : 20000;
        $total = $subtotal + $shippingCost;

        return view('pages.checkout.index', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'courier' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $shippingCost = $subtotal >= 500000 ? 0 : 20000;
        $discount = 0;

        // Check if promo code is applied
        if ($request->filled('voucher_code')) {
            $code = strtoupper(trim($request->voucher_code));
            if ($code === 'MYKONOSVIP') {
                $discount = min(50000, $subtotal * 0.1); // 10% up to 50k
            } elseif ($code === 'FREEONGKIR') {
                $discount = $shippingCost;
            }
        }

        $total = $subtotal + $shippingCost - $discount;
        $orderNumber = 'MYK-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'courier' => $request->courier,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'status' => 'processing',
            'notes' => $request->notes,
        ]);

        // Insert items and adjust stock
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'variant_size' => $item['variant_size'],
                'product_image' => $item['image'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Deduct stock
            $product = Product::find($item['product_id']);
            if ($product && $product->stock >= $item['quantity']) {
                $product->decrement('stock', $item['quantity']);
                if ($product->stock <= 0) {
                    $product->update(['is_sold_out' => true]);
                }
            }
        }

        // Clear session cart
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success($order_number)
    {
        $order = Order::where('order_number', $order_number)
            ->with('items.product')
            ->firstOrFail();

        // Build WhatsApp message link
        $waPhone = '6281234567890'; // Official Mykonos CS WhatsApp
        $message = "Halo Official Mykonos, saya ingin konfirmasi pesanan dengan nomor order: *{$order->order_number}* atas nama *{$order->customer_name}* senilai *Rp " . number_format($order->total, 0, ',', '.') . "*. Terima kasih!";
        $waLink = "https://wa.me/{$waPhone}?text=" . urlencode($message);

        return view('pages.checkout.success', compact('order', 'waLink'));
    }
}

