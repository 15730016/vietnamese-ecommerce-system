<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function index()
    {
        // Load multimedia items
        return view('admin.multimedia.index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240', // max 10MB
        ]);

        // Handle file upload logic here

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function destroy($id)
    {
        // Delete multimedia item logic here

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
