<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReviewsTableForTutorIdAndStudentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `reviews` CHANGE `meeting_session_id` `meeting_session_id` BIGINT(20) UNSIGNED NULL");
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('users')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
}
