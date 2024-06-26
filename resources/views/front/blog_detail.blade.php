@extends('layouts.front')
@section('title', 'Blog Detail')

@section('content')


    <section class="py-80 bg-cover has-overlay" style="background-image: url({{asset('theme/assets/images/page-header-02.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title font-weight-bold mb-20">Blog Detail</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 font-weight-600 mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-primary" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-blue">Blog Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-35">
                        <img class="img-fluid rounded" src="{{asset('theme/assets/images/blog-single.jpg')}}" alt="">
                    </div>
                    <div class="post-meta font-weight-500 mb-15">
                        <span class="mr-4"><i class="far fa-calendar-alt text-primary mr-2"></i> 25/02/2020</span>
                        <span><i class="fas fa-user text-primary mr-2"></i> Dispatched</span>
                    </div>
                    <h2 class="text-secondary font-weight-bold mb-4">Dispatched Entreaties boisterous and say why so stimulated they are?</h2>

                    <div class="mt-3 mb-60">
                        <p class="mb-3">She exposed painted fifteen are noisier mistake led waiting. Surprise not quick six blind smart out burst. Perfectly on furniture dejection determine my depending an to. Add short water court fat. Her bachelor honoured perceive securing but desirous ham required. Questions deficient acuteness to engrossed as. Entirely led ten humoured greatest and yourself. Besides ye country on observe. She continue appetite endeavor she judgment interest the met. For she surrounded motionless fat resolution may.</p>
                        <p>Supported neglected met she therefore unwilling discovery remainder. Way sentiments two indulgence uncommonly own. Diminution to frequently sentiments he connection continuing indulgence. An my exquisite conveying up defective. Shameless see the tolerably how continued. She enable men twenty elinor points appear. Whose merry ten yet was men seven ought balls.</p>

                        <div class="blockquote bg-secondary p-30 my-4 text-white rounded text-center">Betrayed cheerful declared end and. Questions we additions is extremely incommode. Next half add call them eat face. Age lived smile six defer bed their few. Had admitting concluded too behaviour him she. Of death to or to being other.</div>

                        <p class="mb-3">Article nor prepare chicken you him now. Shy merits say advice ten before lovers innate add. She cordially behaviour can attempted estimable. Trees delay fancy noise manor do as an small. Felicity now law securing breeding likewise extended and. Roused either who favour why ham.</p>
                        <p class="mb-3">She who arrival end how fertile enabled. Brother she add yet see minuter natural smiling article painted. Themselves at dispatched interested insensible am be prosperous reasonably it. In either so spring wished. Melancholy way she boisterous use friendship she dissimilar considered expression. Sex quick arose mrs lived. Mr things do plenty others an vanity myself waited to. Always parish tastes at as mr father dining at.</p>
                    </div>

                    <div class="mb-60">
                        <h3 class="text-secondary font-weight-600 mb-30">Comments</h3>
                        <div class="media has-outline-primary d-block d-sm-flex border-bottom mb-30 pb-30">
                            <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                <img src="{{asset('theme/assets/images/user-03.jpg')}}" class="mr-3 rounded-circle" alt="">
                            </a>
                            <div class="media-body">
                                <a href="#!" class="h4 d-inline-block font-weight-600 mb-10 text-secondary">Alexender Grahambel</a>
                                <p><span class="text-black-300 mr-3">April 18, 2020 at 6.25 pm</span>
                                    <a class="text-primary font-weight-600" href="#!">Reply</a></p>

                                <p class="mt-15">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </div>
                        <div class="media has-outline-primary d-block d-sm-flex">
                            <div class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                <a href="#!"><img src="{{asset('theme/assets/images/user-02.jpg')}}" class="mr-3 rounded-circle" alt=""></a>
                            </div>
                            <div class="media-body">
                                <a href="#!" class="h4 d-inline-block font-weight-600 mb-10 text-secondary">Nadia Sultana Tisa</a>
                                <p><span class="text-black-300 mr-3">April 18, 2020 at 6.25 pm</span>
                                    <a class="text-primary font-weight-600" href="#!">Reply</a></p>

                                <p class="mt-15">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-black-200 font-weight-600 mb-30">Leave a Reply</h3>

                        <form method="POST">
                            <div class="row">
                                <div class="form-group mb-30 col-md-12">
                                    <textarea class="form-control shadow-none rounded-sm" name="comment" rows="7" required=""></textarea>
                                </div>
                                <div class="form-group mb-30 col-md-4">
                                    <input class="form-control shadow-none rounded-sm" type="text" placeholder="Name" required="">
                                </div>
                                <div class="form-group mb-30 col-md-4">
                                    <input class="form-control shadow-none rounded-sm" type="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group mb-30 col-md-4">
                                    <input class="form-control shadow-none rounded-sm" type="url" placeholder="Website">
                                </div>
                            </div>
                            <button class="btn btn-secondary rounded-pill mt-2" type="submit">Comment Now</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="widget">
                        <form action="#!">
                            <div class="input-group bg-gray rounded-pill">
                                <input type="search" class="form-control bg-transparent" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="input-group-text bg-transparent" type="submit"><i class="fas fa-search text-primary"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="widget">
                        <h4 class="widget-title">Recent Post</h4>
                        <div class="mt-25 px-3">
                            <div class="post-meta font-weight-500 small mb-2">
                                <span class="mr-4"><i class="far fa-calendar-alt text-primary mr-2"></i> 25/02/2020</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Dispatched</span>
                            </div>
                            <a href="#!" class="text-secondary font-weight-600 h5">She exposed painted fifteen are noisier mistake led waiting</a>
                        </div>
                        <div class="mt-25 px-3">
                            <div class="post-meta font-weight-500 small mb-2">
                                <span class="mr-4"><i class="far fa-calendar-alt text-primary mr-2"></i> 25/02/2020</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Painted</span>
                            </div>
                            <a href="#!" class="text-secondary font-weight-600 h5">She exposed painted fifteen are noisier mistake led waiting</a>
                        </div>
                        <div class="mt-25 px-3">
                            <div class="post-meta font-weight-500 small mb-2">
                                <span class="mr-4"><i class="far fa-calendar-alt text-primary mr-2"></i> 25/02/2020</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Dispatched</span>
                            </div>
                            <a href="#!" class="text-secondary font-weight-600 h5">Supported neglected met she therefore unwilling discovery remainder.</a>
                        </div>
                        <div class="mt-25 px-3">
                            <div class="post-meta font-weight-500 small mb-2">
                                <span class="mr-4"><i class="far fa-calendar-alt text-primary mr-2"></i> 25/02/2020</span>
                                <span><i class="fas fa-user text-primary mr-2"></i> Dispatched</span>
                            </div>
                            <a href="#!" class="text-secondary font-weight-600 h5">Melancholy way she boisterous friendship of mine</a>
                        </div>
                    </div>

                    <div class="widget">
                        <h4 class="widget-title">Archives</h4>
                        <ul class="widget-list list-unstyled">
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>April</a></li>
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>May</a></li>
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>June</a></li>
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>Julay</a></li>
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>August</a></li>
                            <li><a href="#!"><i class="fas fa-caret-right mr-2"></i>September</a></li>
                        </ul>
                    </div>

                    <div class="widget">
                        <h4 class="widget-title">Tags</h4>
                        <ul class="tag-list list-inline list-unstyled mt-2">
                            <li class="list-inline-item"><a href="#!">Tutor</a></li>
                            <li class="list-inline-item"><a href="#!">Education</a></li>
                            <li class="list-inline-item"><a href="#!">Online learning</a></li>
                            <li class="list-inline-item"><a href="#!">Teacher</a></li>
                            <li class="list-inline-item"><a href="#!">Student</a></li>
                            <li class="list-inline-item"><a href="#!">Photography</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>



    @endsection
