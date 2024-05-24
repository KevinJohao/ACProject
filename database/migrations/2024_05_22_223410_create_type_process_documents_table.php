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
        Schema::create('type_process_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_process_id')->unsigned()->nullable();
            $table->foreign('type_process_id')->references('id')->on('type_processes');

            $table->unsignedBigInteger('type_document_id')->unsigned()->nullable();
            $table->foreign('type_document_id')->references('id')->on('type_docs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_process_documents');
    }
};
