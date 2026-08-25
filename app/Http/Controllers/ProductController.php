<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = Product::all();

        return view('frontend.pages.products', compact('products'));
    }

    /**
     * Display a specific product detail page.
     */
    public function show(string $slug)
    {
        $product = Product::findBySlug($slug);

        if (!$product) {
            $product = Product::where('slug', $slug)->firstOrFail();
        }

        return view('frontend.pages.product-detail', compact('product'));
    }
}
