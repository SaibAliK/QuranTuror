<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMeetingSessionsTableForScheduleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_sessions', function (Blueprint $table) {
            $table->foreignId('schedule_id')->after('request_tutor_id')->nullable()->references('id')->on('schedules')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_sessions', function (Blueprint $table) {
            //
        });
    }
}
