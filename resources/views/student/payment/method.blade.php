@extends('layouts.student')
@section('title', 'Student Profile')
@section('css')
<link href="{{asset('dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .payment_methods img
    {
        width: 120px;
        min-height: 120px;
    }
    .payment_methods .card-body
    {
        min-height: 200px !important;
    }
        
</style>
@endsection
@section('content')
    <div class="row payment_methods">
        <div class="col-md-4">
            <div class="card  mb-5">
                <div class="card-body text-center">
                    <img src="{{ asset('images/paypal.svg') }}" class="img-fluid paypal_img">
                    <a href="{{ route('student.payment.paypal.form') }}">
                        <button type="button" class="btn btn-primary shadow rounded-pill mt-5" id="purchase-btn">Pay With Paypal</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card  mb-5">
                <div class="card-body text-center">
                    <img src="{{ asset('images/stripe.svg') }}" class="img-fluid stripe_img">
                    <a href="{{ route('student.payment.form') }}">
                        <button type="button" class="btn btn-primary shadow rounded-pill mt-5" id="purchase-btn">Pay With Stripe</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection



