<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTutorTransactionsTableForStatusAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_transactions', function (Blueprint $table) {
            $table->enum('status',['0','1'])
                ->comment("0 For Pending , 1 For Recieved")
                ->default('0');
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
