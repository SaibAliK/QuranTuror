@extends('layouts.front')
@section('title', 'Home')

@section('content')
    <!-- start of banner -->
    <section class="banner-1 has-overlay bg-cover" style="background-image: url({{ asset('theme/assets/images/banner-image-00.jpg') }});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-2 col-sm-10 mt-5 mt-md-0">
                    
                </div>
                <div class="col-md-8 col-sm-8 text-center text-md-left">
                    <div class="text-white">
                        <h2 class="text-lg mb-30">Reach your personal learning goals faster with our online <span class="has-line line-primary">Quran tutors </span></h2>
                        <p class="h4">With our flexible timings, and tailored courses, our Online Madarassa is a world of opportunity. Join us today for an enhanced tutoring journey.</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-10 mt-5 mt-md-0">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- end of banner -->

    <!-- start of how-it-works section -->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6 mt-40">
                    <div class="how-it-works-item text-center shadow">
                        <img src="{{ asset('theme/assets/images/how-it-works/01.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">One-on-One Interactive Training</h3>
                        <p class="mt-20">A reinforced Quran tuition, available on all streaming platforms, provides the feel of an actual Madarassa. Matching the learning pace and goals of their pupils, our certified tutors provide personalized feedback and Quran teaching.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-40">
                    <div class="how-it-works-item text-center shadow">
                        <img src="{{ asset('theme/assets/images/how-it-works/02.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">Flexible Schedules All Around the Globe</h3>
                        <p class="mt-20">Join anytime from anywhere. Catering the needs of our diversified student group, we offer flexible timings ensuring maximum productivity.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-40">
                    <div class="how-it-works-item text-center shadow">
                        <img src="{{ asset('theme/assets/images/how-it-works/03.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">Certified Tutors for Professional Quran Training</h3>
                        <p class="mt-20">Our group of expert tutors have deep insight and background into the Islamic practicum. Here at Quran Tutor, we don’t compromise on the quality of our tutoring. Our pupils’ satisfaction matters most to us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of how-it-works section -->
    
    
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">How <span class="has-line">Quran Tutor</span> Works?</h2>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="mt-40 text-center hover-grayscale">
                        <img src="{{asset('theme/assets/images/we-offer/02.png') }}" alt="">
                        <h5 class="mt-20 font-weight-600 text-secondary">Select a tutor</h5>
                        <p class="mt-20">Search for your tutor based on your course, expertise, and learning needs. Compare different tutors easily.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="mt-40 text-center hover-grayscale">
                        <img src="{{asset('theme/assets/images/we-offer/03.png') }}" alt="">
                        <h5 class="mt-20 font-weight-600 text-secondary">Connect with professionals</h5>
                        <p class="mt-20">Finding the right fit can be hard, and we understand that. Contact tutors and communicate your needs for free.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="mt-40 text-center hover-grayscale">
                        <img src="{{asset('theme/assets/images/we-offer/01.png') }}" alt="">
                        <h5 class="mt-20 font-weight-600 text-secondary">Register, Select, and Pay</h5>
                        <p class="mt-20">Book the tutor, register for the right course, and make secure payments at ease.</p>
                    </div>
                </div><div class="col-lg-3 col-sm-6">
                    <div class="mt-40 text-center hover-grayscale">
                        <img src="{{asset('theme/assets/images/we-offer/04.png') }}" alt="">
                        <h5 class="mt-20 font-weight-600 text-secondary">Learn and Grow</h5>
                        <p class="mt-20">With one-on-one personalized lessons, reach your goals faster with your tutor.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start of video-popup section -->
    <section class="section-padding pt-3 bg-light has-white-half">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="text-center">
                        <a href="https://www.youtube.com/watch?v=yD7b6R0-LQw" class="d-block has-overlay has-video-popup tansform-none">
                            <img class="img-fluid rounded" src="{{ asset('theme/assets/images/video-thumb-3.jpg') }}" alt="">
                            <img class="play-btn" src="{{ asset('theme/assets/images/video-btn.png') }}" alt="">
                        </a>
                        <h2 class="section-title mt-50 mb-25">Trusted Curriculum, Qualified Tutors, <span class="has-line">Interactive Lessons</span></h2>
                        <p class="mb-40">Catering to the learning needs of [no. of students] + pupils from all around the world, our online Madarassa is trusted and recommended. Together, our pupils and certified tutors, build impacting Islamic journeys. Join our community today and make your goals seem closer!</p>
                        <a href="{{ route('contact') }}" class="btn btn-lg btn-secondary rounded-pill">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of video-popup section -->

    <!-- start of How It Works for tutors section -->
    <section class="section-padding pt-0 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title mb-30">Quran tutoring from the <span class="has-line">comfort of your home</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="how-it-works-item works-item-alt shape-style-1 text-center shadow">
                        <img class="position-static" src="{{ asset('theme/assets/images/how-it-works-tutors/01.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">Online Quran Reading Course for Beginners</h3>
                        <p class="mt-20">Want to learn how to read the Quran in a 100% Arabic accent? Want to learn to identify Huroof-e-Muqatta’aat? Want to read the joint forms of the Arabic alphabet? If so, this course includes the best teaching practices for you. Go from pronouncing the vowels right to reciting the entire Quran fluently (while understanding the rules of Tajweed) in just a few months.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="how-it-works-item works-item-alt shape-style-2 text-center shadow">
                        <img class="position-static" src="{{ asset('theme/assets/images/how-it-works-tutors/02.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">Online Quran Tajweed Course</h3>
                        <p class="mt-20">The Quran tutoring in this course allows pupils of all levels to understand the principles of Tajweed and learn to apply them. The methodology involves memorization practices to successfully enable the pupil to apply these principles. Learning Tajweed is not only an obligation, but helps to rectify the Tarteel, and Qira’at as well.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="how-it-works-item works-item-alt shape-style-1 text-center shadow">
                        <img class="position-static" src="{{ asset('theme/assets/images/how-it-works-tutors/03.png') }}" alt="">
                        <h3 class="mt-20 font-weight-600 text-secondary">Online Quran Memorization Course</h3>
                        <p class="mt-20">Hifz-ul-Quran is on the bucket list of every Muslim. We assist our pupils towards completion of this noble task and retention. With our joint repetition, and revision exercises, we hold you accountable till the end ensuring perfect retention. Trust our process, and we support to till you reach your goal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of How It Works for tutors section -->

    <!-- start of tutors join recently section -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-30">
                <div class="col-lg-9 text-center text-lg-left">
                    <h2 class="section-title mb-0">Tutors <span class="has-line">Joined Recently</span></h2>
                </div>
                <div class="col-lg-3 mt-4 mt-lg-0 text-center text-lg-right">
                    <a href="{{ route('tutors') }}" class="text-primary font-weight-600">Show More</a>
                </div>
            </div>
            <div class="row dashboard">
                @foreach($tutor_list  as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('tutor_profile',$item->tutor->slug) }}">
                                <img @if($item->tutor->image) src="{{ asset($item->tutor->image) }}" @else src="{{ asset('images/default.png') }}" @endif class="card-img" alt="">
                            </a>
                            <div class="card-body">
                                <div class="coach-detail">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <a class="text_theme_color" href="{{ route('tutor_profile',$item->tutor->slug) }}">
                                                <h5 class="mb-0">{{ $item->FULLNAME }}</h5>
                                            </a>
                                        </div>
                                        <div class="float-right">
                                            <h5>${{ $item->tutor->hourly_rate }}</h5>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="min-height: 70px;">
                                        {{ substr($item->tutor->bio,0,18) }}

                                        <a class="btn p-0 readMoreBtn" data-text="{{$item->tutor->bio}}">Read More...</a>
                                    </p>
                                    <div class="clearfix">
                                        <div class="float-left">
                                            @auth
                                                @if(class_complete($item->id))
                                                    @if(!is_student($item->id))
                                                        <a href="{{ route('student.tutor.packages',$item->id) }}" class="btn btn-outline-primary rounded-pill">Buy Package</a>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn active-hired rounded-pill ">Hired</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('redirect',$item->id) }}" class="btn btn-outline-primary rounded-pill">Hire</a>
                                                @endif
                                            @endauth
                                            @guest
                                                <a href="{{ route('redirect',$item->id) }}" class="btn btn-outline-primary rounded-pill">Hire</a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end of tutors join recently section -->

    <!-- start of section -->
    <section class="section-padding pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center">
                    <img class="img-fluid" src="{{ asset('theme/assets/images/free-class.png') }}" alt="">
                </div>
                <div class="col-lg-5 mt-5 mt-lg-0">
                    <h2 class="section-title mb-30">Start learning with professional and experienced <span class="has-line">online Quran teachers</span></h2>
                    <p class="mb-4">
                        Do you often find yourself struggling to make time for the Quran? Struggling to achieve that deen-dunya balance? Regretting not learning the Quran at a young age? It’s never too late. With initiatives like Quran Tutors, all you need is a PC, an internet connection, and the right intention to develop a Quran reading habit. With zero-contract monthly subscription, a trial session, and the best quality weekly bundles, we help you emerge into a supportive community. Achieve your Islamic goals with our help!
    
                    </p>
                    <!--<a href="#!" class="btn btn-lg btn-secondary rounded-pill">Lorem ipsum</a>-->
                </div>
            </div>
        </div>
    </section>
    <!-- end of section -->

@endsection
