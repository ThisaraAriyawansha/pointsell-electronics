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
        Schema::create('hold_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->nullable()->constrained('customers');
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->string('hold_reference', 255);
            $table->string('hold_status', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hold_orders');
    }
};
