<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;

class DynamicPageController extends Controller
{
    public function show($slug)
    {
        return DynamicPage::where('slug', $slug)->firstOrFail();
    }
}
