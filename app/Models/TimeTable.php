<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function tutor_user()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }
}
