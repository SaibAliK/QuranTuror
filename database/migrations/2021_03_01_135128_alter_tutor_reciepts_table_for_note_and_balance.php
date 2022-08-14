<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTutorRecieptsTableForNoteAndBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_reciepts', function (Blueprint $table) {
            $table->string('balance')->nullable();
            $table->string("note")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_reciepts', function (Blueprint $table) {
            //
        });
    }
}
