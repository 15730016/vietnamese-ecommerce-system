<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FrontendSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = FrontendSetting::all()->pluck('value', 'key')->toArray();
        return view('web.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            FrontendSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
