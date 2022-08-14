<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingSession;

class SessionController extends Controller
{
    public function index()
    {
        $list=MeetingSession::all();
        return view('admin.session.list',get_defined_vars());
    }

    public function delete($id = null)
    {
        MeetingSession::find($id)
        	->delete();
        return redirect()->back()->with('success','Session Deleted Successfully');
    }
}
