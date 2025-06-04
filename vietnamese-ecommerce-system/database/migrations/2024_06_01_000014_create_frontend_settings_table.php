<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('frontend_settings', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('key');
            $table->json('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();

            $table->unique(['section', 'key']);
        });

        // Insert default settings
        DB::table('frontend_settings')->insert([
            // General Section
            [
                'section' => 'general',
                'key' => 'site_name',
                'value' => json_encode('Vietnamese E-commerce'),
                'type' => 'text',
            ],
            [
                'section' => 'general',
                'key' => 'site_logo',
                'value' => json_encode(''),
                'type' => 'image',
            ],
            // Social Section
            [
                'section' => 'social',
                'key' => 'facebook',
                'value' => json_encode(''),
                'type' => 'url',
            ],
            [
                'section' => 'social',
                'key' => 'twitter',
                'value' => json_encode(''),
                'type' => 'url',
            ],
            // Footer Section
            [
                'section' => 'footer',
                'key' => 'copyright_text',
                'value' => json_encode('© 2024 Vietnamese E-commerce. All rights reserved.'),
                'type' => 'text',
            ],
            // Contact Section
            [
                'section' => 'contact',
                'key' => 'email',
                'value' => json_encode('contact@example.com'),
                'type' => 'email',
            ],
            [
                'section' => 'contact',
                'key' => 'phone',
                'value' => json_encode('+84 123 456 789'),
                'type' => 'text',
            ],
            // Custom CSS
            [
                'section' => 'custom_css',
                'key' => 'css',
                'value' => json_encode(''),
                'type' => 'textarea',
            ],
            // HTML Embed
            [
                'section' => 'html_embed',
                'key' => 'html',
                'value' => json_encode(''),
                'type' => 'textarea',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('frontend_settings');
    }
};
