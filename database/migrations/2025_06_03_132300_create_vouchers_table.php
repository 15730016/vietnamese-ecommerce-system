<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('vouchers', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->string('description')->nullable();
        $table->decimal('discount_amount', 12, 2)->default(0);
        $table->decimal('min_order_amount', 12, 2)->default(0);
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->integer('usage_limit')->nullable();
        $table->integer('used_count')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
