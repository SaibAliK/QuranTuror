<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

/** All Paypal Details class **/
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;

class PaypalController extends Controller
{
    

    public function payWithpaypal(Request $request)
    {

    	$provider = new ExpressCheckout;

        $data = [];
        $data['items'] = [
            [
                'name' => 'EventManager',
                'price' => 100,
                'desc'  => 'EventManager plan for map plot',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

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
        dd($response->id);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Session::forget('plan_id');
            return redirect()->route('student.dashboard')->with('message', 'Thank you! Your payments has been confirmed.');

        }
  
        dd('Something is wrong.');
    }
}
