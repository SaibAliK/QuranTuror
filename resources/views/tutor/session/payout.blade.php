@extends('layouts.tutor')
@section('title', 'Payout')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/r-2.2.7/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />
@endsection


@section('content')

<div class="card ">

    <div class="card-body">
        <div class="col-lg-12 mb-3 text-center  ">
            <h2 class="text-center has-line text-dark line-primary">Payout Record</h2>
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
                                    <th>Tutor</th>
                                    <th>Student</th>
                                    <th>Meeting Session ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutor_payouts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tutor->first_name ?? "" }}</td>
                                    <td>{{ $item->student->first_name  ?? ""}}</td>
                                    <td>{{ $item->meeting_session_id ?? ""}}</td>
                                    <td>{{ $item->amount ?? "" }}</td>
                                    <td>
                                        @if($item->status=='unpaid')
                                        <span class="badge badge-primary">{{ 'unpaid' }}</span>
                                        @elseif($item->status=='paid')
                                        <span class="badge badge-success">{{ 'paid' }}</span>
                                        @else
                                        <span class="badge badge-warning">{{ 'Refund' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->created_at ?? ""}}
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
