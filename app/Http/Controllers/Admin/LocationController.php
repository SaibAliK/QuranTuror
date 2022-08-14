<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{ 
    public function index()
    {
        $list=Location::all();
        return view('admin.location.list',get_defined_vars());
    }

    public function add()
    {
        return view('admin.location.add');
    }

 	public function edit($id)
    {
    	$item=Location::find($id);
        return view('admin.location.edit',get_defined_vars());
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'flag' => 'required',
            'name' => 'required',
        ]);
       	if ($req->hasFile('flag'))
       	{
          	$flag= uploadFile($req->flag ,'uploads/location-flags',$req->country);
       	}
        if(isset($req->id))
        {
        	Location::where('id',$req->id)
        		->update([
	            	'name' => $req->name,
	            	'flag' => $flag,
        		]);
    		$msg="Location updated successfully";
        }else
        {
        	Location::create([
            	'name' => $req->name,
            	'flag' => $flag,
    		]);
        	$msg="Location created successfully";
        }
        
        return redirect()->route('admin.location.list')->with("success",$msg);
    }

    public function delete($id = null)
    {
        Location::find($id)
        	->delete();
        return back()->with('success','Deleted Successfully');
    }
}
