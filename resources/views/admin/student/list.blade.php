@extends('layouts.admin')
@section('title', 'Students')
@section('nav-title', 'Students')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon"><i class="material-icons">list</i></div>
                    <h5 class="card-title">Students</h5>
                </div>
                <div class="card-body">
                    <div class="toolbar text-right">
                        <a href="{{ route('admin.student.add') }}" class="btn btn-rose">+ Add Student</a>
                    </div>
                    <div class="material-datatables">
                        <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Member Since</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->FullName ?? '' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->student->gender ?? ''}}</td>
                                    <td>{{ $item->student->phone ?? '' }}</td>
                                    <td>
                                        @if($item->student->status == "approve")
                                            <span class="badge btn-round btn-sm badge-success">Approve</span>
                                        @else
                                        <span class="badge btn-round btn-sm badge-danger">Disapprove</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                    <td class="td-actions text-right">
                                        @if($item->student->status == "approve")
                                        <a href="{{route('admin.student.status',$item->id)}}" class="btn btn-danger btn-round"><span class="material-icons">
                                            thumb_down_off_alt
                                        </span></a>
                                        @else
                                        <a href="{{route('admin.student.status',$item->id)}}" class="btn btn-info btn-round"><span class="material-icons">
                                            thumb_up_off_alt
                                        </span></a>
                                        @endif
                                        <button type="button"  onclick="deleteAlert('{{ route('admin.student.delete', $item->id) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
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
@endsection
@section('js')

@endsection

