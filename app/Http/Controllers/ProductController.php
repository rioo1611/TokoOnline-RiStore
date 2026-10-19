<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'variants']);

        // Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Gender
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Filter by Scent Family
        if ($request->filled('family') && $request->family !== 'all') {
            $query->where('scent_family', 'like', '%' . $request->family . '%');
        }

        // Search Keyword
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('top_notes', 'like', "%{$keyword}%")
                  ->orWhere('middle_notes', 'like', "%{$keyword}%")
                  ->orWhere('base_notes', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'popular':
            default:
                $query->orderBy('is_popular', 'desc')->orderBy('rating', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('sort_order')->get();
        $totalCount = Product::where('is_active', true)->count();

        return view('pages.products.index', compact('products', 'categories', 'totalCount'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'variants', 'reviews'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }

    public function quickView($id)
    {
        $product = Product::with(['category', 'variants'])->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $product->formatted_price,
            'original_price' => $product->formatted_original_price,
            'badge' => $product->badge,
            'concentration' => $product->concentration,
            'gender' => ucfirst($product->gender),
            'short_description' => $product->short_description,
            'top_notes' => $product->top_notes,
            'middle_notes' => $product->middle_notes,
            'base_notes' => $product->base_notes,
            'longevity' => $product->longevity,
            'sillage' => $product->sillage,
            'image' => asset($product->image),
            'stock' => $product->stock,
            'is_sold_out' => $product->is_sold_out,
            'variants' => $product->variants->map(function ($v) {
                return [
                    'id' => $v->id,
                    'size' => $v->size,
                    'price' => $v->price,
                    'formatted_price' => $v->formatted_price,
                    'stock' => $v->stock,
                ];
            }),
            'url' => route('products.show', $product->slug),
        ]);
    }
}

