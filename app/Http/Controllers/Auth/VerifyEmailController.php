<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if($request->user()->role=='student')
            {
               return redirect()->intended(RouteServiceProvider::STUDENT.'?verified=1'); 
            }elseif($request->user()->role=='tutor')
            {
               return redirect()->intended(RouteServiceProvider::TUTOR.'?verified=1');
            }elseif($request->user()->role=='admin')
            {
                return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        if($request->user()->role=='student')
        {
           return redirect()->intended(RouteServiceProvider::STUDENT.'?verified=1'); 
        }elseif($request->user()->role=='tutor')
        {
           return redirect()->intended(RouteServiceProvider::TUTOR.'?verified=1');
        }elseif($request->user()->role=='admin')
        {
            return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
        }
    }
}
