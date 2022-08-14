<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorRecieptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_reciepts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->string("file");
            $table->float("amount");
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
        Schema::dropIfExists('tutor_reciepts');
    }
}
