@extends('layouts.admin')
@section('title', 'Class Schedule')
@section('css')

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
                                        <th>ID</th>
                                        <th>Tutor</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>Active Date</th>
                                        <th>Slot</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $item->tutor->FullName ?? ""}}</td>
                                            <td>{{ $item->student->FullName ?? ""}}</td>
                                            <td>{{ $item->date ?? ""}}</td>
                                            <td>{{ $item->active_date ?? ""}}</td>
                                            <td>{{ $item->slot ?? ""}}</td>
                                            <td>
                                                @if($item->class_status=="completed")
                                                <span class="badge badge-success">Completed</span>
                                                @else
                                                <span class="badge badge-danger">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y',strtotime($item->created_at)) ?? ""}}</td>
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

@endsection

