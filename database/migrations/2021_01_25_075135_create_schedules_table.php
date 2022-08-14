<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('request_tutor_id')->references('id')->on('request_tutors')->constrained()->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('active_date')->nullable();
            $table->enum('status',['pending',
                    'cancelled',
                    'approved',
                    'active'])->default('pending');
            $table->enum('class_status',['pending',
                    'completed',
                    'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
