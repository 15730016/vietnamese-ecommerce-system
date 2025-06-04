<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;

class DynamicPageController extends Controller
{
    public function show($slug)
    {
        $page = DynamicPage::where('slug', $slug)->firstOrFail();
        return view('web.dynamic_page.show', compact('page'));
    }
}
