<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user=User::where('id',auth()->user()->id)->first();
        return view('admin.profile',get_defined_vars());
    }

    public function generalUpdate(Request $request)
    {
        $request->validate([
           'first_name'=>'required',
           'last_name'=>'required',
           'email'=>'required',
        ]);
        User::where('id',auth()->user()->id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
        ]);
        return redirect()->back()->with('success','Profile update successfully');

    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);
        User::where('id',auth()->user()->id)->update([
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with('success','Password update successfully');
    }
}
