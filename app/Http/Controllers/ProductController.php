<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Product::where('is_active', true);
        $totalProductsCount = (clone $baseQuery)->count();

        // Calculate DB min and max price for the budget slider
        $minPriceInDb = (int) ((clone $baseQuery)->min('price') ?? 0);
        $maxPriceInDb = (int) ((clone $baseQuery)->max('price') ?? 1000000);

        // Availability counts in current context
        $inStockCount = (clone $baseQuery)->where('stock', '>', 0)->where('is_sold_out', false)->count();
        $outOfStockCount = (clone $baseQuery)->where(function($q) {
            $q->where('stock', '<=', 0)->orWhere('is_sold_out', true);
        })->count();

        $query = (clone $baseQuery)->with(['category', 'variants']);

        // 1. Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 2. Filter by Availability (Tersedianya)
        $selectedAvailability = (array) $request->input('availability', []);
        if (!empty($selectedAvailability)) {
            $hasInStock = in_array('tersedia', $selectedAvailability);
            $hasOutOfStock = in_array('stok_habis', $selectedAvailability);

            if ($hasInStock && !$hasOutOfStock) {
                $query->where('stock', '>', 0)->where('is_sold_out', false);
            } elseif ($hasOutOfStock && !$hasInStock) {
                $query->where(function($q) {
                    $q->where('stock', '<=', 0)->orWhere('is_sold_out', true);
                });
            }
        }

        // 3. Filter by Budget / Price Range (Harga)
        $currentMinPrice = $request->filled('min_price') ? (float) $request->min_price : 0;
        $currentMaxPrice = $request->filled('max_price') ? (float) $request->max_price : $maxPriceInDb;

        if ($request->filled('min_price') && (float)$request->min_price > 0) {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // 4. Filter by Gender
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // 5. Filter by Scent Family
        if ($request->filled('family') && $request->family !== 'all') {
            $query->where('scent_family', 'like', '%' . $request->family . '%');
        }

        // 6. Search Keyword
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

        // 7. Sorting (Urutkan Berdasarkan)
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'az':
                $query->orderBy('name', 'asc');
                break;
            case 'za':
                $query->orderBy('name', 'desc');
                break;
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
            case 'bestseller':
                $query->orderBy('is_bestseller', 'desc');
                break;
            case 'popular':
            default:
                $query->orderBy('is_popular', 'desc')->orderBy('rating', 'desc');
                break;
        }

        $filteredCount = (clone $query)->count();
        $products = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('sort_order')->get();

        return view('pages.products.index', compact(
            'products',
            'categories',
            'totalProductsCount',
            'filteredCount',
            'minPriceInDb',
            'maxPriceInDb',
            'currentMinPrice',
            'currentMaxPrice',
            'inStockCount',
            'outOfStockCount',
            'selectedAvailability',
            'sort'
        ));
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

