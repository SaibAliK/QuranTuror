@extends('layouts.admin')
@section('title', 'Sessions')
@section('nav-title', 'Sessions')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon"><i class="material-icons">list</i></div>
                    <h5 class="card-title">Sessions</h5>
                </div>
                <div class="card-body">
                    <div class="material-datatables">
                        <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tutor</th>
                                    <th>Student</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Student Joined</th>
                                    <th>Ratings</th>
                                    <th>Students Feedback</th>
                                    <th>Tutors Feedback</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tutor->FullName }}</td>
                                    <td>{{ $item->student->FullName }}</td>
                                    <td>{{ $item->time_taken }} mins</td>
                                    <td>
                                        @if($item->status==0)
                                        <span class="badge badge-info">{{ 'Not Started' }}</span>
                                        @elseif($item->status==1)
                                        <span class="badge badge-success">{{ 'Started' }}</span>
                                        @else
                                        <span class="badge badge-warning">{{ 'Ended' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->student_joined)
                                        <span class="badge badge-success">{{ 'Yes' }}</span>
                                        @else
                                        <span class="badge badge-info">{{ 'No' }}</span>
                                        @endif
                                    </td>
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
                                        {{ $item->reviews->where('user_id',$item->student_id)->first()->review  ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $item->reviews->where('user_id',$item->tutor_id)->first()->review  ?? 'N/A' }}
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button"  onclick="deleteAlert('{{ route('admin.sessions.delete', $item->id) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
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

