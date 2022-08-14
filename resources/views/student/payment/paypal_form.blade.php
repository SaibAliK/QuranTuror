@extends('layouts.student')
@section('title', 'Student Profile')
@section('css')
<style>

</style>
@endsection
@section('content')
    <div class="card  mb-5">
        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center mb-5">
                <h2 class="text-center has-line text-dark line-primary">Payment</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center text-dark">Card details</h2>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body text-center">
                            @if ($message = Session::get('success'))
                                <div class="w3-panel w3-green w3-display-container">
                                    <span onclick="this.parentElement.style.display='none'"
                                            class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                                    <p>{!! $message !!}</p>
                                </div>
                                <?php Session::forget('success');?>
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="w3-panel w3-red w3-display-container">
                                    <span onclick="this.parentElement.style.display='none'"
                                            class="w3-button w3-red w3-large w3-display-topright">&times;</span>
                                    <p>{!! $message !!}</p>
                                </div>
                                <?php Session::forget('error');?>
                                @endif
                                <form method="POST" id="payment-form" action="{{route('student.payment.paypal')}}">
                                    @csrf
                                    <p class="font-weight-bold text-dark text-center">Pay tutor fee of ${{ $rate ?? '' }} ( Trial is refundable )</p>
                                    <p>
                                        <input class="form-control" name="name" type="text" placeholder="Enter Name" value="{{ $rate ?? '' }}" readonly></p>
                                    	<button type="submit" class="btn btn-primary shadow rounded-pill mt-5">Pay with PayPal</button></p>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    

@endsection



