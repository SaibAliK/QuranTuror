<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tutors', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable();
            $table->string('date');
            $table->string('active_date')->nullable();
            $table->string('slot')->nullable();
            $table->enum('interval', ['1', '2'])->default(1)->comment("1. One Time 2. Recurring");
            $table->integer('no_of_weeks')->nullable();
            $table->integer('remaining_weeks')->nullable();

            $table->foreignId('student_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'cancelled', 'approved', 'active'])->default('pending');
            $table->enum('class_status', ['pending', 'completed', 'cancelled'])->nullable();

            $table->boolean('is_subscribed_payment')->default(0);
            $table->boolean('payment_status')->default(0);
            $table->float('amount')->default(0);
            $table->float('amount_paid')->default(0);
            $table->float('amount_reserved')->default(0);
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
        Schema::dropIfExists('request_tutors');
    }
}
