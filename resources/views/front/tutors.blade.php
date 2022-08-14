@extends('layouts.front')
@section('title', 'Tutors')

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">Tutors</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">Tutors</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- start of tutors join recently section -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-30">
                <div class="col-lg-9 text-center text-lg-left">
                    <h2 class="section-title mb-0">Tutors </h2>
                </div>
                <div class="col-lg-3 mt-4 mt-lg-0 text-center text-lg-right">
                </div>
            </div>
            <div class="row dashboard">
                @foreach($tutor_list  as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <img @if($item->tutor->image) src="{{ asset($item->tutor->image) }}" @else src="{{ asset('images/default.png') }}" @endif class="card-img" alt="">
                            <div class="card-body">
                                <div class="coach-detail">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <h5 class="mb-0">{{ $item->FULLNAME }}</h5>
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

@endsection
