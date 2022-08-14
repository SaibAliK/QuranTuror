<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    
    public function index()
    {
        $list = Testimonial::all();
        return view('admin.testimonial.list', get_defined_vars());
    }

    public function add()
    {
        return view('admin.testimonial.add');
    }

 	public function edit($id)
    {
    	$item = Testimonial::find($id);
        return view('admin.testimonial.edit', get_defined_vars());
    }

    public function store(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'address' => 'required',
            'review' => 'required',
        ]);

        if(isset($req->id))
        {
        	Testimonial::find($req->id)
        		->update($req->except("_token"));
        }else
        {
        	Testimonial::create($req->except("_token"));
        }
        
        return redirect()->route('admin.testimonial.list')->with("success", "Saved Successfully");
    }

    public function delete($id = null)
    {
        Testimonial::find($id)
        	->delete();
        return back()->with('success','Deleted Successfully');
    }
}
