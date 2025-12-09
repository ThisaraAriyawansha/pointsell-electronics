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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code', 5)->unique();
            $table->string('item_name', 225);
            $table->foreignId('suppliers_id')->nullable()->constrained('suppliers');
            $table->integer('quantity');
            $table->integer('minimum_qty')->nullable();
            $table->decimal('purchase_price');
            $table->decimal('retail_price');
            $table->decimal('wholesale_price');
            $table->string('image_path')->nullable()->default('default.png'); // Default image
            $table->foreignId('status_id')->nullable()->constrained('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
