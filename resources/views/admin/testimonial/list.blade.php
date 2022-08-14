@extends('layouts.admin')
@section('title', 'Testimonials')
@section('nav-title', 'Testimonials')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Testimonials</h5>
                    </div>
                    <div class="card-body">
                        <div class="toolbar text-right">
                            <a href="{{ route('admin.testimonial.add') }}" class="btn btn-rose">+ Add</a>
                        </div>
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Review</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name ?? '' }}</td>
                                            <td>{{ $item->address ?? '' }}</td>
                                            <td>{{ Str::limit($item->review, 50, ' (...)') }}<a href="javascript:void(0);" class="read_more" data-value="{{ $item->review }}">Read more</a></td>
                                            <td class="td-actions text-right">
                                                <a href="{{ route('admin.testimonial.edit',$item->id) }}">
                                                    <button type="button" class="btn btn-info btn-round">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0);" onclick="alertMessage('{{ route('admin.testimonial.delete',$item->id) }}','You are deleting location')">
                                                    <button type="button" class="btn btn-danger btn-round">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </a>
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

<!-- Modal -->
{{-- <div class="modal fade" id="payTutorModal" tabindex="" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
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
<!-- /Modal --> --}}
<div class="modal fade" id="readMoreModal" tabindex="" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
                <p class="review_detail">
                    
                </p>
            </div>

        </div>
    </div>
</div>
<!-- /Modal -->
@endsection
@section('js')

<script>
    $(document).on("click", ".read_more", function(){
        var $review = $(this).attr("data-value");
        $(".review_detail").html($review);
        $("#readMoreModal").modal("show");
    });
</script>

@endsection

