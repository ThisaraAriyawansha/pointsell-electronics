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
        Schema::create('hold_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->foreignId('items_id')->nullable()->constrained('items');
            $table->foreignId('hold_orders_id')->nullable()->constrained('hold_orders');
            $table->integer('quantity');
            $table->enum('discount_type', ['FIXED', 'PERCENTAGE'])->default('FIXED');
            $table->decimal('discount', 10 , 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hold_order_items');
    }
};
