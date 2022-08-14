@extends('layouts.front')
@section('title')
    {{ $tutor->user->FullName ?? "" }}
@endsection

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">{{ $tutor->user->FullName ?? '' }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">{{ $tutor->user->FullName ?? '' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding tutor_profile_section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-12 profile_box">
                    <img class="img-fluid rounded-circle" width="100" height="100" src="{{ asset('images/default.png') }}">
                </div>
                <div class="col-lg-7 col-md-12 tutor_name_main_col">
                    <h4 class="section-title mb-30">
                        <i class="fa fa-check-circle text-success" title="Featured &amp; Verified Tutor"></i>
                        @if($tutor->location->name=='Pakistan')
                            <img src="{{ asset('images/certified-badge.png') }}" width="70">
                        @endif
                        {{ $tutor->user->FullName ?? '' }}
                    </h4>
                    <div class="row stars_row"> 
                        <div class="col-lg-8 col-sm-12 col-12 text-left"> 
                            <h6 class="text-warning semibold" id="stars"> 
                                 @for($i=1;$i<=5;$i++)
                                    <i class="fa fa-star @if($i<=floor($reviews_list->avg('rating'))) text-warning @else grey_star @endif"></i>
                                @endfor
                                
                            </h6>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary rounded-pill w-100">Hire me</button>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mt-4">
                    <h6 class="text-secondary font-weight-bold mb-2 section_title">Introduction</h6>
                </div>
            </div>
            <div class="row align-items-center bb_grey">
                <div class="col-lg-3 col-md-12 mt-4">
                    <span class="font-weight-bold">Date Of Birth</span>
                </div>
                <div class="col-lg-9 col-md-12 mt-4">
                    {{ $tutor->dob ?? '' }}
                </div>
            </div>
            <div class="row align-items-center bb_grey">
                <div class="col-lg-3 col-md-12 mt-4">
                    <span class="font-weight-bold">Email</span>
                </div>
                <div class="col-lg-9 col-md-12 mt-4">
                    {{ $tutor->user->email ?? '' }}
                </div>
            </div>
            <div class="row align-items-center bb_grey">
                <div class="col-lg-3 col-md-12 mt-4">
                    <span class="font-weight-bold">Country</span>
                </div>
                <div class="col-lg-9 col-md-12 mt-4">
                    {{ $tutor->location->name ?? '' }} <img src="{{ asset($tutor->location->flag ?? '') }}" height="12" width="16">
                </div>
            </div>
            <div class="row align-items-center bb_grey">
                <div class="col-lg-3 col-md-12 mt-4">
                    <span class="font-weight-bold">Bio</span>
                </div>
                <div class="col-lg-9 col-md-12 mt-4">
                    {{ $tutor->bio ?? '' }} 
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mt-4">
                    <h6 class="text-secondary font-weight-bold mb-2 section_title">Tutor Detail</h6>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mt-4">
                    <p>{!! $tutor->description ?? '' !!}</p>
                </div>
            </div>
            <!-- Reviews Of Tutor -->
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mt-4">
                    <h6 class="text-secondary font-weight-bold mb-2 section_title">Reviews</h6>
                </div>
            </div>
            <div class="reviews-comment">
                <ul class="reviews-comments-items">
                    @foreach($reviews_list as $review)
                        <li>
                            <div class="single-reviews-comment">
                                <div class="comment-content content_block">
                                    <div class="rating-name">
                                        <div class="author-name">
                                            <h4 class="name"> {{ $review->user->FullName ?? '' }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            @for($i=1;$i<=5;$i++)
                                                <li><i class="fa fa-star @if($i<=floor($review->rating)) text-warning @endif"></i></li>
                                            @endfor
                                        </ul>
                                        <ul class="d-flex ml-3">
                                            <li>{{ $review->created_at->diffForHumans() }}</li>
                                        </ul>
                                    </div>
                                    
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @if($show_more)
                    <div class="more-reviews">
                        <form>
                            <input type="hidden" name="show" value="all">
                            <button class="btn btn-primary rounded-sm">See more reviews ({{ $count-5 ?? '0' }})</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
