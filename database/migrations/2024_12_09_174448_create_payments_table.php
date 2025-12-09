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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_id')->nullable()->constrained('sales')->onDelete('cascade');
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('sub_total', 14, 2)->default(0);
            $table->decimal('grand_total', 14, 2)->default(0);
            $table->decimal('paid_amount', 14, 2);
            $table->decimal('due_amount', 14, 2);
            $table->enum('discount_type', ['FIXED', 'PERCENTAGE'])->default('FIXED');
            $table->string('cheque_no', 255)->nullable();
            $table->date('cheque_date')->nullable();
            $table->decimal('discount', 14, 2)->default(0);
            $table->enum('payment_type', ['CASH', 'CARD', 'CHEQUE', 'CREDIT'])->default('CASH');
            $table->enum('payment_status', ['PAID', 'DUE', 'HOLD'])->default('DUE');
            $table->longText('sales_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['discount', 'grand_total']);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('due_amount');
        });
    }
};
