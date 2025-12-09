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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 255);
            $table->string('contact_number', 45);
            $table->longText('address');
            $table->foreignId('cities_id')->nullable()->constrained('cities');
            $table->foreignId('status_id')->nullable()->constrained('statuses');
            $table->foreignId('user_id')->nullable()->constrained('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
