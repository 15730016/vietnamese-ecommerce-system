<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Load settings from config or database
        $settings = [
            'auth' => [
                'zalo' => config('services.zalo'),
                'sms' => config('services.sms'),
                'social' => [
                    'facebook' => config('services.facebook'),
                    'google' => config('services.google'),
                ],
                'google_captcha' => config('services.google_captcha'),
            ],
            'smtp' => config('mail'),
            'invoice' => config('invoice'),
            'currency' => config('currency'),
            'payment_gateway' => config('payment_gateway'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate and update settings
        // This is a placeholder, actual implementation depends on how settings are stored (e.g., database or config files)
        // For example, you might save settings to a database table or write to config files

        // Example validation
        $request->validate([
            'auth.zalo.app_id' => 'nullable|string',
            'auth.zalo.app_secret' => 'nullable|string',
            'auth.sms.api_key' => 'nullable|string',
            'auth.social.facebook.client_id' => 'nullable|string',
            'auth.social.facebook.client_secret' => 'nullable|string',
            'auth.social.google.client_id' => 'nullable|string',
            'auth.social.google.client_secret' => 'nullable|string',
            'auth.google_captcha.site_key' => 'nullable|string',
            'auth.google_captcha.secret_key' => 'nullable|string',
            'smtp.mail_host' => 'nullable|string',
            'smtp.mail_port' => 'nullable|integer',
            'smtp.mail_username' => 'nullable|string',
            'smtp.mail_password' => 'nullable|string',
            'smtp.mail_encryption' => 'nullable|string',
            'invoice.prefix' => 'nullable|string',
            'invoice.next_number' => 'nullable|integer',
            'currency.code' => 'nullable|string',
            'currency.symbol' => 'nullable|string',
            'payment_gateway.vnpay' => 'nullable|array',
            'payment_gateway.momo' => 'nullable|array',
            'payment_gateway.bank_transfer.bank_name' => 'nullable|string',
            'payment_gateway.bank_transfer.bank_branch' => 'nullable|string',
            'payment_gateway.bank_transfer.bank_account_number' => 'nullable|string',
            'payment_gateway.bank_transfer.bank_account_name' => 'nullable|string',
        ]);

        // Save settings logic here...

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
