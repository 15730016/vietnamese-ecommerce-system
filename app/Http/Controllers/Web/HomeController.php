<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Voucher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', true)->orderBy('position')->get();
        $vouchers = Voucher::where('expires_at', '>', now())->get();
        $bestSellers = Product::where('status', 'active')->orderByDesc('sold_count')->limit(8)->get();
        $categories = Category::with('children')->get();
        $mainCategories = Category::whereNull('parent_id')->get();

        return view('home', compact('banners', 'vouchers', 'bestSellers', 'categories', 'mainCategories'));
    }
}
