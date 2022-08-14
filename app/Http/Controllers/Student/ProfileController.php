<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\UpdateEmailRule;

class ProfileController extends Controller
{
   public function index()
   {
       $student=User::find(auth()->user()->id);
       return view('student.profile.profile',get_defined_vars());
   }

   public function edit()
   {
       $student=User::find(auth()->user()->id);
       return view('student.profile.edit',get_defined_vars());
   }

   public function update(Request $request)
   {
        $image=$request->image;
        if ($request->hasFile('image'))
        {
          $image= uploadFile($request->image ,'uploads/students',$request->first_name);
        }

        $request->validate([
           'first_name' => 'required|string|max:255',
           'last_name' => 'required|string|max:255',
           'email' => ['required',new UpdateEmailRule()],
           'gender' => 'required',
           'dob'=>'required',
           'address'=>'required',
           'time_zone'=>'required',
        ]);
        User::where('id',$request->id)->update([
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
           'time_zone'=>$request->time_zone,
        ]);

        StudentProfile::where('user_id',$request->id)->update([
           'gender'=>$request->gender,
           'dob'=>$request->dob,
           'phone'=>$request->phone,
           'address'=>$request->address,
           'city'=>$request->city,
           'country'=>$request->country,
           'image'=>$image,
        ]);
       return redirect()->back()->with('message','Profile Updated Successfully');

   }

   public function updatePassword(Request $request)
   {
       $request->validate([
           'password' => 'required|string|confirmed|min:8',
       ]);
       User::where('id',$request->id)->update([
           'password'=>Hash::make($request->password),
       ]);
       return redirect()->back()->with('message','Password Updated successfully');
   }
}
