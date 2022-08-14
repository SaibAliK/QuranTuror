<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TutorProfile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if(isset($request->role) && $request->role=='tutor')
        {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'gender' => 'required',
                'time_zone'=>'required',
                'password' => 'required|string|confirmed|min:8',
                'location_id' => 'required',
                'dob'=> 'required',
            ]);
            Auth::login($user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'role'=>'tutor',
                'time_zone'=>$request->time_zone,
            ]));
            TutorProfile::create([
                'user_id'=>auth()->user()->id,
                'gender'=>$request->gender,
                'dob'=>$request->dob,
                'location_id'=>$request->location_id,
            ]);

            event(new Registered($user));
        
            return redirect(RouteServiceProvider::TUTOR);
        }else
        {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'gender' => 'required',
                'time_zone'=>'required',
                'password' => 'required|string|confirmed|min:8',

            ]);
            Auth::login($user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'role'=>'student',
                'time_zone'=>$request->time_zone,
            ]));
            StudentProfile::create([
                'user_id'=>auth()->user()->id,
                'gender'=>$request->gender,
            ]);

            event(new Registered($user));
        
            return redirect(RouteServiceProvider::STUDENT); 
        }

    }
}
