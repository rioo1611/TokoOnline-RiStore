<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $recentOrders = Order::with('items')->latest()->take(6)->get();
        $lowStockProducts = Product::where('stock', '<=', 10)->get();

        return view('pages.admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    public function products()
    {
        $products = Product::with(['category', 'variants'])->latest()->paginate(15);
        $categories = Category::all();

        return view('pages.admin.products', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'concentration' => 'required|string',
            'gender' => 'required|in:men,women,unisex',
            'top_notes' => 'nullable|string',
            'middle_notes' => 'nullable|string',
            'base_notes' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(100, 999),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'stock' => $request->stock,
            'concentration' => $request->concentration,
            'gender' => $request->gender,
            'top_notes' => $request->top_notes,
            'middle_notes' => $request->middle_notes,
            'base_notes' => $request->base_notes,
            'description' => $request->description,
            'image' => 'images/product-glitch.png',
            'is_sold_out' => $request->stock <= 0,
        ]);

        return redirect()->back()->with('success', 'Produk parfum baru berhasil ditambahkan!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'tracking_number' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        if ($request->filled('tracking_number')) {
            $order->tracking_number = $request->tracking_number;
        }
        if ($request->status === 'completed' || $request->status === 'shipped') {
            $order->payment_status = 'paid';
        }
        $order->save();

        return redirect()->back()->with('success', "Status pesanan #{$order->order_number} berhasil diperbarui.");
    }
}

