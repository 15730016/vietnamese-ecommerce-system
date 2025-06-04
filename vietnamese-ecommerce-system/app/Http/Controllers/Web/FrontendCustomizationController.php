<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FrontendSetting;

class FrontendCustomizationController extends Controller
{
    public function index()
    {
        // Load frontend customization settings for home page display
        $settings = FrontendSetting::all()->pluck('value', 'key')->toArray();

        return view('web.frontend_customization.index', compact('settings'));
    }
}
