<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Load menu items
        return view('admin.menu.index');
    }

    public function create()
    {
        // Show form to create menu item
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        // Validate and store menu item
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        // Save menu item logic here

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    public function edit($id)
    {
        // Load menu item for editing
        return view('admin.menu.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update menu item
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        // Update menu item logic here

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy($id)
    {
        // Delete menu item logic here

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
