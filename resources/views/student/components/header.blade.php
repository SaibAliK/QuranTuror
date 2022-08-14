

    <div class="collapse  navbar-collapse " id="navbarNavTutor" >
        <aside class="sidebar bg-white card-shadow ">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" mt-3 ">
                        <img @if(auth()->user()->student->image) src="{{asset(auth()->user()->student->image)}}" @else src="{{asset('images/default.png')}}" @endif class="rounded-circle " style="width: 120px;height: 120px;">
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class=" text-dark j text-capitalize">{{auth()->user()->FullName}}</h4>
                    </div>
                </div>
            </div>  
            <hr>
            <div class="menu-section mt-1 pb-5 ">
                <ul class="">
                    <li class="nav-item @routeis('student.dashboard') active @endrouteis">
                        <a href="{{route('student.dashboard')}}" class=" nav-link ">
                            <i class="fa fa-th mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item @routeis('student.profile.*') active @endrouteis">
                        <a href="{{route('student.profile.edit')}}" class=" nav-link ">
                            <i class="fa fa-user-circle mr-2"></i> Edit Profile
                        </a>
                    </li>
                    @if(auth()->user()->student->status == 'approve')
                        @if(one_time_completed() && !is_package())
                            <li class="nav-item @routeis('student.tutor.find') active @endrouteis">
                                <a href="{{route('student.tutor.find')}}" class=" nav-link ">
                                    <i class="fa fa-graduation-cap mr-2"></i> Tutor
                                </a>
                            </li>
                        @endif
                        <li class="nav-item @routeis('student.tutor.request.*') active @endrouteis">
                            <a href="{{route('student.tutor.request.list')}}" class=" nav-link ">
                                <i class="fa fa-user mr-2"></i> Your Requests
                            </a>
                        </li>

                        <li class="nav-item @routeis('student.session.*') active @endrouteis">
                            <a href="{{route('student.session.session')}}" class=" nav-link ">
                                <i class="fa fa-weixin mr-2"></i> Meeting Session
                            </a>
                        </li>
                    @endif
                    
                    <li class="nav-item ">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('tutor.dashboard')}}" class=" nav-link "
                               onclick="event.preventDefault();
                                           this.closest('form').submit();">
                                <i class="fa fa-power-off mr-2"></i> {{ __('Logout') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
    <div class="side-nav">
        <aside class="sidebar bg-white card-shadow ">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" mt-3 ">
                        <img @if(auth()->user()->student->image) src="{{asset(auth()->user()->student->image)}}" @else src="{{asset('images/default.png')}}" @endif class="rounded-circle " style="width: 120px;height: 120px;">
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class=" text-dark j text-capitalize  ml-3">{{auth()->user()->FullName}}</h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="menu-section mt-1 pb-5 ">
                <ul class="">
                    <li class="nav-item @routeis('student.dashboard') active @endrouteis">
                        <a href="{{route('student.dashboard')}}" class=" nav-link ">
                            <i class="fa fa-th mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item @routeis('student.profile.*') active @endrouteis">
                        <a href="{{route('student.profile.edit')}}" class=" nav-link ">
                            <i class="fa fa-user-circle mr-2"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item @routeis('student.tutor.find') active @endrouteis">
                        <a href="{{route('student.tutor.find')}}" class=" nav-link ">
                            <i class="fa fa-graduation-cap mr-2"></i> Tutor
                        </a>
                    </li>
                    <li class="nav-item @routeis('student.tutor.request.*') active @endrouteis">
                        <a href="{{route('student.tutor.request.list')}}" class=" nav-link ">
                            <i class="fa fa-user mr-2"></i> Your Requests
                        </a>
                    </li>
                     <li class="nav-item @routeis('student.review.*') active @endrouteis">
                        <a href="{{route('student.review.add')}}" class=" nav-link ">
                            <i class="fa fa-user mr-2"></i> Meeting Session
                        </a>
                    </li>

                    <li class="nav-item ">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('tutor.dashboard')}}" class=" nav-link "
                               onclick="event.preventDefault();
                                           this.closest('form').submit();">
                                <i class="fa fa-power-off mr-2"></i> {{ __('Logout') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
    </div>



