<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@haxuvina.com'],
            [
                'name' => 'Admin Demo',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
