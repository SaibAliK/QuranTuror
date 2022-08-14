<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRequestTutorsTableForDropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tutors', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('active_date');
            $table->dropColumn('slot');
            $table->dropColumn('interval');
            $table->dropColumn('status');
            $table->dropColumn('class_status');
            $table->dropColumn('is_subscribed_payment');
            $table->dropColumn('payment_status');
            $table->dropColumn('amount');
            $table->dropColumn('amount_reserved');
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
