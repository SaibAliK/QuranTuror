<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\StudentProfile;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $list=User::has('student')->get();
        return view('admin.student.list',get_defined_vars());
    }

    public function add()
    {
        return view('admin.student.add');
    }

    public function status($id)
    {
        $user = User::find($id);
        $student = StudentProfile::where('user_id',$user->id)->first();
        if($student)
        {
            if($student->status == "approve")
            {
                $student->status = "disapprove";
                $student->save();
            }
            else
            {
              $student->status = "approve";
              $student->save();  
          }
          return redirect()->route('admin.student.list')->with("success","Student Status is changed Successfully");
      }
  }

  public function store(Request $request)
  {
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'gender' => 'required',
        'password' => 'required|string|min:8',
    ]);
    $password=$request->password;
    $user=User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => $request->password,
        'role'=>$request->role
    ]);
    StudentProfile::create([
        'user_id'=>$user->id,
        'gender'=>$request->gender,
        'phone'=>$request->phone,
    ]);
    $name=$user->FullName;
    $id=$user->id;
    $message='Message';
    $mail=$request->email;
    $data=array('name'=>$name,'id'=>$id,'password'=>$password,'email'=>$mail);
    $email=$user->email;
    $msg['view']="email.student.signup";
    $msg['data']=$data;
    $msg['to']=$email;
    $msg['subject']="Student Account";
    sendMail($msg);

    return redirect()->route('admin.student.list')->with("success","Email sent successfully to Student");
}

public function delete($id = null)
{
    $user=User::findorFail($id);
    if ($user!==null)
    {
        $user->delete();
        return redirect()->back()->with('success','Student Delete Successfully');
    }
    return redirect()->back()->with('error','student record not found');
}
}
