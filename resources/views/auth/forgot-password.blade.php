
@extends('layouts.front')
@section('title', 'Forget Password')
@section('css')


@endsection
@section('content')

    <section class="banner-1 p-5 has-overlay bg-cover" style="background-image: url({{asset('theme/assets/images/banner-image-00.jpg')}});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-5 col-sm-10 mt-5 mt-md-0">
                    <div class="col--lg-12">
                        <h2 class="text-center text-white mb-2"><span class="has-line line-primary">Forget Password?</span></h2>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                    <form method="POST" action="{{ route('password.email')  }}" class="search-form rounded">

                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <input type="text" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Type Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-3">
                                <button type="submit" class="btn btn-primary rounded-pill w-100">{{ __('Email Password Reset Link') }}</button>
                            </div>
                        </div>
                        <h6 class="text-white"><span class="">Already have an account?</span> <a href="{{ route('login') }}" class="text-primary">Login </a> </h6>

                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection


