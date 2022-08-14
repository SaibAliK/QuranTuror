@extends('layouts.student')
@section('title', 'Your Requests')
@section('css')
@endsection
@section('content')

    <div class="card ">

        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center  ">
                <h2 class="text-center has-line text-dark line-primary">Your Requests</h2>
            </div>
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center  active" id="home-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false"> <i class="fa fa-clock-o mr-2"></i> Pending</a>
                </li>
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center" id="profile-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false"> <i class="fa fa-check mr-2"></i> Approved</a>
                </li>
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center" id="profile-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false"> <i class="fa fa-window-close mr-2"></i> Cancelled</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="col-lg-12 p-3">
                        <table class="table w-100 display" >
                            <thead>
                            <tr>
                                <th>Tutor Name</th>
                                <th>Email</th>
                                <th>Start Date</th>
                                <th>Time</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($pending as $request)
                                <tr>
                                    <td>{{$request->tutor->FullName}}</td>
                                    <td>{{$request->tutor->email}}</td>
                                    <td>{{$request->date}}</td>
                                    <td>{{$request->slot}}</td>
                                    <td>{{date('d/m/Y',strtotime($request->created_at))}}</td>
                                    <td class="text-right">
                                        <a href="javascript:void(0);" data-href="{{route('student.tutor.request.cancel',['id'=>$request->id])}}"   rel="tooltip" class="btn btn-danger rounded-circle btn-round cancel_button" data-original-title="Cancel Request" title="Request Cancel">
                                            <i class="fa fa-window-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade show" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="col-lg-12 p-3">
                        <table class="table w-100 display" >
                            <thead>
                            <tr>
                                <th>Tutor Name</th>
                                <th>Email</th>
                                <th>Start Date</th>
                                <th>Time</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($approved as $approve)
                                <tr>
                                    <td>{{$approve->tutor->FullName}}</td>
                                    <td>{{$approve->tutor->email}}</td>
                                    <td>{{$approve->date}}</td>
                                    <td>{{$approve->slot}}</td>

                                    <td>{{date('d/m/Y',strtotime($approve->created_at))}}</td>
                                    <td class="text-right">

                                        <a href="javascript:void(0);" data-href="{{route('student.tutor.request.cancel',['id'=>$approve->id])}}"   rel="tooltip" class="btn btn-danger rounded-circle btn-round cancel_button" data-original-title="Cancel Request" title="Request Cancel">
                                            <i class="fa fa-window-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <div class="col-lg-12 p-3">
                        <table class="table w-100 display" >
                            <thead>
                            <tr>
                                <th>Tutor Name</th>
                                <th>Email</th>
                                <th>Start Date</th>
                                <th>Time</th>
                                <th>Request Date</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cancelled as $cancel)
                                <tr>
                                    <td>{{$cancel->tutor->FullName}}</td>
                                    <td>{{$cancel->tutor->email}}</td>
                                    <td>{{$cancel->date}}</td>
                                    <td>{{$cancel->slot}}</td>

                                    <td>{{date('d/m/Y',strtotime($cancel->created_at))}}</td>
                                    {{--<td class="text-right">
                                        <a href="{{route('tutor.student.request.approve',['id'=>$cancel->id])}}" type="button"  rel="tooltip" class="btn btn-success rounded-circle btn-round " data-original-title="Cancel Approve" title="Request Approve">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Approve Modal -->
    <div class="modal fade rounded" id="approveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Are you want to approve ?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm approve_link" type="submit">Yes</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Approve Modal -->

    <!-- Cancel Modal -->
    <div class="modal fade rounded" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Are you want to cancel request ?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm cancel_link" type="submit">Yes </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cancel Modal -->
@endsection
@section('js')

    <script>
        $(document).ready(function () {

            $('table.display').dataTable({
                "responsive":true,
                "scrollX": true
            });
        });

        // Approve Modal Jquery
        $(document).on("click",".approve_button",function(){
            var approve_link=$(this).attr('data-href');
            $(".approve_link").attr("href",approve_link);
            $("#approveModal").modal('show');
        });

        // Cancel Modal Jquery
        $(document).on("click",".cancel_button",function(){
            var cancel_link=$(this).attr('data-href');
            $(".cancel_link").attr("href",cancel_link);
            $("#cancelModal").modal('show');
        });
    </script>

@endsection
