<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_percentages', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['1','2','3'])
                ->default('1')
                ->comment("1 For Basic , 2 For Profession ,3 For Ultimate");
            $table->string('percentage')->nullable();
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
        Schema::dropIfExists('package_percentages');
    }
}
