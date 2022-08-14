@extends('layouts.front')
@section('title', 'Register')
@section('css')

<style>
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

    <section class="banner-1 p-5 has-overlay bg-cover" style="background-image: url({{asset('theme/assets/images/banner-image-00.jpg')}});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-8 col-sm-10 mt-5 mt-md-0">
                    <h2 class="text-center text-white mb-2"><span class="has-line line-primary">Register Here</span></h2>
                    <form method="POST" action="{{ route('register') }}" class="search-form rounded">

                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <input type="text" value="{{old('first_name')}}" class="form-control shadow-none rounded-sm @error('first_name') is-invalid @enderror" name="first_name" required placeholder="First Name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="text"  value="{{old('last_name')}}" class="form-control shadow-none rounded-sm @error('last_name') is-invalid @enderror" name="last_name" required placeholder="Last Name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="email"  value="{{old('email')}}" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" name="email"  placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <select name="gender"  value="{{old('gender')}}" class="form-control  h-100 mb-0 shadow-none rounded-sm @error('gender') is-invalid @enderror select_gender" >
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-lg-12 mb-4">
                                <select name="time_zone" class="form-control time_zone_select shadow-none rounded-sm select2 @error('time_zone') is-invalid @enderror">
                                    <option value="" disabled selected>Select Time Zone</option>
                                    @foreach(time_zone_list() as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('time_zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="password"    class="form-control shadow-none rounded-sm @error('password') is-invalid @enderror" name="password" required placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="password" class="form-control shadow-none rounded-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="Confirm Password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="col-lg-12 mb-2">
                                <button type="submit" class="btn btn-primary rounded-pill w-100">Sign up</button>
                            </div>
                        </div>
                        <h6 class="text-white">Already have an account. <a href="{{route('login')}}" class="text-primary">Login</a> </h6>

                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('js')

    <script>
        $("select").niceSelect('destroy');
        $("select").select2();
    </script>

@endsection
