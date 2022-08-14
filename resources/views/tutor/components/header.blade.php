

    <div class="collapse  navbar-collapse " id="navbarNavTutor" >
        <aside class="sidebar bg-white card-shadow ">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" mt-3 ">
                        <img @if(auth()->user()->tutor->image) src="{{asset(auth()->user()->tutor->image)}}" @else src="{{asset('images/default.png')}}" @endif class="rounded-circle " style="width: 120px;height: 120px;">
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class=" text-dark j text-capitalize">{{auth()->user()->FullName}}
                            @if(auth()->user()->tutor->is_feature==1)
                            <span class="badge badge-success">Featured</span>
                            @else
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="menu-section mt-1 pb-5 ">
                <ul class="">

                    <li class="nav-item @routeis('tutor.dashboard') active @endrouteis">
                        <a href="{{route('tutor.dashboard')}}" class=" nav-link ">
                            <i class="fa fa-th mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.profile.*') active @endrouteis">
                        <a href="{{route('tutor.profile.edit')}}" class=" nav-link ">
                            <i class="fa fa-user-circle mr-2"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.packages.*') active @endrouteis">
                        <a href="{{route('tutor.packages.list')}}" class=" nav-link ">
                            <i class="fa fa-credit-card-alt mr-2"></i> Packages
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.student.requests') active @endrouteis">
                        <a href="{{route('tutor.student.requests')}}" class=" nav-link ">
                            <i class="fa fa-anchor mr-2"></i> Student Requests
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.student.students') active @endrouteis">
                        <a href="{{route('tutor.student.students')}}" class=" nav-link ">
                            <i class="fa fa-graduation-cap mr-2"></i> Students
                        </a>
                    </li>

                    <li class="nav-item @routeis('tutor.session.session') active @endrouteis">
                        <a href="{{route('tutor.session.session')}}" class=" nav-link ">
                            <i class="fa fa-weixin mr-2"></i> Meeting Session
                        </a>
                    </li>

                    <li class="nav-item @routeis('tutor.earning.list') active @endrouteis">
                        <a href="{{route('tutor.earning.list')}}" class=" nav-link ">
                            <i class="fa fa-money mr-2"></i> Earnings
                        </a>
                    </li>

                    <li class="nav-item ">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('tutor.dashboard')}}" class="nav-link "
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
                        <img @if(auth()->user()->tutor->image) src="{{asset(auth()->user()->tutor->image)}}" @else src="{{asset('images/default.png')}}" @endif class="rounded-circle " style="width: 120px;height: 120px;">
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class=" text-dark j text-capitalize  ml-3">{{auth()->user()->FullName}}</h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="menu-section mt-1 pb-5 ">
                <ul class="">

                    <li class="nav-item @routeis('tutor.dashboard') active @endrouteis">
                        <a href="{{route('tutor.dashboard')}}" class=" nav-link ">
                            <i class="fa fa-th mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.profile.*') active @endrouteis">
                        <a href="{{route('tutor.profile.edit')}}" class=" nav-link ">
                            <i class="fa fa-th mr-2"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.student.requests') active @endrouteis">
                        <a href="{{route('tutor.student.requests')}}" class=" nav-link ">
                            <i class="fa fa-anchor mr-2"></i> Student Requests
                        </a>
                    </li>
                    <li class="nav-item @routeis('tutor.session.payout') active @endrouteis">
                        <a href="{{route('tutor.session.payout')}}" class=" nav-link ">
                            <i class="fa fa-graduation-cap mr-2"></i> Payout
                        </a>
                    </li>



                    <li class="nav-item ">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('tutor.dashboard')}}" class="nav-link "
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

