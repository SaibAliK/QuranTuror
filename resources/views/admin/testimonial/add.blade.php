@extends('layouts.admin')
@section('title', 'Add Testimonial')
@section('nav-title', 'Add Testimonial')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.testimonial.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <h5 class="card-title">Add Testimonial</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name"> User Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" required="true" name="name">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address"> Address *</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" required="true" name="address">
                                        @error('address')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="review"> Review *</label>
                                       <textarea id="review" rows="6" class="form-control" name="review"></textarea>
                                        @error('review')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-4">
                            <button type="submit" class="btn btn-rose">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
