@extends('layouts.front')
@section('title', 'Login')
@section('css')

@endsection
@section('content')

    <section class="banner-1 p-5 has-overlay bg-cover" style="background-image: url({{asset('theme/assets/images/banner-image-00.jpg')}});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-5 col-sm-10 mt-5 mt-md-0">
                    <h2 class="text-center text-white mb-2"><span class="has-line line-primary">Login</span></h2>
                    <form method="POST" action="{{ route('login') }}" class="search-form rounded">

                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <input type="text" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="password" class="form-control shadow-none rounded-sm @error('password') is-invalid @enderror" name="password" required placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>

                            <div class="block ml-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600 text-white">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                                <div class="col-lg-12 mb-3">
                                    <button type="submit" class="btn btn-primary rounded-pill w-100">Login</button>
                                </div>
                            </div>
                            <h6 class="text-white"><a href="{{ route('password.request') }}" class="text-primary">Forget password ?</a> </h6>

                        </form>
                    </div>
                </div>
            </div>
        </section>


    @endsection


