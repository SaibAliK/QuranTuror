<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestTutor;
use App\Models\Schedule;
use App\Models\MeetingSession;
use App\Models\TutorPayout;
use Auth;
use App\Models\TutorProfile;

class DashboardController extends Controller
{
    public function index()
    {
    	$attended_count=auth()->user()
    		->tutor_schedules
    		->where('class_status','completed')
    		->count();
    	$upcoming_count=auth()->user()
    		->tutor_schedules
    		->where('class_status','pending')
    		->count();
		$time_count=auth()->user()
    		->tutor_schedules
    		->where('class_status','completed')
    		->count();
        $amount_count=RequestTutor::where('tutor_id',auth()->user()->id)
            ->where('status','approved')
            ->sum('amount_paid');
    	$events=Schedule::where('tutor_id',auth()->user()->id)
                ->where('class_status','pending')
                ->get();
        return view('tutor.dashboard',get_defined_vars());
    }

    public function session()
    {
        $session = MeetingSession::where('tutor_id',auth()->user()->id)
            ->get();
        return view('tutor.session.session',get_defined_vars());
    }

    public function payout()
    {
        $user = auth()->user();
        $tutor_payouts = TutorPayout::where('tutor_id',$user->id)->get();
        return view('tutor.session.payout' , get_defined_vars());
    }

    public function checkSessionStatus(Request $req)
    {
        $count = MeetingSession::where('schedule_id',$req->id)->where('status',"2")->count();
        if ($count>0) {
            $session['started'] = false;
            $session['title'] = "Meeting Ended!";
            $session['msg'] = "You have attended this meeting";
        }else
        {
            $session['started'] = true;
        }

        return response()->json($session);
    }
}
