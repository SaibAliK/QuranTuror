<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
        protected $guarded=[
            'created_at','updated_at'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->hasOne(StudentProfile::class,'user_id','id');
    }
    public function tutor()
    {
        return $this->hasOne(TutorProfile::class,'user_id','id');
    }
    public function tutor_payouts()
    {
        return $this->hasMany('App\Models\TutorPayout', 'tutor_id');
    }

    public function time_tables()
    {
        return $this->hasMany('App\Models\TimeTable', 'tutor_id');
    }

    public function tutor_schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'tutor_id');
    }

    public function student_schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'student_id');
    }
    
    public function setpasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getfullnameAttribute($value)
    {
        return $this->attributes['first_name']. " ".$this->attributes["last_name"];
    }

    public function getUnPaidAmount()
    {
        return $this->tutor_payouts->where('status', 'unpaid')->sum('amount');
    }
    public function getPaidAmount()
    {
        return $this->tutor_payouts->where('status', 'paid')->sum('amount');
    }

    public function tutor_packages()
    {
        return $this->hasMany('App\Models\Package', 'tutor_id');
    }

    public function student_requests()
    {
        return $this->hasMany('App\Models\RequestTutor', 'student_id');
    }

    public function tutor_requests()
    {
        return $this->hasMany('App\Models\RequestTutor', 'tutor_id');
    }

    public function meeting_sessions()
    {
        return $this->hasMany('App\Models\MeetingSession', 'tutor_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id');
    }


}
