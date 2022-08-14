<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorTransaction extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }
}
