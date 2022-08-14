<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRequestTutorsTableForModifyStatusField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tutors', function (Blueprint $table) {
            $table->enum('status',['pending',
                    'cancelled',
                    'approved',
                    'active'])->default('pending');
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
