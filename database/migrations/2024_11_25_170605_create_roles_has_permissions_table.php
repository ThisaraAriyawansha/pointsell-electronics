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
        Schema::create('roles_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roles_id')->nullable()->constrained('roles');
            $table->foreignId('permissions_id')->nullable()->constrained('permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_has_permissions');
    }
};
