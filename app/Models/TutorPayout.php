<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorPayout extends Model
{
    use HasFactory;
    protected $fillable=[
        'tutor_id','student_id','meeting_session_id','amount','status',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }
}
