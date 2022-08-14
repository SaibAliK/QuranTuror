<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTutorTransactionsTableForPaypal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_transactions', function (Blueprint $table) {
            $table->string('paypal_id')->nullable();
            $table->enum("payment_method",['1','2'])
                ->comment('1 For Stripe , 2 For PayPal');
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
