<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('images', 'reviews')->where('slug', $slug)->firstOrFail();

        return view('product', compact('product'));
    }
}
