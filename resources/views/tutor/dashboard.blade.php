@extends('layouts.tutor')
@section('title', 'Tutor Dashboard')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('theme/calendar/fullcalendar.bundle.css')}}"/>
@endsection


@section('content')
    <!-- Tutor Cards -->
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
                        <span class="rounded-circle"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                    </div>
                    <p class="font-weight-bold">Time (In Hours)</p>
                    <h3>{{ $time_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-icon mb-2">
                        <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                    </div>
                    <p class="font-weight-bold">Money Earned</p>
                    <h3>{{ $amount_count }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow">
        <div class="card-body">
            <div id="kt_calendar"></div>
        </div>
    </div>
    <!-- start session -->
    <div class="modal fade rounded" id="startSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Start Session</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group col-12 mt-3">
                        <a href="" class="btn btn-primary w-100 rounded-sm start_session_btn" type="submit">Start Session</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start session -->
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
                                    title : '{{ $event->student->FullName }}',

                                    start : '{{ \Carbon\Carbon::parse($event->date.' '.$event->slot)->format('Y-m-d H:i:s') }}',
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
                                    url: "{{ route('tutor.check.session.status') }}?id="+info.event.id,
                                    success: function (response) {
                                    if(response.started){
                                            var $url="{{ route('start.session') }}/"+info.event.id;
                                            $(".start_session_btn").attr("href",$url);
                                            $("#startSessionModal").modal("show");
                                        } 
                                        else{
                                            swal({
                                                title: response.title,
                                                text: response.msg,
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
    </script>

@endsection
