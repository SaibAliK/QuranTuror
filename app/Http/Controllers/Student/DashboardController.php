<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestTutor;
use App\Models\User;
use App\Models\Schedule;
use App\Models\MeetingSession;
use App\Models\StudentProfile;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $attended_count=auth()->user()
        ->student_schedules
        ->where('class_status','completed')
        ->count();
        $upcoming_count=auth()->user()
        ->student_schedules
        ->where('class_status','pending')
        ->count();
        $time_count=auth()->user()
        ->student_schedules
        ->where('class_status','completed')
        ->count();
        $amount_count=RequestTutor::where('student_id',auth()->user()->id)
        ->where('status','approved')
        ->sum('amount_paid');
        $events=Schedule::where('student_id',auth()->user()->id)
        ->where('class_status','pending')
        ->get();

        return view('student.dashboard',get_defined_vars());
    }
    
    public function session()
    {
        $session = MeetingSession::where('student_id',auth()->user()->id)
            ->get();
        return view('student.session.session',get_defined_vars());
    }

    public function checkSessionStart(Request $req)
    {
        $session['started'] = false;

        $ses = MeetingSession::where('schedule_id',$req->id)->where('status',"1")->first();
        if ($ses) {
            $session['started'] = true;
            $session['join_url'] = $ses->join_url;
            $session['tutor'] = $ses->tutor->name;
        }

        return response()->json($session);
    }
}
