@extends('layouts.front')
@section('title', 'Tutor Register')
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
    .has-overlay::after {
    background-color: #2d2929;
    opacity: .7;
    }

    .overlay-box-item
    {
        border: 1px solid white;
        border-radius: 5px;
        /*padding: 20px;*/
        /*margin: 5px;*/
        /*box-sizing: border-box;*/
        width: 300px;
    }
    .mt_custom
    {
        margin-top: -30px;
    }
</style>

@endsection
@section('content')

    <section class="banner-1 p-5 has-overlay bg-cover" style="background-image: url({{asset('theme/assets/images/banner-image-00.jpg')}});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-8 col-sm-10 mt-5 mt-md-0">
                    <h2 class="text-center text-white mb-2"><span class="has-line line-primary">Register As Tutor Here</span></h2>
                    <form method="POST" action="{{ route('register') }}" class="search-form rounded">
                        @csrf
                        <input type="hidden" name="role" value="tutor">
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

                            <div class="col-lg-6 mb-4">
                                <input type="password" class="form-control shadow-none rounded-sm @error('password') is-invalid @enderror" name="password" required placeholder="Password">
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
                                <select name="location_id" class="form-control time_zone_select shadow-none rounded-sm select2 @error('location_id') is-invalid @enderror">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($locations as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <input type="date" class="form-control shadow-none rounded-sm @error('dob') is-invalid @enderror" name="dob" required placeholder="Hourly Rate">
                                @error('dob')
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

    <!-- Titles Section -->
    <section style="background: #f7f7f7;" class="section-padding">
        <div class="container">
          <div class="row justify-content-center">
             <div class="col-lg-4  col-sm-12">
                <div class="mt-40 text-center hover-grayscale">
                   <i class="fas fa-book text-primary fa-2x"></i>
                   <h3 class="mt-20 font-weight-600 text-secondary">Choose Your Course</h3>
                   <p class="mt-20">We currently offer three courses with different bases; from primary reading to Tajweed application, to complete memorization of the Quran, our pupils search for the best tutors.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-12">
                <div class="mt-40 text-center hover-grayscale">
                   <i class="fas fa-hand-holding-usd text-primary fa-2x text-primary fa-2x"></i>
                   <h3 class="mt-20 font-weight-600 text-secondary">Marketing</h3>
                   <p class="mt-20">A whole student base visits your profile, we bring to you a world of opportunity for online career opportunities.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-12">
                <div class="mt-40 text-center hover-grayscale">
                   <i class="far fa-calendar-alt text-primary fa-2x"></i>
                   <h3 class="mt-20 font-weight-600 text-secondary">Flexible Schedules</h3>
                   <p class="mt-20">Choose your timings, work as your schedule allows whether its work or university, your convenience is accounted for.</p>
                </div>
             </div>
          </div>
       </div>
    </section>

    <!-- Video Section -->
    <section class="section-padding">
        <div class="container">
          <div class="row justify-content-center">
             <div class="col-lg-6  col-sm-12 pt-5">
                <div class="mt-40 hover-grayscale">
                   <h3 class="mt-20 font-weight-600 text-secondary">Pay Bills, Impact Lives, and Earn Rewards in One Sitting!</h3>
                   <p class="mt-20 text-justify">We support you throughout your tutoring journey. From providing access to students, to stable marketing, we optimize your tutoring business. Work at flexible timings, earn with comfort, and great a striking CV that benefits your career.</p>
                </div>
             </div>
             <div class="col-lg-6 col-sm-12">
                <div class="mt-40 text-center hover-grayscale">
                   {{-- <div class="embed-responsive embed-responsive-16by9">
                        <video width="100%" height="240" controls>
                            <source src="{{ asset('videos/test.mp4') }}" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                        </video>
                    </div>   --}} 
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/1SZle1skb84" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>        
                </div>
             </div>
          </div>
       </div>
    </section>

    <section class="has-overlay bg-cover section-padding" style="background-image:url({{ asset('images/footer_image.jpg') }})">
        <div class="container">
            <div class="row justify-content-center text-white">
                <div class="col-lg-12 col-sm-12 text-center mt-2">
                    <h3 class="mt-20 font-weight-600">Want to Get Started? Here’s how:</h3>
                    <p>
                        With Quran tutor, registration is a smooth process. Get verified, upgrade your business, get paid securely.
                    </p>
                </div>
                 <div class="col-lg-3  col-sm-12">
                    <div class="mt-40 text-center hover-grayscale">
                       <h3 class="mt-20 font-weight-600">
                           <i class="fas fa-home text-white fa-2x"></i>
                       </h3>
                       <p class="mt-20">
                            1. Select a tutor
                        </p>
                    </div>
                 </div>
                 <div class="col-lg-3 col-sm-12">
                    <div class="mt-40 text-center hover-grayscale">
                       <h3 class="mt-20 font-weight-600">
                           <i class="fas fa-book text-white fa-2x"></i>
                       </h3>
                       <p class="mt-20">
                            2. Connect with professionals
                        </p>
                    </div>
                 </div>
                 <div class="col-lg-3 col-sm-12">
                    <div class="mt-40 text-center hover-grayscale">
                       <h3 class="mt-20 font-weight-600">
                           <i class="fas fa-book-reader text-white fa-2x"></i>
                       </h3>
                       <p class="mt-20">
                            3. Register, Select, and Pay
                        </p>
                    </div>
                 </div>
                 <div class="col-lg-3 col-sm-12">
                    <div class="mt-40 text-center hover-grayscale">
                       <h3 class="mt-20 font-weight-600">
                           <i class="far fa-calendar-alt text-white fa-2x"></i>
                       </h3>
                       <p class="mt-20">
                            4. Learn and Grow
                        </p>
                    </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <!-- start of tutor carousel -->
<section style="background: #f7f7f7;" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-title">Our Community of Experts</h2>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ asset('images/image_book.jpg') }}" alt="">
             </div>
             <div class="col-lg-6 mt-5">
                <div class="owl-carousel tutor-carousel">
                    @foreach(testimonials() as $item)
                        <div class="tutor-item bg-white p-30">
                          <p>{{ $item->review ?? '' }}</p>
                          <div class="media d-block d-sm-flex mt-25">
                             <img src="assets/images/user-01.jpg" alt="">
                             <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                <h4 class="font-weight-600 text-blue mb-1">{{ $item->name ?? '' }}</h4>
                                <p>{{ $item->address ?? '' }}</p>
                             </div>
                          </div>
                        </div>
                   @endforeach
                </div>
             </div>
        </div>
    </div>
</section>
<!-- end of tutor carousel -->



@endsection
@section('js')

    <script>
        $("select").niceSelect('destroy');
        $("select").select2();
    </script>

@endsection
