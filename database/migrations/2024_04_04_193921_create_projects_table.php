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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->date('start_date');
            $table->date('due_date');
            $table->decimal('total_value', 8, 2);
            $table->boolean('status')->default(true);

            //FK
            $table->unsignedBigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->unsignedBigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

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
        Schema::dropIfExists('projects');
    }
};
