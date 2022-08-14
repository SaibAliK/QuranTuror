<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
	use HasFactory;
	protected $guarded=[
		'created_at','updated_at'
	];

	public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
