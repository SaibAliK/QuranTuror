<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRequestTutorsTableForAcceptStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tutors', function (Blueprint $table) {
            $table->enum('accept_status',['0','1','2'])
                ->comment('0 For intermediate , 1 For Accepted , 2 For Declined')
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
        Schema::table('request_tutors', function (Blueprint $table) {
            //
        });
    }
}
