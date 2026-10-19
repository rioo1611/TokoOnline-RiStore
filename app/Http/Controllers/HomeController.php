<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Featured Sunforged Products
        $sunforgedProducts = Product::whereHas('category', function ($q) {
            $q->where('slug', 'sunforged-collection');
        })->where('is_active', true)->get();

        // 2. Popular & Best Seller Products (for "Penjualan! Paling Populer" section)
        $popularProducts = Product::where('is_popular', true)
            ->where('is_active', true)
            ->with('variants')
            ->take(8)
            ->get();

        $saleProducts = Product::whereNotNull('discount_percent')
            ->where('is_active', true)
            ->with('variants')
            ->take(8)
            ->get();

        // 3. Women Category Products (for "Untuknya" section)
        $womenProducts = Product::where('gender', 'women')
            ->orWhere('category_id', function ($q) {
                $q->select('id')->from('categories')->where('slug', 'untuk-wanita')->limit(1);
            })
            ->where('is_active', true)
            ->take(6)
            ->get();

        // 4. Categories for navigation and grid
        $categories = Category::orderBy('sort_order')->get();

        // 5. Verified Customer Reviews
        $latestReviews = Review::with('product')
            ->where('is_verified_buyer', true)
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact(
            'sunforgedProducts',
            'popularProducts',
            'saleProducts',
            'womenProducts',
            'categories',
            'latestReviews'
        ));
    }
}
