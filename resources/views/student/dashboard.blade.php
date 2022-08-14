@extends('layouts.student')
@section('title', 'Student Dashboard')
@section('css')
		<link rel="stylesheet" type="text/css" href="{{asset('theme/calendar/fullcalendar.bundle.css')}}"/>
@endsection
@section('content')
	@if(is_null(auth()->user()->email_verified_at))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info">
					@if (session('status') == 'verification-link-sent')
						A new email verification link sent your email account.
					@else
				 		We have sent an email verification link to your email account.
					@endif
					Didn't recieved yet?
					<a href="javascript:void(0);" class="click_here">Click here </a>
					<form method="POST" id="verif-form" action="{{ route('verification.send') }}">
		                @csrf
		            </form>
				</div>
			</div>
		</div>
	@endif
	@if(auth()->user()->student->remaining_hours >="1" && auth()->user()->student->remaining_hours <="5")
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					Your remaining hours is {{auth()->user()->student->remaining_hours ?? "0"}}hrs , Please buy package to avoid any problem. 
					<a href="javascript:void();" data-href="{{route('student.tutor.packages')}}?update_package=true" class="">Click here </a>
				</div>
			</div>
		</div>
	@endif

	<!-- Student Cards -->
	<div class="row dashboard mb-5 mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-icon mb-2">
                        <span class="rounded-circle"><i class="fa fa-podcast"></i></span>
                    </div>
                    <p class="font-weight-bold">Session Attended</p>
                    <h3>{{ $attended_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-icon mb-2">
                        <span class="rounded-circle"><i class="fa fa-circle-o-notch"></i></span>
                    </div>
                    <p class="font-weight-bold">Upcoming Sessions</p>
                    <h3>{{ $upcoming_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-icon mb-2">
                        <span class="rounded-circle"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                    </div>
                    <p class="font-weight-bold">Package</p>
                    <h3>{{ auth()->user()->student->package->total_amount ?? 'N/A' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-icon mb-2">
                        <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                    </div>
                    <p class="font-weight-bold">Money Spent</p>
                    <h3>{{ $amount_count }}</h3>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->student->status == 'approve')
	<div class="card shadow">
		<div class="card-body">
			<div id="kt_calendar"></div>
		</div>
	</div>
	<!-- request tutor -->
    <div class="modal fade rounded" id="joinMeetingnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Join Meeting</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm start_session_btn" type="submit">Join</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- request tutor -->
    @endif

@endsection

@section('js')

		<script src="{{asset('theme/calendar/fullcalendar.bundle.js')}}"></script>
		<script>
			$(document).ready(function () {

			 	var KTCalendarBasic = function() {

				 	return {
						 //main function to initiate the module
					 	init: function() {

						 	var calendarEl = document.getElementById('kt_calendar');
						 	var calendar = new FullCalendar.Calendar(calendarEl, {
						 	plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar' ],


						 	header: {
							 	left: 'prev,next today',
							 	center: 'title',
							 	right: 'dayGridMonth,timeGridDay'
						 	},

					 		displayEventTime: false, // don't show the time column in list view

						 	height: 800,
						 	contentHeight: 780,
						 	aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

						 	views: {
							 	dayGridMonth: { buttonText: 'month' },
							 	timeGridDay: { buttonText: 'day' }
						 	},

						 	defaultView: 'dayGridMonth',

						 	editable: false,
						 	eventLimit: true, // allow "more" link when too many events
						 	navLinks: true,

						 	// THIS KEY WON'T WORK IN PRODUCTION!!!
						 	// To make your own Google API key, follow the directions here:
						 	// http://fullcalendar.io/docs/google_calendar/
						 	googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

						 	// US Holidays
						 	events: [

					 			@foreach($events as $event)
					 			{
						 			id : '{{ $event->id }}',
								 	title : '{{ $event->tutor->FullName }}',

								 	start : '{{ studentDateTimeHashFormat($event->date,$event->slot) }}',
								 	@if(meeting_start($event->id))
								 		className:"bg-primary text-white",
								 	@else
									 	className: "bg-warning text-white",
								 	@endif
						 		},
						 		@endforeach
				 			],
						 	eventClick: function(info) {
							    $.ajax({
							        type: "GET",
							        url: "{{ route('student.check.session.start') }}?id="+info.event.id,
							        success: function (response) {
							            if(response.started){
					                        $(".start_session_btn").attr("href", response.join_url);
					                        $("#joinMeetingnModal").modal("show");
					                    } else{
				                        		swal({
												  	title: "Please wait!",
												  	text: "Tutor has not started the meeting",
												  	icon: "warning",
												  	button: "Close",
												});
					                    }
							        }
							    });
                            }
                        });

					 		calendar.render();
					 	}
				 	};
			 	}();

			 	jQuery(document).ready(function() {
				 	KTCalendarBasic.init();
			 	});

			});
			window.onload = function () {
            	$('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
	        };
	        
	        // submit resend verify link form
	        $(document).on('click','.click_here',function(e){
     			e.preventDefault();
     			$('#verif-form').submit();
  			});
		</script>

		@endsection



