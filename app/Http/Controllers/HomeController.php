<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TutorProfile;
use App\Models\Location;
use App\Models\Review;

class HomeController extends Controller
{
    public function redirect($id=null)
    {
        if(!is_null($id)){
            session(['tutor_id'=>$id]);
        }
        if(session('tutor_id')){
            return redirect()->route("student.tutor.find");
        }elseif(auth()->user()->role=='tutor'){
            return redirect()->route('tutor.dashboard');

        }elseif(auth()->user()->role=='student'){
            return redirect()->route('student.dashboard');

        }elseif(auth()->user()->role=='admin'){
            return redirect()->route('admin.dashboard');
        }
    }
    public function home()
    {
        $tutor_list=User::whereHas('tutor', function($q){
                $q->where('is_feature', true);
            })->orderBy('created_at','desc')
            ->take(6)
            ->get();
        return view('front.home',get_defined_vars());
    }

    public function tutor_register()
    {
        $locations=Location::all();
        return view("auth.tutor_register",get_defined_vars());
    }

    public function tutor_profile($slug,Request $req)
    {
        $show_more=false;
        $tutor=TutorProfile::where('slug',$slug)->first();
         
        if(isset($req->show))
        {
            $reviews_list=Review::where('tutor_id',$tutor->user_id)
            ->get();
        }else
        {
            $reviews_list=Review::where('tutor_id',$tutor->user_id)
            ->take(5)
            ->get(); 
            $count=Review::where('tutor_id',$tutor->user_id)
                ->count();
            if($count>5)
            {
                $show_more=true;
            }
        }
        // dd(floor($reviews_list->avg('rating')));
        // dd(get_defined_vars());
        return view('front.tutor_profile',get_defined_vars());
    }

    public function about()
    {
        return view('front.about');
    }
    public function blog()
    {
        return view('front.blog');
    }
    public function contact()
    {
        return view('front.contact');
    }

    public function blogDetail()
    {
        return view('front.blog_detail');
    }

    public function tutors()
    {
        $tutor_list=User::has('tutor')
            ->orderBy('id','desc')
            ->get();
        return view("front.tutors",get_defined_vars());
    }

    public function adminLogin()
    {
        return view("auth.admin_login");
    }
}
