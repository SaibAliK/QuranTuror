<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSession extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function request_tutor()
    {
        return $this->belongsTo('App\Models\RequestTutor', 'request_tutor_id');
    }
    
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id','id');
    }
}
