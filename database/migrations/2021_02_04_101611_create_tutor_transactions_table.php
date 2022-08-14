<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_transactions', function (Blueprint $table) {
            $table->id();
            $table->text('stripe_id');
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->references('id')->on('packages')->constrained()->onDelete('cascade');
            $table->double("amount");
            $table->enum('status',['1','2'])
                ->default('1')
                ->comment("1 For Captured , 2 For Refunded.");
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
        Schema::dropIfExists('tutor_transactions');
    }
}
