<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    
    public function index()
    {
        $list=auth()->user()->tutor_packages;
        return view('tutor.packages.list',get_defined_vars());
    }

    public function add()
    {
        return view('tutor.packages.add');
    }

 	public function edit($id)
    {
    	$package=Package::find($id);
        return view('tutor.packages.edit',get_defined_vars());
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'hours' => 'required',
            'per_hour_amount' => 'required',
            'type'=>'required',
        ]);
        $total_amount=$req->per_hour_amount*$req->hours;
        if(isset($req->id))
        {
        	Package::where('id',$req->id)
        		->update([
	            	'name' => $req->name,
	            	'hours' => $req->hours,
                    'per_hour_amount' => $req->per_hour_amount,
                    'total_amount' => $total_amount,
                    'type'=>$req->type,
	            	'description' => $req->description,
        		]);
            $msg="Package Updated Successfully";
        }else
        {
        	Package::create([
            	'name' => $req->name,
            	'hours' => $req->hours,
            	'per_hour_amount' => $req->per_hour_amount,
                'total_amount' => $total_amount,
            	'description' => $req->description,
                'type'=>$req->type,
                'tutor_id'=>auth()->user()->id,
        	]);
            $msg="Package Saved Successfully";
        }
        
        return redirect()->route('tutor.packages.list')->with("message",$msg);
    }

    public function delete($id = null)
    {
        Package::find($id)
        	->delete();
        return redirect()->back()->with('message','Package Deleted Successfully');
    }
}
