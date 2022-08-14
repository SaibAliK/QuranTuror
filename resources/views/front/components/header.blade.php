<header class="bg-white shadow">
    <div class="container-lg">
        <nav class="navbar navbar-expand-xl navbar-dark px-0">
            <a class="navbar-brand" href="{{route('index')}}">
                <img src="{{ asset('images/logo.png') }}" alt="" style="width:159px;">
            </a>

            <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarNavAlt" aria-controls="navbarNavAlt" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAlt">
                <ul class="navbar-nav mt-4 mt-xl-0 ml-auto">
                    <li class="nav-item @routeis('index') active @endrouteis">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item @routeis('about') active @endrouteis">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item @routeis('tutors') active @endrouteis">
                        <a class="nav-link" href="{{ route('tutors') }}">Tutors</a>
                    </li>
                    <li class="nav-item @routeis('blog') active @endrouteis">
                        <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                    </li>
                    <li class="nav-item @routeis('contact') active @endrouteis">
                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    @guest()
                        <li class="nav-item @routeis('login') active @endrouteis">
                            <a class="nav-link" href="{{route('login')}}" >Login</a>
                        </li>
                        <li class="nav-item @routeis('register') active @endrouteis">
                            <a class="nav-link" href="{{ route('register') }}" >Register</a>
                        </li>
                        <li class="nav-item @routeis('tutor_register') active @endrouteis">
                            <a class="nav-link" href="{{ route('tutor_register') }}" >Register As Tutor</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-sm btn-blue rounded-pill" href="{{ route('redirect') }}">Dashboard</a>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>
    </div>
</header>
