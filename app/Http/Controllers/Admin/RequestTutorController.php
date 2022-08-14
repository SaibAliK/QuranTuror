<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestTutor;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\StudentProfile;
use Carbon\Carbon;


class RequestTutorController extends Controller
{
    public function index(Request $req)
    {
        $list = RequestTutor::where('id','!=', null);

        if(isset($req->from_date) && isset($req->to_date))
        {
            $list = $list->whereDate('created_at', '>=', Carbon::parse($req->from_date));
            $list = $list->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }
        if (isset($req->from_date) && !isset($req->to_date))
        {
            $list = $list->whereDate('created_at', '>=', Carbon::parse($req->from_date));
        }
        if (!isset($req->from_date) && isset($req->to_date))
        {
            $list = $list->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }
        $list = $list->get();

        $win_jobs_count = $list->where('accept_status', '1')->count();
        $lost_jobs_count = $list->where('accept_status', '2')->count();
        $pending_count = $list->where('status', 'pending')->count();
        $cancelled_count = $list->where('status', 'cancelled')->count();

    	return view("admin.request_tutor.index", get_defined_vars());
    }

    public function editForm(Request $req)
    {
        $item=Schedule::find($req->id);
        return view("ajax.admin.edit_schedule",get_defined_vars());
    }

    public function store(Request $req)
    {
        $req->validate([
            'date' => 'required',
            'slot' => 'required',
        ]);
        Schedule::where("id",$req->id)->update(['date'=>$req->date,
            'slot'=>twelveTime($req->slot)]);
        return back()->with("success","Schedule Updated Successfully");
    }

    public function delete($id = null)
    {
        $t_req=RequestTutor::find($id);
        return back()->with('success','Tutor Request Deleted Successfully');
    }

    public function deleteSchedule($id = null)
    {
        $schedule=Schedule::find($id);
        $t_req=RequestTutor::find($schedule->request_tutor_id);
        $t_req->remaining_hours=$t_req->remaining_hours+1;
        $t_req->save();
        $schedule->delete();
        return back()->with('success','Schedule Deleted Successfully.');
    }

    public function allSchedule()
    {
        $schedules = Schedule::all();
        return view('admin.request_tutor.list' , get_defined_vars());
    }

    public function schedule($id=null)
    {
        $t_req=RequestTutor::find($id);
        $list=Schedule::where('request_tutor_id',$id)
        ->get();
        return view("admin.request_tutor.schedule",get_defined_vars());
    }

    public function cancel($id=null)
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


        return back()->with("success","Request Cancelled successfully");
    }
}
