
@extends('layouts.front')
@section('title', 'Reset Password')
@section('css')


@endsection
@section('content')

    <section class="banner-1 p-5 has-overlay bg-cover" style="background-image: url({{asset('theme/assets/images/banner-image-00.jpg')}});">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-5 col-sm-10 mt-5 mt-md-0">
                    <div class="col--lg-12">
                        <h2 class="text-center text-white mb-2"><span class="has-line line-primary">Change Password</span></h2>
                    </div>

                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />

                    <form method="POST" action="{{ route('password.update') }}" class="search-form rounded">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <input type="text" value="{{old('email', $request->email)}}" class="form-control shadow-none rounded-sm @error('email') is-invalid @enderror" name="email" required placeholder="Type Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-4">
                                <input type="password"    class="form-control shadow-none rounded-sm @error('password') is-invalid @enderror" name="password" required placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                            <div class="col-lg-12 mb-4">
                                <input type="password" class="form-control shadow-none rounded-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="Confirm Password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="col-lg-12 ">
                                <button type="submit" class="btn btn-primary rounded-pill w-100">{{ __('Reset Password') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection






{{--<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>--}}
