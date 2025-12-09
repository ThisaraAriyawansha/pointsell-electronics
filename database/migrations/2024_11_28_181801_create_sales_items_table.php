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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('items_id')->nullable()->constrained('items')->onDelete('cascade');
            $table->foreignId('sales_id')->nullable()->constrained('sales')->onDelete('cascade');
            $table->integer('quantity');
            $table->enum('discount_type', ['FIXED', 'PERCENTAGE'])->default('FIXED');
            $table->decimal('discount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
