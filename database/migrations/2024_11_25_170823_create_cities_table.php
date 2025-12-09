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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->string('name_en', 45);
            $table->string('name_si', 45);
            $table->string('name_ta', 45);
            $table->string('sub_name_en', 45);
            $table->string('sub-name_si', 45);
            $table->string('sub_name_ta', 45);
            $table->string('post_code', 45);
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
