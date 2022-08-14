<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPackagesTableForTutorRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            
            $table->foreignId('tutor_id')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->enum('type',['1','2','3'])
                ->default('1')
                ->comment("1 For Basic , 2 For Profession ,3 For Ultimate");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
