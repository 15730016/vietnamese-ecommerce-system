<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    public function index()
    {
        // Load dynamic pages list
        return view('admin.dynamic_pages.index');
    }

    public function create()
    {
        // Show form to create a new dynamic page
        return view('admin.dynamic_pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:dynamic_pages,slug',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        // Save dynamic page logic here

        return redirect()->route('admin.dynamic_pages.index')->with('success', 'Dynamic page created successfully.');
    }

    public function edit($id)
    {
        // Load dynamic page for editing
        return view('admin.dynamic_pages.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:dynamic_pages,slug,' . $id,
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        // Update dynamic page logic here

        return redirect()->route('admin.dynamic_pages.index')->with('success', 'Dynamic page updated successfully.');
    }

    public function destroy($id)
    {
        // Delete dynamic page logic here

        return redirect()->route('admin.dynamic_pages.index')->with('success', 'Dynamic page deleted successfully.');
    }
}
