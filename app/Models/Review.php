<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	use HasFactory;
	// protected $fillable = [
	// 	'user_id',
	// 	'meeting_session_id',
	// 	'rating',
	// 	'review',
	// ];
	protected $guarded=[];

	public function user()
	{
		return $this->belongsTo('App\Models\User','user_id');
	}

	public function student()
	{
		return $this->belongsTo('App\Models\User','student_id');
	}

	public function tutor()
	{
		return $this->belongsTo('App\Models\User','tutor_id');
	}

	public function meeting_session()
	{
		return $this->belongsTo('App\Models\MeetingSession');
	}
}
