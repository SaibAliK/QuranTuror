@extends('layouts.front')
@section('title', 'Contact Us')

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">Contact Us</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-gray">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 order-1 order-lg-0">
                    <div class="mb-5">
                        <h2 class="text-secondary font-weight-bold mb-2">Lorem Ipsum has </h2>
                        <p>Lorem Ipsum has been the industry's <br> Lorem Ipsum has been.</p>
                    </div>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-30">
                                    <label for="name">Name*</label>
                                    <input type="text" class="form-control rounded-sm" id="name" placeholder="Lorem Ipsum">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-30">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control rounded-sm" id="email" placeholder="Lorem Ipsum">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-30">
                                    <label for="sub">Subject</label>
                                    <input type="text" class="form-control rounded-sm" id="sub" placeholder="Lorem Ipsum has been the">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-30">
                                    <label for="message">Message</label>
                                    <textarea class="form-control rounded-sm" id="message" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary rounded-sm">Lorem ipsum</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-4 col-lg-5 mb-5 mb-lg-0 order-0 order-lg-1">
                    <div class="mb-5">
                        <h2 class="text-secondary font-weight-bold mb-2">Lorem Ipsum</h2>
                        <p>Lorem Ipsum has been the. <br> Lorem Ipsum has been the industry</p>
                    </div>
                    <div class="shadow-sm p-20 mt-4 rounded-sm bg-white d-block d-sm-flex align-items-center">
                        <i class="fas fa-phone fa-2x text-primary"></i>
                        <div class="ml-sm-4 mt-3 mt-sm-0">
                            <h4 class="text-secondary font-weight-600 mb-1">Lorem Ipsum</h4>
                            <p>Phone: <a href="tel:+7800123452" class="text-dark">Lorem Ipsum</a></p>
                            <p>Mail: <a href="mailto:contact@eduskill.com" class="text-dark">Lorem Ipsum</a></p>
                        </div>
                    </div>
                    <div class="shadow-sm p-20 mt-4 rounded-sm bg-white d-block d-sm-flex align-items-center">
                        <i class="fas fa-map-marked-alt fa-2x text-primary"></i>
                        <div class="ml-sm-4 mt-3 mt-sm-0">
                            <h4 class="text-secondary font-weight-600 mb-1">Lorem Ipsum</h4>
                            <p>Lorem Ipsum has been the industry's standardLorem</p>
                        </div>
                    </div>
                    <div class="shadow-sm p-20 mt-4 rounded-sm bg-white d-block d-sm-flex align-items-center">
                        <i class="fas fa-user-clock fa-2x text-primary"></i>
                        <div class="ml-sm-4 mt-3 mt-sm-0">
                            <h4 class="text-secondary font-weight-600 mb-1">Lorem Ipsum</h4>
                            <p>Lorem Ipsum</p>
                            <p>Lorem Ipsum has</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Lorem Ipsum has <br> Lorem Ipsum <span class="has-line">Lorem Ipsum</span></h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <a href="#!" class="map-image" target="_blank">
                        <img src="{{asset('theme/assets/images/map-img.jpg')}}" alt="">
                        <span class="map-text h4"><i class="fas fa-external-link-alt mr-2"></i> Lorem Ipsum has </span>
                    </a>
                </div>
            </div>
        </div>
    </section>






@endsection
