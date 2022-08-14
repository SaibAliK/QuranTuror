<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\TutorProfile;

class SettingController extends Controller
{
	public function add()
	{
		$setting = Setting::pluck('setting', 'name');
		return view('admin.setting.add',get_defined_vars());
	}
	public function store(Request $request)
	{
		$setting = $request->except('_token');
		foreach ($setting as $key => $value) {
			if (empty($value))
				continue;
			$set = Setting::where('name', $key)->first() ?: new Setting();
			$set->name = $key;
			$set->setting = $value;
			$set->save();

			if($key=="general_price")
			{
				TutorProfile::where('id','!=', null)->update([
					'hourly_rate'=> $set->setting
				]);
			}
		}
		return redirect()->back()->with("success","Setting changed Successfully");
	}
}
