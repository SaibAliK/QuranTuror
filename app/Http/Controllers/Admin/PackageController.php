<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackagePercentage;

class PackageController extends Controller
{
    public function index()
    {
        $list=PackagePercentage::all();
        return view('admin.package.list',get_defined_vars());
    }

    public function add()
    {
        return view('admin.package.add');
    }

 	public function edit($id)
    {
    	$package=PackagePercentage::find($id);
        return view('admin.package.edit',get_defined_vars());
    }

    public function store(Request $req)
    {
        $req->validate([
            'type' => 'required',
            'percentage' => 'required',
        ]);
        if(isset($req->id))
        {
        	PackagePercentage::where('id',$req->id)
        		->update([
	            	'type' => $req->type,
	            	'percentage' => $req->percentage,
        		]);
        }
        
        return redirect()->route('admin.package.list')->with("success","Saved Successfully");
    }

    public function delete($id = null)
    {
        Package::find($id)
        	->delete();
        return redirect()->back()->with('success','Deleted Successfully');
    }
}
