<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Models\TutorProfile;
use App\Models\User;
use App\Models\TimeTable;
use App\Rules\UpdateEmailRule;
use Illuminate\Support\Facades\Hash;
use App\Models\TutorTransaction;
use App\Models\Location;
use App\Models\TutorReciept;
use File;
use Storage;
use Response;

class ProfileController extends Controller
{
    public function edit()
    {
        // dd(auth()->user()->tutor->location_id);
        $is_closed = [];
        $from = [];
        $to = [];

        if (count(auth()->user()->time_tables) > 0) {
            foreach (auth()->user()->time_tables as $tt) {
                $is_closed[] = $tt->is_closed;
                $from[] = $tt->from;
                $to[] = $tt->to;
            }
        }
        $user=auth()->user();
        $locations=Location::all();
        return view('tutor.profile.edit',get_defined_vars());
    }

    public function update(Request $request)
    {
    $image=$request->image;
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required',new UpdateEmailRule()],
            'gender' => 'required',
            'dob'=>'required',
            'address'=>'required',
            'time_zone'=>'required',
        ]);
        if ($request->hasFile('image'))
        {
            $image= uploadFile($request->image ,'uploads/tutors',$request->first_name);
        }
        User::where('id',$request->id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'time_zone'=>$request->time_zone,
        ]);

        TutorProfile::where('user_id',$request->id)->update([
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country,
            'image'=>$image,
            'bio'=>$request->bio,
            'description'=>$request->description,
        ]);
       return redirect()->back()->with('message','Profile Update Successfully');
    }



    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);
        User::where('id',$request->id)->update([
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with('message','Password update successfully');
    }

    public function timetableSave(Request $req)
    {
        // dd($req);
        // dd(empty($req->is_closed[5]));
        $tutor = auth()->user();

        if(count($tutor->time_tables) > 0)
            $tutor->time_tables()->delete();

        $days = [
            'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];

        for($d=0;$d<7;$d++)
        {
            $tt = new TimeTable();
            $tt->tutor_id = $tutor->id;
            $tt->day = $days[$d];
            $tt->is_closed = $req->is_closed[$d] ?? 1;
            if (isset($req->is_closed[$d])) {
                $tt->from = $req->from[$d] ?: "9:00 AM";
                $tt->to = $req->to[$d] ?: "2:00 PM";
            }
            $tt->save();
        }

        return redirect()->back()->with('message', 'Timetable updated Successfully');
    }

    public function earningList(Request $req)
    {
        $list=TutorReciept::where('tutor_id',auth()->user()->id)
            ->get();
        return view("tutor.earning.list",get_defined_vars());
    }

    public function downloadReciept(Request $req)
    {
        $reciept=TutorReciept::find($req->id);
        return response()
            ->download(storage_path('app/' . $reciept->file));
            
    }
}
