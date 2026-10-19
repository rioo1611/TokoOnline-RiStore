<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = $this->calculateSubtotal($cart);
        $freeShippingThreshold = 500000;
        $progressToFreeShipping = min(100, round(($subtotal / $freeShippingThreshold) * 100));
        $remainingForFreeShipping = max(0, $freeShippingThreshold - $subtotal);

        return view('pages.cart.index', compact('cart', 'subtotal', 'progressToFreeShipping', 'remainingForFreeShipping'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);
        $variant = null;
        $variantSize = '50ml';
        $price = $product->price;

        if ($request->filled('variant_id')) {
            $variant = ProductVariant::find($request->variant_id);
            if ($variant) {
                $variantSize = $variant->size;
                $price = $variant->price;
            }
        } elseif ($product->variants()->exists()) {
            $variant = $product->variants()->first();
            $variantSize = $variant->size;
            $price = $variant->price;
        }

        $cartKey = $product->id . '_' . $variantSize;
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'key' => $cartKey,
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'variant_size' => $variantSize,
                'price' => (float) $price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} ({$variantSize}) berhasil ditambahkan ke keranjang!",
                'cart_count' => $this->getCartCount(),
                'cart_subtotal' => 'Rp ' . number_format($this->calculateSubtotal($cart), 0, ',', '.'),
                'cart' => $cart,
            ]);
        }

        return redirect()->back()->with('success', "{$product->name} ({$variantSize}) berhasil ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => $this->getCartCount(),
                'cart_subtotal' => 'Rp ' . number_format($this->calculateSubtotal($cart), 0, ',', '.'),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk dihapus dari keranjang.',
                'cart_count' => $this->getCartCount(),
                'cart_subtotal' => 'Rp ' . number_format($this->calculateSubtotal($cart), 0, ',', '.'),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang telah dikosongkan.');
    }

    public function getSummary()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'items' => array_values($cart),
            'count' => $this->getCartCount(),
            'subtotal' => $this->calculateSubtotal($cart),
            'formatted_subtotal' => 'Rp ' . number_format($this->calculateSubtotal($cart), 0, ',', '.'),
        ]);
    }

    private function calculateSubtotal(array $cart): float
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }
        return $subtotal;
    }

    private function getCartCount(): int
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}

