<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;
    protected $guarded=[
        'created_at','updated_at'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }
}
