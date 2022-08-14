<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTutor extends Model
{
    use HasFactory;
    protected $guarded=[
        'created_at','updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class,'tutor_id','id');
    }

}
