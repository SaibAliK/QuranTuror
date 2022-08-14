@extends('layouts.student')
@section('title', 'Student Profile')
@section('css')

@endsection
@section('content')


    <div class="card profile-card mb-5">
        <div class="card-header">
            <h3 class="float-left">Profile Information</h3>
            <a href="{{route('student.edit')}}" class="float-right btn btn-primary">Edit Profile</a>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3">
                    <img class="img-thumbnail profile-image"  @if($student->student->image) src="{{asset($student->student->image)}}" @else src="{{asset('images/default.png')}}" @endif>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">Name</span>
                                    <span class="float-right ">{{$student->FullName}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">Email</span>
                                    <span class="float-right ">{{$student->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">DOB</span>
                                    <span class="float-right ">@if($student->student->dob){{date('d-m-Y',strtotime($student->student->dob))}}@endif</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">Gender</span>
                                    <span class="float-right ">{{$student->student->gender}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">Phone</span>
                                    <span class="float-right ">{{$student->student->phone}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold">Member Since</span>
                                    <span class="float-right ">{{date('d-m-Y',strtotime($student->created_at))}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="float-left font-weight-bold"> Address :</span>
                                    <span class=""> {{$student->student->address}}@if($student->student->city), {{$student->student->city}}@endif @if($student->student->country), {{$student->student->country}}@endif</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @endsection
