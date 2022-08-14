@extends('layouts.tutor')
@section('title', 'Sessions')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/r-2.2.7/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />
@endsection


@section('content')

<div class="card ">

    <div class="card-body">
        <div class="col-lg-12 mb-3 text-center  ">
            <h2 class="text-center has-line text-dark line-primary">Sessions</h2>
        </div>
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item waves-effect   waves-light">
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="col-lg-12 p-3">
                    <div class="table-responsive">
                        <table class="table datatables" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Time Taken</th>
                                    <th>Ratings</th>
                                    <th>Reviews</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($session as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->student->FullName }}</td>
                                        <td>{{ $item->time_taken }} mins</td>
                                        <td>
                                            @if ($item->reviews->where('user_id',$item->student_id)->first()->rating ?? false)
                                            @for ($i = 0; $i < 5; $i++)
                                            @if (floor($item->reviews->where('user_id',$item->student_id)->first()->rating) - $i >= 1)
                                            {{--Full Star--}}
                                            <i style="color: #FFC125;" class="fa fa-star"></i>
                                            @elseif ($item->reviews->where('user_id',$item->student_id)->first()->rating - $i > 0)
                                            {{--Half Star--}}
                                            <i style="color: #FFC125;" class="fa fa-star-half-o"></i>
                                            @else
                                            {{--Empty Star--}}
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            @endif
                                            @endfor
                                            @else
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->reviews->where('user_id',$item->student_id)->first()->review ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @if(is_review_submitted($item->id))

                                                -------
                                            @else
                                                <a href="{{route('tutor.review.add', $item->id)}}" class="btn btn-primary rounded-circle btn-round">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<!-- DatePicker Js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>
    $(document).on("click",".set_schedule_btn",function(){
        var req_id=$(this).attr('data-id');
        $('#date_picker').datepicker();
        $(".req_field").val(req_id);
    });
    $(document).on("change","#date_picker", function(){
        var date=$(this).val();
        $(".error-div .invalid-feedback").css('display', 'none');
        var id='{{ auth()->user()->id }}';
        tutorTimeList(id,date);
    });
</script>


@endsection
