@extends('layouts.admin')
@section('title', 'Class Schedule')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" />
<style>
    .bmd-form-group [class^='bmd-label'], .bmd-form-group [class*=' bmd-label'] 
    {
        position: relative !important;
    }
</style>
@endsection
@section('nav-title', 'Class Schedule')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Class Schedule</h5>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Tutor</th>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th>Slot</th>
                                    <th>Total Hours</th>
                                    <th>Remaining Hours</th>
                                    <th>Class Status</th>
                                    <th>Created At</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $t_req->id }}</td>
                                        <td>{{ $item->tutor->FullName }}</td>
                                        <td>{{ $item->student->FullName }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->slot }}</td>
                                        <td>{{ $t_req->no_of_hours }}</td>
                                        <td>{{ $t_req->remaining_hours }}</td>
                                        <td>
                                            @if($item->class_status=='completed')
                                                <span class="badge badge-success">{{ ucfirst($item->class_status) }}</span>
                                            @elseif($item->class_status=='pending')
                                                <span class="badge badge-info">{{ ucfirst($item->class_status) }}</span>
                                            @elseif($item->class_status=='cancelled')
                                                <span class="badge badge-warning">{{ ucfirst($item->class_status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                        <td class="td-actions text-right">
                                            @if($item->class_status=='pending')
                                                <button type="button" class="btn btn-info btn-round edit_btn" data-id="{{ $item->id }}">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            @endif
                                            <button type="button"  onclick="deleteAlert('{{ route('admin.request_tutor.schedule.delete', $item->id) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
                                                <i class="material-icons">close</i>
                                            </button>
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

    <!-- Modal -->
    <div class="modal fade" id="editRequestTutor" tabindex="" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        
    </div>
    <!-- /Modal -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous"></script>
    <script>
        $(document).on("click",".edit_btn",function(){
            var id=$(this).attr("data-id");
            editRequestForm(id);
            
        });
        function editRequestForm(id)
        {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.request_tutor.ajax.edit') }}?id="+id,
                success: function (response) {
                    $('#editRequestTutor').html(response);
                    $(function() {
                        $('.clockpicker').clockpicker({
                            placement: 'bottom',
                            align: 'left',
                            autoclose: true,
                            default: 'now',
                            donetext: "Select",
                            twelvehour: true,
                        });
                    });
                    $(function() {
                        $( ".datepicker" ).datepicker();
                    });
                    $(function(){
                        $(".timepicker").datetimepicker({
                            format: 'LT',
                            icons: {
                                time: 'fa fa-clock-o',
                                date: 'fa fa-calendar',
                                up: 'fa fa-chevron-up',
                                down: 'fa fa-chevron-down',
                                previous: 'fa fa-chevron-left',
                                next: 'fa fa-chevron-right',
                                today: 'fa fa-bullseye',
                                clear: 'fa fa-trash',
                                close: 'fa fa-times'
                            },
                        });
                    });
                    $("#editRequestTutor").modal("show");
                }
            });
        }
    </script>

@endsection

