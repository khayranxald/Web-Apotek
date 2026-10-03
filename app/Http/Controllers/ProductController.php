<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('category')
            ->active()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('search') . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->input('category'));
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::query()
            ->with('category')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}