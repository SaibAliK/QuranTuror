<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\RequestTutor;
use App\Models\User;
use App\Models\TimeTable;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\Location;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TutorController extends Controller
{
    public function list(Request $req)
    { 
        // dd(request()->day);

        $locations=Location::all();
        $student_req=RequestTutor::where('student_id',auth()->user()->id)
            ->latest()
            ->first();
        if(isset($student_req) && $student_req->status!='cancelled' && $student_req->accept_status!='2')
        {
            $tutor=User::find($student_req->tutor_id);
            $list=$tutor->tutor_packages;
            return view("student.tutor.packages",get_defined_vars());
        }else
        {
            $tutor_list=User::has('tutor');
            if(isset($req->filter))
            {
               if(isset($req->location_id))
                {
                    // dd("Ok");
                    $tutor_list=$tutor_list->whereHas('tutor',function($query) use($req)
                    {
                        $query->whereHas('location',function($q) use($req)
                        {
                            $q->where('id',$req->location_id);
                        });
                    });
                }
                
                if(isset($req->day))
                {
                    $tutor_list=$tutor_list->whereHas('time_tables',function($q) use($req)
                    {
                        $tutor_list=$q->where('is_closed','0')
                            ->whereIn('day',$req->day);
                        if(isset($req->slot))
                        {
                            $form=array();
                            $to=array();
                            foreach($req->slot as $item)
                            {
                                $from[]=explode('-',$item)[0];
                                $to[]=explode('-',$item)[1];
                            }
                            $tutor_list=$tutor_list->whereIn('from',$from)->orWhereIn('to',$to);
                            // dd($req->slot);
                        }
                        
                        
                    });
                }
            }else
            {
                $tutor_list=$tutor_list->orderBy('id','desc');
            }
            $tutor_list=$tutor_list->get();
            return view('student.tutor.list',get_defined_vars());
        }
    }

    public function requestTutor(Request $request)
    {
        $request->validate([
            'date'=>'required',
            'slot'=>'required',
            'tutor_id'=>'required'
        ]);
        
        $data['date']=$request->date;
        $data['message']=$request->message;
        $data['slot']=$request->slot;
        $data['student_id']=$request->student_id;
        $data['tutor_id']=$request->tutor_id;

        $data['has_subscription'] = false;
        session(['request_tutor' => (object)$data]);
        return redirect()->route('student.payment.method')->with('success', 'To Complete Request Please Enter Payment Details');

        return redirect()->back()->with('message','Request sent successfully to Tutor');
    }

    public function loadTutorIntervals(Request $req)
    {
        $tutor = User::find($req->id);

        $user=auth()->user();

        $tutor_req = Schedule::where('tutor_id',$req->id)
            ->where('date',$req->day)
            ->where('class_status', 'pending')
            ->pluck('slot')->toArray();

        $day = Carbon::parse($req->day)->format("l");
        
        $time_table = $tutor->time_tables->where('day',$day)->first();
        if(is_null($time_table))
        {
            return response()->json(['',401]);
        }
        // Parsing Time
        if ($user->time_zone == $tutor->time_zone) {
            $tutorStartTime = strtotime($time_table->from);
            $tutorEndTime = strtotime($time_table->to);

        } else {
            $tutorStartTime = strtotime(studentDateTime($req->day, $time_table->from));
            $tutorEndTime = strtotime(studentDateTime($req->day, $time_table->to));

            // dd(studentDateTime($req->day, $time_table->from), studentDateTime($req->day, $time_table->to));            
            // dd($tutorStartTime, $tutorEndTime);
        }
        $tutor_time_zone = array();



        for ($i = $tutorStartTime; $i < $tutorEndTime; $i+=3600) {
            $tutor_time_zone[] = date("h:ia", $i);
        }

        $available = array_diff($tutor_time_zone, $tutor_req);
        
        if (count($available) > 0) {
            return [view('ajax.student.load_tutor_time_intervals', get_defined_vars())->render(), 200];
        } else {
            return [view('ajax.student.load_tutor_time_intervals', get_defined_vars())->render(), 401];
        }
    }

    public function requestList()
    {
        $pending=RequestTutor::where('student_id',auth()->user()->id)->where('status','pending')->get();
        $approved=RequestTutor::where('student_id',auth()->user()->id)->where('status','approved')->get();
        $cancelled=RequestTutor::where('student_id',auth()->user()->id)->where('status','cancelled')->get();
        return view('student.requests.requests',get_defined_vars());
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
        return back()->with('message','Request Cancelled Successfully');
    }

    public function packages(Request $request , $id=null)
    {
        $list=Package::all();
        return view("student.tutor.packages",get_defined_vars());
    }

    public function buyPackage(Request $req)
    {
        $t_req=RequestTutor::where('tutor_id',$req->tutor_id)
            ->where('student_id',auth()->user()->id)
            ->first();
        $student_package=Package::find($req->package_id);
        session(['request_tutor' => $t_req,'student_package'=>$student_package , 'update_package'=>$req->update_package]);
        return redirect()->route('student.payment.form')->with('success', 'To Complete Request Please Enter Payment Details');
    }

    public function declineRequest(Request $req,$id=null)
    {
        $t_req=RequestTutor::find($id);
        $t_req->decline_reason=$req->decline_reason;
        $t_req->payment_type="temporary";
        $t_req->accept_status='2';
        $t_req->save();
        return back()->with("message","Request declined successfully.");
    }

}
