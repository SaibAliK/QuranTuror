@extends('layouts.admin')
@section('title', 'Tutors')
@section('nav-title', 'Tutors')

@section('css')
    <style>
        .form-group input[type=file] {
            opacity: initial !important;
            position: initial !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon"><i class="material-icons">list</i></div>
                    <h5 class="card-title">Tutors</h5>
                </div>
                <div class="card-body">
                    <div class="toolbar text-right">
                        <a href="{{ route('admin.tutor.add') }}" class="btn btn-rose">+ Add Tutor</a>
                    </div>
                    <div class="material-datatables">
                        <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Unpaid Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Country</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Hourly rate</th>
                                    <th>Bio</th>
                                    <th>Feature/Unfeature</th>
                                    <th>Member Since</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutors as $tutor)
                                    <tr>
                                        <td>{{ $tutor->id }}</td>
                                        <td>{{ $tutor->FullName }}</td>
                                        <td>${{ $tutor->tutor->unpaid_amount ?? 'N/A' }}</td>
                                        <td>${{ $tutor->tutor->paid_amount ?? 'N/A' }}</td>
                                        <td>
                                            {{ $tutor->tutor->location->name ?? '' }} 
                                            <img src="{{ asset($tutor->tutor->location->flag ?? '') }}" width="16" height="12">
                                        </td>
                                        <td>{{ $tutor->email }}</td>
                                        <td>{{ $tutor->tutor->gender }}</td>
                                        <td>{{ $tutor->tutor->phone }}</td>
                                        <td>{{ $tutor->tutor->hourly_rate }}</td>
                                        <td>{{ $tutor->tutor->bio }}</td>
                                        <td>
                                            @if($tutor->tutor->is_feature == 0)
                                            <span class="badge btn-round btn-sm badge-danger">Un-Feature</span>
                                            @else
                                            <span class="badge btn-round btn-sm badge-success">Feature</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y',strtotime($tutor->created_at)) }}</td>

                                        <td class="td-actions text-right">
                                            <a href="{{ route('admin.tutor.history',['id'=>$tutor->id]) }}" class="btn btn-warning">History</a>
                                            <a href="{{ route('admin.tutor.review.list',['id'=>$tutor->id]) }}" class="btn btn-info">Reviews</a>
                                            @if($tutor->tutor->unpaid_amount>0)
                                                <a data-amount="{{ $tutor->tutor->unpaid_amount }}" data-id="{{ $tutor->id }}" href="javascript:void(0);" data-href="{{ route('admin.tutor.review.list',['id'=>$tutor->id]) }}" class="btn btn-primary payTutorButton">Pay Tutor</a>
                                            @else

                                            @endif
                                            @if($tutor->tutor->is_feature == 0)
                                                <a href="{{route('admin.tutor.featureStatus',$tutor->id)}}" class="btn btn-success btn-round"><span class="material-icons">
                                                    thumb_up_off_alt
                                                </span></a>
                                            @else
                                                <a href="{{route('admin.tutor.featureStatus',$tutor->id)}}" class="btn btn-danger btn-round"><span class="material-icons">
                                                    thumb_down_off_alt
                                                </span></a>
                                            @endif

                                            <a href="{{route('admin.tutor.edit' , $tutor->id)}}" class="btn btn-info btn-round delete-btn"> <i class="material-icons">edit</i></a>
                                            <button type="button"  onclick="deleteAlert('{{ route('admin.tutor.delete', $tutor->id) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
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
<div class="modal fade" id="payTutorModal" tabindex="" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold mt-0">Pay Tutor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="{{ route('admin.tutor.pay') }}" id="payTutorForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="tutor_id" name="id" value="">
                <div class="modal-body edit_modal_body">
                    <div class="form-group">
                        <label for="date"> Amount *</label>
                        <input type="text" class="form-control position-relative unpaid_amount @error('amount') is-invalid @enderror" value="" id="date" required="true" name="amount" autocomplete="off">
                        @error('amount')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                    <div class="form-group">
                        <label for="date"> File *</label>
                        <input type="file" class="@error('file') is-invalid @enderror" value="" id="file" required="true" name="file" accept="image/*" >
                        @error('file')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                    <div class="form-group">
                        <label for="date"> Note *</label>
                        <textarea name="note" class="form-control"></textarea>
                        @error('note')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-rose mr-2">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal -->
@endsection
@section('js')

<script>
    $(document).on("click",".payTutorButton",function(){
        var $tutor_id=$(this).attr("data-id");
        var $unpaid_amount=$(this).attr("data-amount");
        $(".tutor_id").val($tutor_id);
        $(".unpaid_amount").val($unpaid_amount);
        $("#payTutorModal").modal("show");
    });
</script>

@endsection

