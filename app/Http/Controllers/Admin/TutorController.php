<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\Setting;
use App\Models\TutorTransaction;
use App\Models\RequestTutor;
use App\Models\Location;
use App\Models\Review;
use Str;
use App\Models\TutorReciept;



class TutorController extends Controller
{
    public function index()
    {
        $tutors=User::has('tutor')->get();
        return view('admin.tutor.list',get_defined_vars());
    }

    public function add()
    {
        $locations=Location::all();
        $setting = Setting::pluck('setting', 'name');
        return view('admin.tutor.add',get_defined_vars());
    }

    public function payTutor(Request $req)
    {
        $req->validate([
            'amount' => 'required|numeric',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time().'.'.$req->file->extension();
        $req->file->storeAs('tutor-reciepts', $imageName);
        $path='tutor-reciepts/'.$imageName;

        $t_profile=TutorProfile::where('user_id',$req->id)->first();
        $t_profile->paid_amount=$t_profile->paid_amount+$req->amount;
        $t_profile->unpaid_amount=$t_profile->unpaid_amount-$req->amount;
        $t_profile->save();

        TutorReciept::create(['file'=>$path,
            'amount'=>$req->amount,
            'tutor_id'=>$req->id,
            'note'=>$req->note,
            'balance'=>$t_profile->unpaid_amount-$req->paid_amount]);
        $data=array();
        $data['view']='email.admin.tutor_reciept';
        $data['subject']='Tutor Reciept';
        $data['to']=$t_profile->user->email;
        $data['data']=get_defined_vars();
        $data['file']=storage_path('app/' . $path);
        sendMail($data);
        return back()->with("success","Tutor Amount Paid Successfully");
    }

    public function earning(Request $req)
    {
        $unpaid = TutorTransaction::where('status','0');
        $paid = TutorTransaction::where('status','1');

        if (isset($req->from_date) && !isset($req->to_date)) {
            $unpaid = $unpaid->whereDate('created_at', '>=', Carbon::parse($req->from_date));
            $paid = $paid->whereDate('created_at', '>=', Carbon::parse($req->from_date));
        }
        if (!isset($req->from_date) && isset($req->to_date)) {
            $unpaid = $unpaid->whereDate('created_at', '<=', Carbon::parse($req->to_date));
            $paid = $paid->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }
        if (isset($req->from_date) && isset($req->to_date)) {
            $unpaid = $unpaid->whereDate('created_at', '>=', Carbon::parse($req->from_date));
            $unpaid = $unpaid->whereDate('created_at', '<=', Carbon::parse($req->to_date));

            $paid = $paid->whereDate('created_at', '>=', Carbon::parse($req->from_date));
            $paid = $paid->whereDate('created_at', '<=', Carbon::parse($req->to_date));
        }

        $unpaid = $unpaid->get();
        $unpaid_amount = $unpaid->sum('amount');
        $paid = $paid->get();
        $paid_amount = $paid->sum('amount');

        return view('admin.tutor.earning' , get_defined_vars());
    }

    public function changeEarningStatus(Request $req)
    {
        $item=TutorTransaction::where('id',$req->id)
            ->first();
        if($item->status=='0')
        {
            $item->status='1';
        }else
        {
            $item->status='0';
        }
        $item->save();
        return back()->with("success","Status Changed Successfully");
    }

    public function featureStatus($id)
    {
        $user = User::find($id);
        $tutors = TutorProfile::where('user_id',$user->id)->first();
        if($tutors)
        {
            if($tutors->is_feature == 0)
            {
                $tutors->is_feature = 1;
                $tutors->save();
            }
            else
            {
              $tutors->is_feature = 0;
              $tutors->save();
          }
          return redirect()->route('admin.tutor.list')->with("success","Tutor Feature Status is changed Successfully");
      }
    }

    public function edit($id)
    {
        $locations=Location::all();
        $tutor = User::find($id);
        return view('admin.tutor.edit',get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required',
            'password' => 'required|string|min:8',
            'hourly_rate' => 'required',
            'bio' => 'required',
            'time_zone'=>'required',
            'location_id'=>'required',
        ]);

        $password=$request->password;

        $user=User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'role'=>$request->role,
            'time_zone'=>$request->time_zone
        ]);
        TutorProfile::create([
            'user_id'=>$user->id,
            'slug'=>Str::slug($user->FullName."-".$user->id),
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'hourly_rate'=>$request->hourly_rate,
            'location_id'=>$request->location_id,
            'bio'=>$request->bio,
            'description'=>$request->description,
        ]);
        $name=$user->FullName;
        $id=$user->id;
        $message='Message';
        $mail=$request->email;
        $data=array('name'=>$name,'id'=>$id,'password'=>$password,'email'=>$mail);
        $email=$user->email;
        $msg['view']="email.tutor.signup";
        $msg['data']=$data;
        $msg['to']=$email;
        $msg['subject']="Tutor Account";
        sendMail($msg);

        return redirect()->route('admin.tutor.list')->with("success","Email sent successfully to Tutor");
    }
    public function update(Request $request , $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'hourly_rate' => 'required',
            'bio' => 'required',
            'time_zone'=>'required',
            'location_id'=>'required',
        ]);
        $tutor = User::find($id);
        if($tutor)
        {
            $tutor->first_name = $request->first_name;
            $tutor->last_name = $request->last_name;
            $tutor->email = $request->email;
            $tutor->time_zone=$request->time_zone;
            $tutor->save();

            $tutorProfile = TutorProfile::where('user_id',$tutor->id)->first();
            $tutorProfile->slug = Str::slug($tutor->FullName."-".$tutor->id);
            $tutorProfile->phone = $request->phone;
            $tutorProfile->hourly_rate = $request->hourly_rate;
            $tutorProfile->bio = $request->bio;
            $tutorProfile->location_id = $request->location_id;
            $tutorProfile->description = $request->description;
            $tutorProfile->save();
        }
        return redirect()->route('admin.tutor.list')->with("success","Tutor is updated Successfully");
    }

    public function delete($id = null)
    {
        $user=User::findorFail($id);
        if ($user!==null)
        {
            $user->delete();
            return redirect()->back()->with('success','Tutor Delete Successfully');
        }
        return redirect()->back()->with('error','Tutor record not found');
    }

    public function history(Request $req)
    {
        $tutorIncome=tutorIncome($req);
        // dd($tutorIncome);
        $tutorEarned=tutorEarned($req);
        $incomeAverage=incomeAverage($req);
        $tutorTutions=tutorTutions($req);
        // dd($tutorTutions);
        $profitToAdmin=profitToAdmin($req);
        // dd($profitToAdmin);
        $winningJobs=winningJobs($req);
        $lostJobs=lostJobs($req);

        $win_jobs=RequestTutor::where('tutor_id',$req->id)
            ->where('accept_status','1')
            ->get();
        $lost_jobs=RequestTutor::where('tutor_id',$req->id)
            ->where('accept_status','2')
            ->get();

        $tutor=User::find($req->id);

        return view("admin.tutor.history",get_defined_vars());
    }

    public function review_list(Request $req)
    {
        $tutor=User::find($req->id);
        $list=Review::where('tutor_id',$req->id)
            ->get();
        return view("admin.tutor.review_list",get_defined_vars());
    }

    public function review_add(Request $req)
    {
        $student_list=User::has('student')
            ->get();
        $tutor=User::find($req->id);
        return view("admin.tutor.add_review",get_defined_vars());
    }

    public function review_save(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'student_id'=>'required',
            'rating' => 'required',
            'review' => 'required',
        ]);

        $review = Review::create([
            'user_id' => $req->student_id,
            'rating' => $req->rating,
            'review' => $req->review,
            'tutor_id' => $req->tutor_id,
            'student_id' => $req->student_id,
        ]);
        // dd($req->list_url);
        return redirect()->to($req->list_url);
    }

    public function review_delete(Request $req)
    {
        Review::find($req->id)
            ->delete();
        return redirect()->back()->with('success','Review Deleted Successfully');
    }
}
