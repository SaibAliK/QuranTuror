<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRequestTutorsTableForRemainingHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tutors', function (Blueprint $table) {
            $table->dropColumn('remaining_weeks');
            $table->integer("remaining_hours")->after('no_of_hours')->nullable();
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
