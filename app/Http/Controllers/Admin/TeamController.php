<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // Load team members list
        return view('admin.teams.index');
    }

    public function create()
    {
        // Show form to create a new team member
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'required|string|in:facebook,twitter,linkedin,instagram',
            'social_links.*.url' => 'required|url',
            'order' => 'nullable|integer',
        ]);

        // Save team member logic here

        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully.');
    }

    public function edit($id)
    {
        // Load team member for editing
        return view('admin.teams.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'required|string|in:facebook,twitter,linkedin,instagram',
            'social_links.*.url' => 'required|url',
            'order' => 'nullable|integer',
        ]);

        // Update team member logic here

        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy($id)
    {
        // Delete team member logic here

        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.order' => 'required|integer',
        ]);

        // Update team members order logic here

        return response()->json(['message' => 'Order updated successfully']);
    }
}
