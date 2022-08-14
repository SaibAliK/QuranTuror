<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('admin_theme') }}/assets/img/sidebar-3.jpg">
    <div class="logo">
        <a href="{{ route('home') }}" target="_blank" class="simple-text logo-mini"><img src="{{ asset('icon.png') }}" width="25px" alt=""></a>
        <a href="{{ route('home') }}" target="_blank" class="simple-text logo-normal"><img src="{{ asset('images/inner_logo.png') }}" width="160" ></a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('images/default.png') }}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>{{ auth()->user()->FullName }} <b class="caret"></b></span>
                </a>
                <div class="collapse @routeis('admin.profile') show @endrouteis" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item @routeis('admin.profile') active @endrouteis">
                            <a class="nav-link" href="{{ route('admin.profile') }}">
                                <span class="sidebar-mini"> EP </span>
                                <span class="sidebar-normal"> Edit Profile </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item @routeis('admin.dashboard') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li class="nav-item @routeis('admin.tutor.list') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.tutor.list') }}">
                    <i class="material-icons">person</i>
                    <p> Tutors </p>
                </a>
            </li>
            <li class="nav-item @routeis('admin.student.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.student.list') }}">
                    <i class="material-icons">school</i>
                    <p> Students </p>
                </a>
            </li>
            <li class="nav-item @routeis('admin.request_tutor.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.request_tutor.list') }}">
                    <i class="material-icons">request_page</i>
                    <p> Tutor Requests </p>
                </a>
            </li>
            {{-- <li class="nav-item @routeis('admin.package.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.package.list') }}">
                    <i class="fa fa-id-card" aria-hidden="true"></i>
                    <p> Packages </p>
                </a>
            </li> --}}

            <li class="nav-item @routeis('admin.location.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.location.list') }}">
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                    <p> Locations </p>
                </a>
            </li>


            <li class="nav-item @routeis('admin.schedule.list') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.schedule.list') }}">
                    <i class="material-icons">alarm</i>
                    <p> Schedule </p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.sessions.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.sessions.list') }}">
                    <i class="material-icons">sensors</i>
                    <p> Sessions </p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.earning.list') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.earning.list') }}">
                    <i class="material-icons">paid</i>
                    <p>Admin Earning</p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.tutor.earning') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.tutor.earning') }}">
                    <i class="material-icons">account_balance_wallet</i>
                    <p>Tutor Earning</p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.sale.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.sale.list') }}">
                    <i class="fa fa-balance-scale" aria-hidden="true"></i>
                    <p> Sales </p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.testimonial.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.testimonial.list') }}">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                    <p> Testimonials </p>
                </a>
            </li>

            <li class="nav-item @routeis('admin.setting.*') active @endrouteis">
                <a class="nav-link" href="{{ route('admin.setting.add') }}">
                    <i class="material-icons">settings</i>
                    <p> Setting </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="javascript:;" onclick="document.getElementById('logout_form').submit()">
                    <form id="logout_form" class="d-none" method="post" action="{{ route('logout') }}">@csrf</form>
                    <i class="material-icons">logout</i>
                    <p> Logout </p>
                </a>
            </li>

        </ul>
    </div>
</div>
