@extends('layouts.admin')
@section('title', 'Add Student')
@section('nav-title', 'Add Student')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.student.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="student">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <h5 class="card-title">Add Student</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name"> First Name *</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="name" required="true" name="first_name">
                                        @error('first_name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name"> Last Name *</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" required="true" name="last_name">
                                        @error('last_name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email"> Email *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" required="true" name="email">
                                        @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password"> Password *</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" required="true" name="password">
                                        @error('password')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password"> Phone </label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"  name="phone" required="true">
                                        @error('phone')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-control" for="gender">Gender</label>
                                        <select class="form-control select2 position-relative @error('gender') is-invalid @enderror" id="gender" name="gender" required="true">
                                            <option value="" disabled>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('gender')
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

