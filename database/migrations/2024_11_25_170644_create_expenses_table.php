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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_title', 225);
            $table->longText('details');
            $table->date('expense_date');
            $table->decimal('amount');
            $table->foreignId('expense_categories_id')->nullable()->constrained('expense_categories');
            $table->foreignId('branch_id')->nullable()->constrained('branch_id');
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
