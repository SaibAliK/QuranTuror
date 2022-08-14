<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionsTableForNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('tutor_id')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->string('percentage');
            $table->enum('type',['1','2'])
                ->default('1')
                ->comment('1 For Onetime , 2 For Package');
            $table->enum('status',['1','2'])
                ->default('1')
                ->comment("1 For Captured , 2 For Refunded.");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
