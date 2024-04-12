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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('vsm');
            $table->date('next_review');
            $table->decimal('process_value', 8, 2);
            $table->boolean('status')->default(true);

            //FK
            $table->unsignedBigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->unsignedBigInteger('type_process_id')->unsigned()->nullable();
            $table->foreign('type_process_id')->references('id')->on('type_processes');

            $table->unsignedBigInteger('task_status_id')->unsigned()->nullable();
            $table->foreign('task_status_id')->references('id')->on('task_statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
