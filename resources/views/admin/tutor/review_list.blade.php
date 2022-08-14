@extends('layouts.admin')
@section('title', 'Tutor Reviews')
@section('nav-title', 'Tutor Reviews')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon"><i class="material-icons">list</i></div>
                    <h5 class="card-title">Tutor Reviews</h5>
                </div>
                <div class="card-body">
                    <div class="toolbar text-right">
                        <a href="{{ route('admin.tutor.review.add',['id'=>request()->id]) }}" class="btn btn-rose">+ Add</a>
                    </div>
                    <div class="material-datatables">
                        <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tutor Name</th>
                                    <th>Student Name</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Created Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tutor->FullName ?? '' }}</td>
                                        <td>{{ $item->student->FullName ?? '' }}</td>
                                        <td>
                                            @if ($item->rating ?? false)
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if (floor($item->rating) - $i >= 1)
                                                        {{--Full Star--}}
                                                        <i style="color: #FFC125;" class="fa fa-star"></i>
                                                    @elseif ($item->rating - $i > 0)
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
                                        <td>{{ $item->review }}</td>
                                        <td>{{ date('d-m-Y',strtotime($tutor->created_at)) }}</td>

                                        <td class="td-actions text-right">
                                            <button type="button"  onclick="deleteAlert('{{ route('admin.tutor.review.delete', ['id'=>$item->id]) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
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

