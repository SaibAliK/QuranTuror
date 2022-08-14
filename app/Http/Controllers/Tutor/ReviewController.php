<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\MeetingSession;

class ReviewController extends Controller
{
	public function add($id = null)
	{
		return view('tutor.review.add', get_defined_vars());
	}

	public function save(Request $req)
	{
		$meeting=MeetingSession::find($req->meeting_session_id);
		$req->validate([
			'meeting_session_id' => 'required',
			'rating' => 'required',
			'review' => 'required',
		]);
		$meeting_session_id = $req->meeting_session_id;

		$review = Review::create([
			'user_id' => auth()->user()->id,
			'meeting_session_id' => $meeting_session_id,
			'rating' => $req->rating,
			'review' => $req->review,
			'tutor_id' => $meeting->tutor_id,
			'student_id' => $meeting->student_id,
		]);

		return redirect()->route('tutor.session.session')->with('message', 'Thankyou!, Your review has been submitted');
	}
}
