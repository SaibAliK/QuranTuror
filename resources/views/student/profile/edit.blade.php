@extends('layouts.student')
@section('title', 'Student Profile')
@section('css')
<link href="{{asset('dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .list{
        width: 100%!important;
    }
</style>
@endsection
@section('content')


    <div class="card  mb-5">

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
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-lg-12 p-3">
                        <form  method="post" enctype="multipart/form-data" action="{{route('student.profile.update')}}">
                            @csrf
                            <input type="hidden" value="{{$student->id}}" name="id">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="hidden" name="image" @if($student->student->image) value="{{$student->student->image}}" @else value="images/default.png" @endif>
                                            <input  type="file" name="image" class="dropify rounded-circle"
                                                    @if(isset($student->student->image))
                                                    data-default-file="{{asset($student->student->image)}}"
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
                                                <input type="text" name="first_name" class="form-control shadow-none rounded-sm @error('first_name') is-invalid @enderror" placeholder="First Name" required value="{{$student->first_name}}">
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
                                                <input type="text" name="last_name" class="form-control shadow-none rounded-sm @error('last_name') is-invalid @enderror" placeholder="Last Name" required value="{{$student->last_name}}">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control  w-100  mb-0 shadow-none rounded-sm @error('gender') is-invalid @enderror" >
                                                <option {{$student->student->gender=='Male'?'selected':''}} value="Male">Male</option>
                                                <option {{$student->student->gender=='Female'?'selected':''}} value="Female">Female</option>
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
                                                <input type="email" name="email" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" placeholder="Email" required value="{{$student->email}}">
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
                                                <input type="date" name="dob" class="form-control shadow-none rounded-sm @error('dob') is-invalid @enderror" placeholder="Date of Birth" required value="{{$student->student->dob}}">
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
                                                <input type="tel" name="phone" class="form-control shadow-none rounded-sm @error('phone') is-invalid @enderror" placeholder="Phone"  value="{{$student->student->phone}}">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Timezone</label>
                                            <select name="time_zone" class="form-control   w-100  mb-0 shadow-none rounded-sm @error('time_zone') is-invalid @enderror time_zone">
                                                <option value="" disabled selected>Select Time Zone</option>
                                                @foreach(time_zone_list() as $item)
                                                    <option value="{{ $item->value }}" @if(auth()->user()->time_zone==$item->value) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('time_zone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Address</label>
                                    <input type="text" value="{{$student->student->address}}" name="address" class="form-control shadow-none rounded-sm @error('address') is-invalid @enderror" required placeholder="Address">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3">
                                    <label>Country</label>
                                    <input type="text" required class="form-control shadow-none rounded-sm @error('country') is-invalid @enderror" name="country" value="{{$student->student->country}}">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="col-lg-3">
                                    <label>City</label>
                                    <input type="text" value="{{$student->student->city}}" name="city" class="form-control shadow-none rounded-sm @error('city') is-invalid @enderror" required placeholder="Address">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary shadow rounded-pill ">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-lg-12 p-3">
                        <form  method="post" enctype="multipart/form-data" action="{{route('student.password.update')}}">
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

        $('select[name="time_zone"]').find('option[value="'+$time_zone+'"]').attr("selected",true);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="{{asset('dropify/dropify.min.js')}}"></script>
    <script src="{{asset('dropify/form-fileuploads.init.js')}}"></script>
@endsection



