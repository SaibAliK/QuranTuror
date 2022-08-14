<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class,'tutor_id','id');
    }

    public function meeting()
    {
        return $this->hasOne(MeetingSession::class,'schedule_id','id');
    }
}
