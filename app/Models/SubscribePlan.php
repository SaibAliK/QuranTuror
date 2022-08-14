<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribePlan extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    // public function package()
    // {
    //     return $this->belongsTo("App\Models\Package");
    // }

    // public function user()
    // {
    //     return $this->belongsTo("App\Models\User");
    // }
}
