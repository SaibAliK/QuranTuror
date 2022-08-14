@extends('layouts.student')
@section('title', 'Student Search Tutor')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/assets/css/pricing_table.css">
@endsection
@section('content')
    <div class="card  mb-5">

        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center">
                <h2 class="text-center has-line text-dark line-primary">Tutor Packages</h2>
            </div>
            <div class="col-lg-12 mb-3 text-justify">
                <div class="alert alert-info mt-2">You have completed the trial with this tutor {{ $tutor->FullName }} Are you want to continue with this tutor {{ $tutor->FullName }} ? <a href="javascript:void(0);" class="decline_button">Click here to decline</a></div>
            </div>
            <section class="pricing-table">
                <div class="container">
                    <div class="row justify-content">
                        @foreach($list as $item)
                            <div class="col-md-5 col-lg-4">
                                <div class="item">
                                    <div class="heading">
                                        <h3>
                                            @if($item->type==1)
                                                Basic
                                            @elseif($item->type==2)
                                                Profession
                                            @elseif($item->type==3)
                                                Ultimate
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="price">
                                        <h4>${{ $item->total_amount }}</h4>
                                    </div>
                                    <div class="features">
                                        <h4><span class="value">{{ $item->hours }} - Hours</span></h4>
                                    </div>
                                    <div class="features">
                                        <h4><span class="value"><small>${{ $item->per_hour_amount }} / hour</small></span></h4>
                                    </div>
                                    <p style="height: 100px;">{!! $item->description !!}</p>
                                    <!-- <button type="button" class="btn btn-primary" type="submit">BUY NOW</button> -->
                                    <div class="mt-auto">
                                        <a data-id="{{ $item->id }}" href="" class="btn btn-block btn-outline-primary rounded-pill buy_btn">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <form method="POST" id="buy_package_form" action="{{ route('student.tutor.buy.package') }}">
                            @csrf
                            <input type="hidden" name="tutor_id" value="{{ $student_req->tutor_id }}">
                            <input type="hidden" name="update_package" value="{{$_GET['update_package'] ?? ''}}">
                            <input type="hidden" class="package_id" name="package_id" value="">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    

    <!-- request tutor -->
    <div class="modal fade rounded" id="declineReasonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Decline Reason</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form method="POST" action="{{ route('student.tutor.decline_request',$student_req->id) }}">
                        @csrf
                        <div class="form-group col-12 mt-3">
                            <textarea class="form-control" name="decline_reason" rows="3"></textarea><br>
                            <button type="submit" class="btn btn-primary btn-sm pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- request tutor -->
@endsection
@section('js')

<script>
    $(document).on('click','.buy_btn',function(e){
        e.preventDefault();
        package_id=$(this).attr("data-id");
        $(".package_id").val(package_id);
        $('#buy_package_form').submit();
    });

    $(document).on("click",".decline_button",function(){
        $("#declineReasonModal").modal('show');
    });
</script>

@endsection
