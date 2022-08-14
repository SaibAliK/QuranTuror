<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingSession;
use App\Models\RequestTutor;
use App\Models\TutorProfile;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\TutorPayout;
use Carbon\Carbon;
use Session;
use Zoom;
use Mail;

class ZoomController extends Controller
{
    public function startSession($id = null)
    {
        $class_plan = Schedule::find($id);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $session_id = substr(str_shuffle($permitted_chars), 0, 32);
        
        try {
            $user = Zoom::user()->first();
            $meeting = Zoom::meeting()->make([
                'userId' => auth()->user()->id,
                'topic' => 'Online Class',
                'type' => 2,
                'disable_recording' => false,
                'duration' => 1,
                'timezone' => 'Pakistan',
                'password' => '1234567890',
                'agenda' => 'Tutor arrange online class for student',
            ]);

            $meeting = $user->meetings()->save($meeting);

            $check_meeting_session=MeetingSession::where("schedule_id",$class_plan->id)
            ->count();
            if($check_meeting_session>0)
            {
                $meeting_session=MeetingSession::where("schedule_id",$class_plan->id)
                ->first();
            }else
            {
                $meeting_session = MeetingSession::create([
                    'session_id' => $session_id,
                    'zoom_id' => $meeting->id,
                    'start_url' => $meeting->start_url,
                    'join_url' => $meeting->join_url,
                    'tutor_id' => $class_plan->tutor_id,
                    'student_id' => $class_plan->student_id,
                    'request_tutor_id' => $class_plan->request_tutor_id,
                    'schedule_id' => $class_plan->id,
                    'status' => '1',
                ]);
            }
            Mail::send('email.student.join_session', get_defined_vars(), function ($message) use($class_plan) {
                $message->to($class_plan->student->email, $class_plan->student->FullName);
                $message->subject('Join Session');
            });

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error','Something Went Wrong, Try Again!');
        }

        return redirect()->to($meeting->start_url);
    }

    public function zoomCallback(Request $req)
    {
        $id = $req['payload']['object']['id'];

        $m_ses = MeetingSession::where('zoom_id', $id)->where('status','1')->first();

        $now = Carbon::now();
        $created_at = Carbon::parse($m_ses->created_at);
        $time_taken = $created_at->diffInMinutes($now);

        $m_ses->time_taken = $time_taken;
        $m_ses->ended_at = Carbon::now();
        $m_ses->status = "2";
        $m_ses->save();
        
        $schedule = $m_ses->schedule;
        $schedule->class_status = "completed";
        $schedule->save();
        dd("dd");
        $tutor_profile = TutorProfile::where('user_id',$m_ses->tutor_id)->first();
        $tutor_payout = TutorPayout::where('meeting_session_id',$m_ses->id)->first();

        /*if($tutor_payout)
        {
            dd("dddd");
            $tutor_payout->tutor_id = $m_ses->tutor_id;
            $tutor_payout->student_id = $m_ses->student_id;
            $tutor_payout->hourly_rate += $tutor_profile->hourly_rate;
            $tutor_payout->save();
        }
        else
        {
            dd("dd");
            $tutor_payout = TutorPayout::create([
                'tutor_id' => $m_ses->tutor_id,
                'student_id' => $m_ses->student_id,
                'meeting_session_id' => $m_ses->id,
                'total_earning' => $tutor_profile->hourly_rate,
                'status' => 'unpaid',
            ]);
        }*/
    }

    public function zoomJoined(Request $req)
    {
        $id = $req['payload']['object']['id'];
        $m_ses = MeetingSession::where('zoom_id', $id)->where('status','1')->first();
        $m_ses->student_joined = "1";
        $m_ses->save();
    }
}
