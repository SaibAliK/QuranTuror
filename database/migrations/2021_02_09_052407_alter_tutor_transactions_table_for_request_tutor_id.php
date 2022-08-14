<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTutorTransactionsTableForRequestTutorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_transactions', function (Blueprint $table) {
            $table->foreignId('request_tutor_id')->nullable()->references('id')->on('request_tutors')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_transactions', function (Blueprint $table) {
            //
        });
    }
}
