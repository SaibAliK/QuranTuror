@extends('layouts.admin')
@section('title', 'Add Package')
@section('nav-title', 'Add Package')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.package.save') }}" method="POST">
                    @csrf
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <h5 class="card-title">Add Package</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name"> Name *</label>
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
                                        <label for="last_name"> Hours *</label>
                                        <input type="number" class="form-control @error('hours') is-invalid @enderror" id="hours" required="true" name="hours">
                                        @error('hours')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name"> Amount / Hour *</label>
                                        <input type="number" class="form-control @error('per_hour_amount') is-invalid @enderror" id="per_hour_amount" required="true" name="per_hour_amount">
                                        @error('per_hour_amount')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="bio">Description </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"  name="description" maxlength="100" required="true"></textarea>
                                        @error('description')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer mt-4">
                            <button type="submit" class="btn btn-rose">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

