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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sales_code', 255);
            $table->foreignId('customers_id')->nullable()->constrained('customers');
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->string('warranty_period', 255);
            $table->string('warranty_card_no', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
