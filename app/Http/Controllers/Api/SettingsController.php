<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontendSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return FrontendSetting::all()->pluck('value', 'key')->toArray();
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            FrontendSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return response()->json(['message' => 'Settings updated successfully.']);
    }
}
