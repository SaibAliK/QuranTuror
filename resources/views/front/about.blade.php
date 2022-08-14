@extends('layouts.front')
@section('title', 'About us')

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">About Us</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mt-5 mt-lg-0">
                    <h2 class="section-title mb-30">Lorem <span class="has-line">Ipsum and</span></h2>
                    <p class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                </div>
                <div class="col-lg-7 text-center">
                    <img class="img-fluid rounded" src="{{asset('theme/assets/images/about-img.jpg')}}" alt="">
                </div>

            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                    <img class="img-fluid rounded pr-lg-3" src="{{asset('theme/assets/images/tms.png')}}" alt="">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <h2 class="section-title mb-30">Lorem Ipsum <br>Lorem Ipsum <br>Lorem Ipsum</h2>
                    <p class="mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-star mr-2 text-primary"></i>Lorem Ipsum is simply dummy text of the printing and.</li>
                        <li class="mb-2"><i class="fas fa-star mr-2 text-primary"></i>Lorem Ipsum is simply dummy text of the printing and the printing and.</li>
                        <li><i class="fas fa-star mr-2 text-primary"></i>Attachment excellence announcing or reasonable.</li>
                    </ul>
                    <div class="media has-outline-primary align-items-center mt-35">
                        <img class="rounded-circle" src="{{asset('theme/assets/images/user-07.jpg')}}" alt="">
                        <div class="ml-3">
                            <h5 class="text-blue font-weight-600 mb-1">LoremIpsum</h5>
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Lorem Ipsum is simply dummy text of the printing</h2>
                    <p class="mt-3 mb-40">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <a href="#!" class="btn btn-outline-primary">Lorem Ipsum is </a>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{asset('theme/assets/images/certificate.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding bg-cover" style="background-image: url({{asset('theme/assets/images/pattern-bg.jpg')}});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 position-relative">
                    <div class="owl-carousel student-says-carousel owl-loaded owl-drag">



                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2660px, 0px, 0px); transition: all 0.25s ease 0s; width: 4655px;"><div class="owl-item cloned" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="{{asset('theme/assets/images/quote.jpg')}}" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="{{asset('theme/assets/images/user-05.png')}}" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem Ipsum</h4>
                                                <p>Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item cloned" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="{{asset('theme/assets/images/quote.jpg')}}" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="{{asset('theme/assets/images/user-06.png')}}" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem Ipsum</h4>
                                                <p>Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="{{asset('theme/assets/images/quote.jpg')}}" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="{{asset('theme/assets/images/user-01.jpg')}}" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem Ipsum</h4>
                                                <p>Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="{{asset('theme/assets/images/quote.jpg')}}" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="{{asset('theme/assets/images/user-05.png')}}" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem Ipsum</h4>
                                                <p>Lorem Ipsum </p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item active" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="{{asset('theme/assets/images/quote.jpg')}}" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="{{asset('theme/assets/images/user-06.png')}}" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem ipsum</h4>
                                                <p>Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item cloned" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="assets/images/quote.jpg" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="assets/images/user-01.jpg" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">James Benzion</h4>
                                                <p>Lorem ipsum</p>
                                            </div>
                                        </div>
                                    </div></div><div class="owl-item cloned" style="width: 635px; margin-right: 30px;"><div class="text-center bg-white py-5 px-4 px-md-5 rounded shadow">
                                        <img class="mb-30 mx-auto" src="assets/images/quote.jpg" alt="">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standardLorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                                        <div class="media d-block d-sm-flex text-center text-sm-left justify-content-center mt-25">
                                            <img class="mx-auto mx-sm-0" src="assets/images/user-05.png" alt="">
                                            <div class="ml-0 ml-sm-3 mt-3 mt-sm-0">
                                                <h4 class="font-weight-600 text-blue mb-1">Lorem ipsum</h4>
                                                <p>Lorem ipsum</p>
                                            </div>
                                        </div>
                                    </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                    <div class="nav-arrows arrow-vcentered">
                        <span class="fas fa-chevron-left student-says-left"></span>
                        <span class="fas fa-chevron-right student-says-right"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
