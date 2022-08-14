@extends('layouts.tutor')
@section('title', 'Tutor Profile Edit')
@section('css')
    <link href="{{asset('dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" />
    <style>
        .list{
            width: 100%!important;
        }
        .timetable{
            border: 1px solid;
            border-color: #d2d2d2;
            padding: 8px 15px;
        }
        .custom-switch .custom-control-label::after{
            background-color: #113565 !important;
        }
        .custom-control-input:checked~.custom-control-label::after{
            background-color: #ffffff !important;
        }
        .custom-control-input:checked~.custom-control-label::before{
            border-color: #f16001 !important;
            background-color: #f16001 !important;
        }
        .select2-container--default .select2-selection--single 
        {
            height: 42px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered
        {
            line-height: 42px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b
        {
            margin-top:5px !important;
        }
    </style>
@endsection
@section('content')


    <div class="card shadow mb-5">

        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center  ">
                <h2 class="text-center has-line text-dark line-primary">Edit Profile</h2>
            </div>
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center  active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false"> <i class="fa fa-info-circle mr-2"></i> General Information</a>
                </li>
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> <i class="fa fa-lock mr-2"></i> Security</a>
                </li>
                <li class="nav-item waves-effect   waves-light">
                    <a class="nav-link text-center" id="profile-tab" data-toggle="tab" href="#timetable" role="tab" aria-controls="profile" aria-selected="false"> <i class="fa fa-clock mr-2"></i> Timetable</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-lg-12 p-3">
                        <form  method="post" enctype="multipart/form-data" action="{{route('tutor.profile.update')}}">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="id">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="hidden" name="image" @if($user->tutor->image) value="{{$user->tutor->image}}" @else value="images/default.png" @endif>
                                            <input  type="file" name="image" class="dropify rounded-circle"
                                                    @if(isset($user->tutor->image))
                                                    data-default-file="{{asset($user->tutor->image)}}"
                                                    @else
                                                    data-default-file="{{asset('images/default.png')}}"
                                                @endif
                                            >
                                            @csrf
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" class="form-control shadow-none rounded-sm @error('first_name') is-invalid @enderror" placeholder="First Name" required value="{{$user->first_name}}">
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" class="form-control shadow-none rounded-sm @error('last_name') is-invalid @enderror" placeholder="Last Name" required value="{{$user->last_name}}">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Gender</label>
                                            <select name="gender"   class="form-control  w-100  mb-0 shadow-none rounded-sm @error('gender') is-invalid @enderror" >
                                                <option {{$user->tutor->gender=='Male'?'selected':''}} value="Male">Male</option>
                                                <option {{$user->tutor->gender=='Female'?'selected':''}} value="Female">Female</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" placeholder="Email" required value="{{$user->email}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="dob" class="form-control shadow-none rounded-sm @error('dob') is-invalid @enderror" placeholder="Date of Birth" required value="{{$user->tutor->dob}}">
                                                @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="tel" name="phone" class="form-control shadow-none rounded-sm @error('phone') is-invalid @enderror" placeholder="Phone"  value="{{$user->tutor->phone}}">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Timezone</label>
                                        <select name="time_zone" class="form-control   w-100  mb-0 shadow-none rounded-sm @error('time_zone') is-invalid @enderror time_zone">
                                            <option value="" disabled selected>Select Time Zone</option>
                                            @foreach(time_zone_list() as $item)
                                                <option value="{{ $item->value }}" @if(auth()->user()->time_zone==$item->value) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('time_zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select name="location_id" class="form-control time_zone_select shadow-none rounded-sm select2 @error('location_id') is-invalid @enderror">
                                            <option value="" disabled selected>Select Country</option>
                                            @foreach($locations as $item)
                                                <option value="{{ $item->id }}" @if($item->location_id==$item->id) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label>City</label>
                                    <input type="text" value="{{$user->tutor->city}}" name="city" class="form-control shadow-none rounded-sm @error('city') is-invalid @enderror" required placeholder="City">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-2">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control shadow-none rounded-sm @error('address') is-invalid @enderror" required placeholder="Address">{{ $user->tutor->address ?? '' }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <label>Bio Detail</label>
                                    <textarea name="bio" class="form-control shadow-none rounded-sm @error('bio') is-invalid @enderror" required placeholder="Bio Detail" maxlength="100">{{ $user->tutor->bio ?? '' }}</textarea>
                                    @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <label>Profile Description</label>
                                    <textarea name="description" class="form-control shadow-none rounded-sm @error('description') is-invalid @enderror" required placeholder="Profile Description">{{$user->tutor->description ?? ''}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary shadow rounded-pill ">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="timetable" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-lg-12 p-3">
                        <form action="{{ route('tutor.profile.timetable.save') }}" method="POST" class="mt-5">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="timetable">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <p class="font-weight-bold">Day</p>
                                                        <p>Monday</p>
                                                        <p>Tuesday</p>
                                                        <p>Wednesday</p>
                                                        <p>Thursday</p>
                                                        <p>Friday</p>
                                                        <p>Saturday</p>
                                                        <p>Sunday</p>
                                                    </div>
                                                    <div class="col-3 text-center time_boxes">
                                                        <p class="font-weight-bold">Closed/Opened</p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[0]" id="is_closed_monday" {{ count($is_closed) > 0 ? $is_closed[0] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_monday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[1]" id="is_closed_tuesday" {{ count($is_closed) > 0 ? $is_closed[1] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_tuesday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[2]" id="is_closed_wednesday" {{ count($is_closed) > 0 ? $is_closed[2] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_wednesday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[3]" id="is_closed_thursday" {{ count($is_closed) > 0 ? $is_closed[3] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_thursday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[4]" id="is_closed_friday" {{ count($is_closed) > 0 ? $is_closed[4] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_friday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[5]" id="is_closed_saturday" {{ count($is_closed) > 0 ? $is_closed[5] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_saturday"></label>
                                                            </div>
                                                        </p>
                                                        <p class="mb-3">
                                                            <div class="custom-control custom-switch custom-switch-danger">
                                                                <input type="checkbox" class="custom-control-input" value="0" name="is_closed[6]" id="is_closed_sunday" {{ count($is_closed) > 0 ? $is_closed[6] == 0 ? 'checked' : '' : '' }}>
                                                                <label class="custom-control-label" for="is_closed_sunday"></label>
                                                            </div>
                                                        </p>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <p class="font-weight-bold">From</p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[0]" value="{{ count($from) > 0 ? $from[0] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[1]" value="{{ count($from) > 0 ? $from[1] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[2]" value="{{ count($from) > 0 ? $from[2] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[3]" value="{{ count($from) > 0 ? $from[3] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[4]" value="{{ count($from) > 0 ? $from[4] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[5]" value="{{ count($from) > 0 ? $from[5] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="from[6]" value="{{ count($from) > 0 ? $from[6] : '' }}"></p>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <p class="font-weight-bold">To</p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[0]" value="{{ count($from) > 0 ? $to[0] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[1]" value="{{ count($from) > 0 ? $to[1] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[2]" value="{{ count($from) > 0 ? $to[2] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[3]" value="{{ count($from) > 0 ? $to[3] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[4]" value="{{ count($from) > 0 ? $to[4] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[5]" value="{{ count($from) > 0 ? $to[5] : '' }}"></p>
                                                        <p><input type='text' style="height: 24px !important;" class="form-control timepicker text-center" name="to[6]" value="{{ count($from) > 0 ? $to[6] : '' }}"></p>
                                                    </div>
                                                    <div class="col-lg-12 text-center mt-3">
                                                        <button type="submit" class="btn btn-primary shadow rounded-pill ">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default btn-square">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-lg-12 p-3">
                        <form  method="post" enctype="multipart/form-data" action="{{route('tutor.password.update')}}">
                            @csrf
                            <input type="hidden" value="{{auth()->user()->id}}" name="id">
                            <div class="row justify-content-center">

                                <div class="col-lg-8">
                                    <div class="row mb-2">
                                        <div class="col-lg-4 pt-2">
                                            <span class="font-weight-bold">New Password</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="password" name="password" id="password" class="form-control shadow-none rounded-sm @error('password') is-invalid @enderror" required placeholder="New Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 pt-2">
                                            <span class="font-weight-bold">Confirm Password</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="password" name="password_confirmation" id="password" class="form-control shadow-none rounded-sm @error('password_confirmation') is-invalid @enderror" required placeholder="Confirm Password">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary shadow rounded-pill ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $("select").niceSelect('destroy');
        $("select").select2();
        $time_zone = "{{ auth()->user()->time_zone }}";
        $location_id="{{ $user->tutor->location_id }}"
        
        $('select[name="time_zone"]').find('option[value="'+$time_zone+'"]').attr("selected",true);
        $('select[name="location_id"]').find('option[value="'+$location_id+'"]').attr("selected",true);
    </script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="{{asset('dropify/dropify.min.js')}}"></script>
    <script src="{{asset('dropify/form-fileuploads.init.js')}}"></script>
    <!-- Datetimepicker js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $(".timepicker").datetimepicker({
                format: 'LT',
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-bullseye',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                },
            });
        });
    </script>

@endsection




