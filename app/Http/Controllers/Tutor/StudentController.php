<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\RequestTutor;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function studentRequests()
    {
        $pending=RequestTutor::where('tutor_id',auth()->user()->id)->where('status','pending')->get();
        $approved=RequestTutor::where('tutor_id',auth()->user()->id)->where('status','approved')->get();
        $cancelled=RequestTutor::where('tutor_id',auth()->user()->id)->where('status','cancelled')->get();
        return view('tutor.student.requests',get_defined_vars());
    }

    public function requestApprove($id)
    {
        RequestTutor::where('id',$id)->update([
            'status'=>'approved'
        ]);
        $t_req=RequestTutor::where('id',$id)->first();
        Schedule::create(['tutor_id'=>$t_req->tutor_id,
            'student_id'=>$t_req->student_id,
            'request_tutor_id'=>$t_req->id,
            'date'=>$t_req->date,
            'active_date'=>$t_req->date,
            'slot'=>$t_req->slot]);
        StudentProfile::where('user_id',$t_req->student_id)
            ->update(['request_tutor_id'=>$t_req->id]);
        return back()->with('message','Student Request Approved Successfully');
    }

    public function requestCancel($id)
    {
        $tutor_request=RequestTutor::find($id);

        if($tutor_request->payment_type=='temporary')
        {
            $transaction = Transaction::where('request_tutor_id',$tutor_request->id)
                ->where('payment_type','temporary')
                ->orderBy('id', 'desc')
                ->first();
            $stripe_id = $transaction->stripe_id;
            
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $refund = \Stripe\Refund::create(['charge' => $stripe_id]);
            } catch(\Stripe\Error\InvalidRequest $e) {
                dd($e->getMessage());
            } catch(\Stripe\Error\Card $e) {
                dd($e->getMessage());
            }
        }else
        {
            $tutor_request->payment_type="temporary";

            $remaining_classes=Schedule::where('request_tutor_id',$tutor_request->id)
                ->where('class_status','pending')
                ->count();
            $student=StudentProfile::where('user_id',$tutor_request->student_id)
                ->first();

            $student->remaining_hours=$student->remaining_hours+$remaining_classes;
            $student->save();

            Schedule::where('request_tutor_id',$tutor_request->id)
                ->where('class_status','pending')
                ->delete();
        }
        $tutor_request->status = "cancelled";
        $tutor_request->save();
        return back()->with('message','Student Request Cancelled Successfully');
    }

    public function students()
    {
        $list=RequestTutor::where('payment_type','permanent')
            ->get();
        return view('tutor.student.students',get_defined_vars());

    }

    public function loadTutorIntervals(Request $req)
    {
        $tutor = auth()->user();

        $tutor_req = Schedule::where('tutor_id',$req->id)
            ->where('date',$req->day)
            ->where('class_status', 'pending')
            ->pluck('slot')->toArray();
        // dd($tutor_req);
        $day = Carbon::parse($req->day)->format("l");
        // dd($day);
        $time_table = $tutor->time_tables->where('day',$day)->first();
        if(is_null($time_table))
        {
            return response()->json(['',401]);
        }
        // dd($time_table);
        $tutorStartTime = strtotime($time_table->from);
        $tutorEndTime = strtotime($time_table->to);

        $tutor_time_zone = array();

        for ($i = $tutorStartTime; $i < $tutorEndTime; $i+=3600) {
            $tutor_time_zone[] = date("h:ia", $i);
        }
        $available = array_diff($tutor_time_zone, $tutor_req);

        if (count($available) > 0) {
            return [view('ajax.tutor.load_tutor_time_intervals', get_defined_vars())->render(), 200];
        } else {
            return [view('ajax.tutor.load_tutor_time_intervals', get_defined_vars())->render(), 401];
        }
    }

    public function saveSchedule(Request $req)
    {
        $t_req=RequestTutor::find($req->req_id);
        Schedule::create(['tutor_id'=>auth()->user()->id,
            'student_id'=>$t_req->student_id,
            'date'=>$req->date,
            'active_date'=>$req->date,
            'slot'=>$req->slot,
            'request_tutor_id'=>$t_req->id
        ]);
        $t_req->save();
        $student = StudentProfile::where('user_id',$t_req->student_id)->first();
        $student->remaining_hours -= 1;
        $student->save();
        
        return back()->with("message","Schedule saved successfully");
    }
}
