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
        Schema::create('process_docs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 7, 2);
            $table->string('url');
            $table->boolean('status')->default(true);

            //FK
            $table->unsignedBigInteger('process_id')->unsigned()->nullable();
            $table->foreign('process_id')->references('id')->on('processes');

            $table->unsignedBigInteger('type_docs_id')->unsigned()->nullable();
            $table->foreign('type_docs_id')->references('id')->on('type_docs');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_docs');
    }
};
