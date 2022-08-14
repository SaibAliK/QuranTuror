<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\RequestTutor;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\StudentProfile;
use Illuminate\Support\Carbon;
use App\Models\PackagePercentage;
use App\Models\TutorTransaction;

// Paypal Payment Details
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;

class PaymentController extends Controller
{
    // Paypal Functions
    public function paypalForm(Request $req)
    {
        $t_req = session('request_tutor');
        if (session('student_package')) {
            $rate = session('student_package')->total_amount;
        } else {
            $rate = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
        }
        return view("student.payment.paypal_form",get_defined_vars());
    }

    public function payWithpaypal(Request $request)
    {
        $t_req = session('request_tutor');
        $package = session('student_package');
        $update_package = session('update_package');
        if ($package) {
            $amount = $package->total_amount;
        } else {
            $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
        }

        $provider = new ExpressCheckout;

        $data = [];
        $data['items'] = [
            [
                'name' => 'Quran Tutors Payment',
                'price' => $amount,
                'desc'  => 'Student Payment To Learn From Tutor',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = $t_req->student_id.$t_req->tutor_id.$t_req->date;
        $data['invoice_description'] = "Student Payment";
        $data['return_url'] = route('student.payment.success');
        $data['cancel_url'] = route('student.payment.cancel');
        $data['total'] = $amount;

        $response = $provider->setExpressCheckout($data);
    
        $response = $provider->setExpressCheckout($data, true);
           

        return redirect($response['paypal_link']);
    }

    public function cancel()
    {
        dd('Your payments are canceled.');
    }
  
    public function success(Request $request)
    {   
        $provider = new ExpressCheckout;

        $response = $provider->getExpressCheckoutDetails($request->token);
        // $response=(object)$response;
        // dd($response['TOKEN']);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // dd("All IS FINE");
            $t_req = session('request_tutor');
            $package = session('student_package');
            $update_package = session('update_package');
            if ($package) {
                $amount = $package->total_amount;
            } else {
                $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
            }

            if ($package) {
                if($update_package==true)
                {
                    $student_profile = StudentProfile::where('user_id', auth()->user()->id)->first();
                    $student_profile->package_id = $package->id;
                    $student_profile->remaining_hours += $package->hours;
                    $student_profile->start_date = date('Y-m-d H:i:s');
                    $student_profile->end_date = Carbon::now()->addDays(30);
                    $student_profile->save();
                    session()->forget('update_package');
                    return redirect()->route('student.dashboard')->with('message', 'Your package have been  update successfully ');
                }
                else
                {
                    $t_req->payment_type = 'permanent';
                    $t_req->accept_status = '1';
                    $t_req->save();
                    $student_profile = StudentProfile::where('user_id', auth()->user()->id)->first();
                    $student_profile->package_id = $package->id;
                    $student_profile->remaining_hours = $package->hours;
                    $student_profile->save();
                    $t_req->amount_paid = $t_req->amount_paid + $amount;
                    $tutor_request = $t_req;
                }
            } else {
                $tutor_request = new RequestTutor();
                $tutor_request->message = $t_req->message;
                $tutor_request->date = $t_req->date;
                $tutor_request->slot = $t_req->slot;
                $tutor_request->student_id = auth()->user()->id;
                $tutor_request->tutor_id = $t_req->tutor_id;
                $tutor_request->amount_paid = $amount ?? 0;
                $tutor_request->payment_type = 'temporary';
                $tutor_request->save();
            }
            if($package)
            {
                $package_type=$package->type;
                if($package_type==1)
                {
                    $percentage=setting()->basic_percentage;
                }elseif($package_type==2)
                {
                    $percentage=setting()->profession_percentage;
                }else
                {
                    $percentage=setting()->ultimate_percentage;
                }
                
                $admin_amount=($package->total_amount*$percentage)/100;
                $tutor_amount=$package->total_amount-$admin_amount;
                TutorTransaction::create([
                    'paypal_id' => $response['TOKEN'],
                    'payment_method'=>'2',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'package_id'=>$package->id,
                    'amount' => $tutor_amount,
                    'request_tutor_id' => $tutor_request->id,
                ]);
                $tutor_request->unpaid_amount=$tutor_request->unpaid_amount+$tutor_amount;
                $tutor_request->save();
                Transaction::create([
                    'paypal_id' => $response['TOKEN'],
                    'payment_method'=>'2',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'amount' => $admin_amount,
                    'type'=> 2,
                    'request_tutor_id' => $tutor_request->id,
                    'percentage'=>$percentage,
                ]);
                $t_profile=TutorProfile::where('user_id',$tutor_request->tutor_id)
                                ->first();
                $t_profile->win=$t_profile->win+1;
                $t_profile->save();
            }else
            {
                Transaction::create([
                    'paypal_id' => $response['TOKEN'],
                    'payment_method'=>'2',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'amount' => $amount,
                    'type'=>1,
                    'payment_type' => $tutor_request->payment_type,
                    'request_tutor_id' => $tutor_request->id,
                ]);
            }

            session()->forget('request_tutor');
            session()->forget('student_package');

        return redirect()->route('student.dashboard')->with('message', 'Your payment have been successfully captured!');

        }
  
        dd('Something is wrong.');
    }
    // Paypal Functions End Here..

    public function paymentMethod(Request $request)
    {

        return view('student.payment.method', get_defined_vars());
    }

    public function paymentForm(Request $request)
    {
        $t_req = session('request_tutor');
        if (session('student_package')) {
            $rate = session('student_package')->total_amount;
        } else {
            $rate = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
        }
        return view('student.payment.payment', get_defined_vars());
    }

    public function paymentSave(Request $req)
    {
        $t_req = session('request_tutor');
        $package = session('student_package');
        $update_package = session('update_package');
        if ($package) {
            $amount = $package->total_amount;
        } else {
            $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charge = \Stripe\Charge::create([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $req->stripeToken,
                "description" => "Test payment Quran Tutor.",
                "capture" => true
            ]);

            if ($package) {
                if($update_package==true)
                {
                    $student_profile = StudentProfile::where('user_id', auth()->user()->id)->first();
                    $student_profile->package_id = $package->id;
                    $student_profile->remaining_hours += $package->hours;
                    $student_profile->start_date = date('Y-m-d H:i:s');
                    $student_profile->end_date = Carbon::now()->addDays(30);
                    $student_profile->save();
                    session()->forget('update_package');
                    return redirect()->route('student.dashboard')->with('message', 'Your package have been  update successfully ');
                }
                else
                {
                    $t_req->payment_type = 'permanent';
                    $t_req->accept_status = '1';
                    $t_req->save();
                    $student_profile = StudentProfile::where('user_id', auth()->user()->id)->first();
                    $student_profile->package_id = $package->id;
                    $student_profile->remaining_hours = $package->hours;
                    $student_profile->save();
                    $t_req->amount_paid = $t_req->amount_paid + $amount;
                    $tutor_request = $t_req;
                }
            } else {
                $tutor_request = new RequestTutor();
                $tutor_request->message = $t_req->message;
                // $tutor_request->no_of_hours = $no_of_hours ?? null;
                // $tutor_request->remaining_hours = $no_of_hours ?? null;
                $tutor_request->date = $t_req->date;
                $tutor_request->slot = $t_req->slot;
                $tutor_request->student_id = auth()->user()->id;
                $tutor_request->tutor_id = $t_req->tutor_id;
                $tutor_request->amount_paid = $amount ?? 0;
                $tutor_request->payment_type = 'temporary';
                $tutor_request->save();
            }
            if($package)
            {
                $package_type=$package->type;
                if($package_type==1)
                {
                    $percentage=setting()->basic_percentage;
                }elseif($package_type==2)
                {
                    $percentage=setting()->profession_percentage;
                }else
                {
                    $percentage=setting()->ultimate_percentage;
                }
                
                $admin_amount=($package->total_amount*$percentage)/100;
                $tutor_amount=$package->total_amount-$admin_amount;
                TutorTransaction::create([
                    'stripe_id' => $charge->id,
                    'payment_method'=>'1',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'package_id'=>$package->id,
                    'amount' => $tutor_amount,
                    'request_tutor_id' => $tutor_request->id,
                ]);
                $tutor_request->unpaid_amount=$tutor_request->unpaid_amount+$tutor_amount;
                $tutor_request->save();
                Transaction::create([
                    'stripe_id' => $charge->id,
                    'payment_method'=>'1',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'amount' => $admin_amount,
                    'type'=> 2,
                    'request_tutor_id' => $tutor_request->id,
                    'percentage'=>$percentage,
                ]);
                $t_profile=TutorProfile::where('user_id',$tutor_request->tutor_id)
                                ->first();
                $t_profile->win=$t_profile->win+1;
                $t_profile->save();
            }else
            {
                Transaction::create([
                    'stripe_id' => $charge->id,
                    'payment_method'=>'1',
                    'tutor_id'=>$tutor_request->tutor_id,
                    'student_id'=>$tutor_request->student_id,
                    'amount' => $amount,
                    'type'=>1,
                    'payment_type' => $tutor_request->payment_type,
                    'request_tutor_id' => $tutor_request->id,
                ]);
            }

            session()->forget('request_tutor');
            session()->forget('student_package');

        } catch (\Stripe\Error\Card $e) {
            dd($e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {
            dd($e->getMessage());
        }

        return redirect()->route('student.dashboard')->with('message', 'Your payment have been successfully captured!');
    }
}
