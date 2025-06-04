<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendCustomizationController extends Controller
{
    public function general()
    {
        // Load general settings for frontend customization
        return view('admin.frontend.general');
    }

    public function sidebar()
    {
        // Load sidebar settings
        return view('admin.frontend.sidebar');
    }

    public function social()
    {
        // Load social section settings
        return view('admin.frontend.social');
    }

    public function footer()
    {
        // Load footer section settings
        return view('admin.frontend.footer');
    }

    public function contact()
    {
        // Load contact section settings
        return view('admin.frontend.contact');
    }

    public function customCss()
    {
        // Load custom CSS settings
        return view('admin.frontend.custom_css');
    }

    public function htmlEmbed()
    {
        // Load HTML embed settings
        return view('admin.frontend.html_embed');
    }

    public function update(Request $request)
    {
        // Validate and save frontend customization settings
        // Implementation depends on storage method (database or config files)
        return redirect()->back()->with('success', 'Frontend customization updated successfully.');
    }
}
