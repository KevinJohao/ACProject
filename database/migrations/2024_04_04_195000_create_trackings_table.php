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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->text('observation');
            $table->boolean('status')->default(true);

            //FK
            $table->unsignedBigInteger('activity_id')->unsigned()->nullable();
            $table->foreign('activity_id')->references('id')->on('activities');

            $table->unsignedBigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('user_id')->on('employees');

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
        Schema::dropIfExists('trackings');
    }
};
