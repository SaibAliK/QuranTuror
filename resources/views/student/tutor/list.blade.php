@extends('layouts.student')
@section('title', 'Student Search Tutor')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />

    <style>
        .list{
            width: 100%!important;
        }
        .img_tutor
        {
            object-fit: cover;
            height: 112px !important;
        }
    </style>
@endsection
@section('content')

    <div class="card shadow align-self-center">
        <div class="car-header">
            <div class="container pt-2 tutor_filter">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET" class="filter-formm">
                            <input type="hidden" name="filter" value="filter">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Select Country</label>
                                    <div class="form-group">
                                        <select name="location_id" class="form-control shadow-none select2 rounded-sm @error('location_id') is-invalid @enderror">
                                            <option value="" disabled>Select Country</option>
                                            @foreach($locations as $item)
                                                <option @if($req->location_id==$item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Select Day</label>
                                    <div class="form-group multiple_options_field">
                                        <select name="day[]" class="multiselect selected_days" multiple="multiple">
                                            <option value="" disabled >I m available</option>
                                            @foreach(days_dropdown() as $item)
                                                <option value="{{ $item }}" @if(isset(request()->day) && in_array($item,request()->day)) selected @endif >{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Select Time</label>
                                    <div class="form-group multiple_options_field">
                                        <select name="slot[]" class="multiselect" multiple="multiple">
                                            <option value="" disabled >I m available</option>
                                            @foreach(time_dropdown() as $item)
                                                <option value="{{ $item }}" @if(isset(request()->day) && in_array($item,request()->slot)) selected @endif>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <button type="submit" class="btn btn-primary shadow rounded-pill ">Search
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body bg-normal">
            @if(count($tutor_list)>0)
                <h4 class="text-dark mb-2">{{count($tutor_list)}} results</h4>
                <div class="row student-find-tutor">
                    @foreach($tutor_list  as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <img @if($item->tutor->image) src="{{ asset($item->tutor->image) }}" @else src="{{ asset('images/default.png') }}" @endif class="card-img" alt="">
                                <div class="card-body">
                                    <div class="coach-detail">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <h5 class="mb-0">{{ $item->FULLNAME }}</h5>
                                            </div>
                                            <div class="float-right">
                                                <h5>${{ setting()->general_price ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <p class="mt-2" style="min-height: 70px;">
                                            {{ substr($item->tutor->bio,0,18) }}

                                            <a class="btn p-0 readMoreBtn" data-text="{{$item->tutor->bio}}">Read More...</a>
                                        </p>
                                        <div class="clearfix">
                                            <div class="float-left card_tutor_buttons">
                                                @if(class_complete($item->id))
                                                    @if(!is_student($item->id))
                                                        <a href="{{ route('student.tutor.packages',$item->id) }}" class="btn btn-outline-primary rounded-pill">Buy Package</a>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn active-hired rounded-pill ">Hired</a>
                                                    @endif
                                                @else
                                                    <a href="javascript:void(0);" data-id="{{$item->id}}" data-name="{{$item->first_name}} {{$item->last_name}}" data-toggle="modal" data-target="#requestTutor" class="btn btn-outline-primary rounded-pill reqTutor">Hire</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row ">
                    <div class="col-12 text-center">
                        <img src="{{asset('images/no_search.svg')}}" width="90px" class="img-fluid" alt="">
                        <h3 class="text-dark mt-3">No Results Found.</h3>
                        <p>We can't find any tutor matching your search.</p>
                    </div>
                </div>
            @endif
        </div>

    <!-- request tutor Modal -->
    <div class="modal fade rounded" id="requestTutor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Request Tutor</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form method="POST" action="{{route('student.tutor.request')}}" class="row" id="tutor_request_form">
                        @csrf
                            <div class="col-lg-12 p-0">
                                <input type="hidden" name="student_id" value="{{auth()->user()->id}}">
                                <input type="hidden" id="tutor_id" name="tutor_id" >

                                <div class="col-md-12">
                                    <div class="form-group mb-10 ">
                                        <label class="text-secondary h6 mb-2" for="pnumber">Write a Message to Tutor*</label>
                                        <textarea class="form-control shadow-none rounded-sm" name="message" cols="8" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="interval" value="1">
                            <div class="col-lg-12">
                                <div class="col-lg-6 pl-0 float-left book-slot">
                                    <div class="form-group pl-0 col-12 mb-10 ">
                                        <label class="text-secondary h6 mb-2" for="book_slot">Book Slot</label>
                                        <input id="date_picker" type="text" class="form-control shadow-none rounded-sm book_slot valid_field" name="date" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 float-right select-time">
                                    <div class="form-group col-0 mb-10 ">
                                        <label class="text-secondary h6 mb-2">Select Time</label>
                                        <select class="form-control select2 shadow-none w-100 rounded-sm valid_field" id="interval_list" required name="slot">
                                            <option value="">Select Time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 error-div float-left">
                                    <span class="invalid-feedback font-weight-bold">Tutor is not available at this day</span>
                                </div>
                            </div>
                        <div id="dd"></div>
                        <div class="form-group col-12 mt-3">
                            <button class="btn btn-primary w-100 rounded-sm submit_request_btn" type="button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- request tutor -->
    <!-- request tutor -->
    <div class="modal fade rounded" id="readMoreModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <p class="read_more_data"> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- request tutor -->



@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>

        // $(".selected_days").select2("destroy");

        $('.clear').on('click',function(e){
            e.preventDefault();
            $('.filter_by').val('');
            $('.filter-form').submit();
        });
        $(document).on('change','.filter_by',function(e){
            e.preventDefault();
            $('.filter-form').submit();
        });

        @if(session('tutor_id'))
            var tutor_id="{{ session('tutor_id') }}";
            @if(class_complete(session('tutor_id')))
                toastr.error("You have already completed a trial session with this tutor");
            @else
                $("#requestTutor").modal("show");
                $('#tutor_id').val(tutor_id);
            @endif
        @endif

        $(document).ready(function () {

            $('#date_picker').datepicker();
            console.log('stop');

            $('#interval').on('change',function () {

                let vl=$(this).val();
                if(vl==1)
                {
                    $('#no_of_hours').hide();
                    $('.book-slot').show();
                    $('.select-time').show();
                    // $('#weeks').val(null);
                }
                if (vl==2)
                {
                    $('#no_of_hours').show();
                    $('.book-slot').hide();
                    $('.select-time').hide();
                }

            });
            $('.reqTutor').on('click',function () {
                console.log('click');
                let id=$(this).data('id');

                console.log(id);
                $('#tutor_id').val(id);

            });
        });

        $(document).on("change","#date_picker", function(){
            var day=$(this).val();
            var id = $("#tutor_id").val();
            $(".error-div .invalid-feedback").css('display', 'none');
            tutorTimeList(id,day);
        });

        function tutorTimeList(id,day)
        {
            $.ajax({
                type: "GET",
                url: "{{ route('student.tutor.load.intervals') }}?id="+id+"&day="+day,
                success: function (response) {
                    if (response[1] == 200) {
                        $('#interval_list').html(response[0]);
                        $("select").niceSelect('destroy');
                        $("select").niceSelect();
                    } else {
                        $('#interval_list').html('<option value="">Select Time</option>');
                        $("select").niceSelect('destroy');
                        $("select").niceSelect();
                        $(".error-div .invalid-feedback").css('display', 'block');
                    }
                }
            });
        }

        $('.submit_request_btn').on('click',function(e){
            e.preventDefault();
            $('#tutor_request_form').submit();
        });

        function validate() 
        {
            var valid = true;
            $("form").find('.alert-warning').remove();
            $(".valid_field:visible").each(function () {
            if ($(this).val() == "") {
                $(this).closest("div").find(".alert-danger").remove();
                $(this)
                    .closest("div")
                    .append('<div class="alert-danger mb-2">This filed is required</div>');
                    valid = false;
                    } else {
                        $(this).closest("div").find(".alert-danger").remove();
                    }
                });
                if (!valid) {
                    $("html, body").animate(
                    {
                        scrollTop: $(".alert-danger:first").offset().top-80,
                    },
                        100
                    );      
                }
                return valid;
        }

        $(document).on("click",".readMoreBtn",function(){
            var bio_text=$(this).attr('data-text');
            $(".read_more_data").html(bio_text);
            $("#readMoreModal").modal("show");
        });

        function selectedDays(days)
        {
            $(".selected_days option").each(function(){
                var single_day=$(this).text();
                $.map(days, function(value, index){
                    console.log(days);
                    console.log(value);
                    console.log(index);
                    if(value==single_day)
                    {
                        // alert(single_day + " - " + value);
                        $(this).prop('selected',true);
                        // $(this).text(value);
                    }
                });
            });
        }
        var days = <?php echo json_encode(request()->day); ?>;
        selectedDays(days);
        
    </script>

@endsection
{{ Session::forget('tutor_id') }}
