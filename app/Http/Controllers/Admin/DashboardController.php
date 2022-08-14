<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\User;
use App\Models\RequestTutor;
use App\Models\MeetingSession;
use App\Models\TutorPayout;
use App\Models\StudentProfile;
use App\Models\Transaction;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
    	$tutor_count=User::has("tutor")->count();
    	$student_count=User::has("student")->count();
    	$request_count=RequestTutor::count();
        $earning = Transaction::where('status',1)->sum('amount');

        $win_jobs = RequestTutor::where('accept_status','1');
        $lost_jobs = RequestTutor::where('accept_status','2');

        return view('admin.dashboard',get_defined_vars());
    }

    public function earningList(Request $req)
    {
//        dd($req);.
        $transactions = Transaction::where('status',1);

        if (isset($req->from_date) && !isset($req->to_date)) {
            $transactions = $transactions->whereDate('created_at', '>=', Carbon::parse($req->from_date));
        }
        if (!isset($req->from_date) && isset($req->to_date)) {
            $transactions = $transactions->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }
        if (isset($req->from_date) && isset($req->to_date)) {
            $transactions = $transactions->whereDate('created_at', '>=', Carbon::parse($req->from_date));
            $transactions = $transactions->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }

        $adminEarning=adminEarning($req);
        // dd($adminEarning);
        $transactions = $transactions->get();
        $earning = $transactions->sum('amount');

    	return view("admin.earning.list", get_defined_vars());
    }

    public function sale(Request $req)
    {
        $adminRevenue=adminRevenue($req);

        $adminIncome=adminIncome($req);
        $tutorsIncome=tutorsIncome($req);
        $adminPaidIncome=adminPaidIncome($req);
        $adminUnpaidIncome=adminUnpaidIncome($req);
        $adminProfit=adminProfit($req);
        // dd(get_defined_vars());

        return view("admin.sale.sales",get_defined_vars());
    }
}
