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
        Schema::create('employees', function (Blueprint $table) {
            // Esto creará un campo 'user_id' que será la clave primaria
            $table->unsignedBigInteger('user_id')->primary();
            // Esto establecerá 'user_id' como clave foránea que hace referencia al 'id' en la tabla 'users'
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
