<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSales = FlashSale::paginate(15);
        return view('admin.flashsales.index', compact('flashSales'));
    }

    public function create()
    {
        return view('admin.flashsales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        FlashSale::create($request->all());

        return redirect()->route('admin.flashsales.index')->with('success', 'Flash sale created successfully.');
    }

    public function edit(FlashSale $flashSale)
    {
        return view('admin.flashsales.edit', compact('flashSale'));
    }

    public function update(Request $request, FlashSale $flashSale)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        $flashSale->update($request->all());

        return redirect()->route('admin.flashsales.index')->with('success', 'Flash sale updated successfully.');
    }

    public function destroy(FlashSale $flashSale)
    {
        $flashSale->delete();

        return redirect()->route('admin.flashsales.index')->with('success', 'Flash sale deleted successfully.');
    }
}
