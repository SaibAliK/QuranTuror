@extends('layouts.front')
@section('title', 'Blog')

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">Latest Blog</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding pb-fix">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/01.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem ipsum</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> LoremIpsum</span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem </a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/02.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem Ipsum</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Lorem </span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem </a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/03.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem Ipsum</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Lorem </span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem</a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/02.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem Ipsum</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Lorem</span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem.</a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/03.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Lorem</span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem !</a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow border-0 mb-40 hover-grayscale">
                        <a href="#!"><img class="card-img-top" src="{{asset('theme/assets/images/blogs/01.jpg')}}" alt=""></a>
                        <div class="card-body border-top p-30">
                            <div class="post-meta font-weight-500 small mb-20">
                                <span class="mr-3"><i class="far fa-calendar-alt text-primary mr-2"></i> Lorem ipsum</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Lorem</span>
                            </div>
                            <h5 class="font-weight-600"><a href="{{route('blog.detail')}}" class="text-blue">Lorem Ipsum has been the industry's standardLorem</a></h5>
                            <p class="mt-3">Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <nav class="mt-20">
                        <ul class="pagination justify-content-center font-weight-600">
                            <li class="page-item"><a class="page-link" href="#!"><i class="fas fa-chevron-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#!">01</a></li>
                            <li class="page-item active"><a class="page-link" href="#!">02</a></li>
                            <li class="page-item"><a class="page-link" href="#!">03</a></li>
                            <li class="page-item"><a class="page-link" href="#!"><i class="fas fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>



@endsection
