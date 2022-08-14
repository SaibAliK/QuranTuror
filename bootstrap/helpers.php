<?php

use App\Models\MeetingSession;
use App\Models\RequestTutor;
use App\Models\TutorTransaction;
use App\Models\TutorProfile;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;
use App\Models\Schedule;
use App\Models\Review;
use App\Models\TimeZone;
use Carbon\Carbon;
use App\Models\Testimonial;

function uploadFile($file, $path, $name){
    $filename = time().'-'.$name.'.'.$file->getClientOriginalExtension();
    $file->move($path,$filename);
    return $path.'/'.$filename;
}

function getNDaysDates($days, $format = 'd/m')
{
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = '"' . date($format, mktime(0,0,0,$m,($de-$i),$y)) . '"';
    }
    $res=array_reverse($dateArray);
    $first=$res[0];
    $last=$res[sizeof($res)-1];
    $first=trim($first,'"');
    $last=trim($last,'"');
    return [$first,$last];
}

function sendMail($data)
{
    Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
        $message->to($data['to'])->subject($data['subject']);
        if(isset($data['file']))
        {
            $message->attach($data['file']);
        }
    });
}

function studentTime($time) {
    return Carbon::parse($time)->timezone(auth()->user()->time_zone)->format('h:ia');
}

function studentDateTime($date, $time) {
    return Carbon::parse($date.' '.$time)->timezone(auth()->user()->time_zone)->format('Y/m/d h:ia');
}
function studentDateTimeHashFormat($date, $time) {
    return Carbon::parse($date.' '.$time)->timezone(auth()->user()->time_zone)->format('Y-m-d H:i:s');
}

function weekDay($date)
{
	//Convert the date string into a unix timestamp.
    $unixTimestamp = strtotime($date);
    //Get the day of the week using PHP's date function.
    $dayOfWeek = date("l", $unixTimestamp);
    return $dayOfWeek;
}

function class_complete($id)
{
    $count=MeetingSession::where('student_id',auth()->user()->id)
        ->where('tutor_id',$id)
        ->count();
    if($count>0)
    {
        return true;
    }else
    {
        return false;
    }
}

function is_package()
{
    if(isset(auth()->user()->student->package_id))
    {
        return true;
    }else
    {
        return false;
    }
}

function one_time_completed()
{
    $student_req=RequestTutor::where('student_id',auth()->user()->id)
            ->latest()
            ->first();
    if(isset($student_req) && $student_req->status!='cancelled'
        && $student_req->accept_status!='2')
    {
        $schedule=Schedule::
            where('request_tutor_id',$student_req->id)
            ->where('class_status','completed')
            ->first();
        if($schedule)
        {
            $class=MeetingSession::where('schedule_id',$schedule->id)
                ->where('status','2')
                ->first();
            if($class)
            {
                return true;
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
        
    }else
    {
        return true;
    }
    
}

function request_approved($id)
{
    $count=RequestTutor::where("tutor_id",$id)
        ->where('student_id',auth()->user()->id)
        ->count();
    if($count>0)
    {
        return true;
    }else
    {
        return false;
    }
}

function meeting_start($id)
{
    if(MeetingSession::where('schedule_id',$id)
        ->count()>0)
    {
        return true;
    }else
    {
        return false;
    }
}

function is_student($id)
{
    $count=RequestTutor::where("tutor_id",$id)
        ->where('student_id',auth()->user()->id)
        ->where('payment_type','permanent')
        ->count();
    if($count>0)
    {
        return true;
    }else
    {
        return false;
    }   
}

function twelveTime($time)
{
    $time  = date("g:i a", strtotime($time));
    $r=explode(" ",$time);
    $time=$r[0].$r[1];
    return $time;
}

function twentyFourTime($time)
{
    return $time_in_24_hour_format  = date("H:i", strtotime($time));
}

function utc_timezone_lists() {
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );
    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }


    return $timezone_list;
}

function setting()
{
    $setting=Setting::
            pluck('setting','name')
            ->toArray();
    return (object)$setting;
}

function updateSlugs()
{
    $tutor_list=User::has("tutor")->get();
    foreach($tutor_list as $item)
    {
        TutorProfile::where('user_id',$item->id)
            ->update(['slug'=>Str::slug($item->FullName ?? '')."-".$item->id]);
    }
    return true;
}

function tutorIncome($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min =min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0; 
    return (object)get_defined_vars();
}

function tutorEarned($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('status','1')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('status','1')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

// setting krni he.
function incomeAverage($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->avg('amount') ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
        }else
        {
            $date_array[]=null;
        }
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    return (object)get_defined_vars();
}

function tutorTutions($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = RequestTutor::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('status','approved')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->count() ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
        }else
        {
            $date_array[]=null;
        }
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    return (object)get_defined_vars();
}

function profitToAdmin($req=null)
{
    $first_record = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
       }else
       {
            $date_array[]=null;
       }
        
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function winningJobs($req=null)
{
    $first_record = RequestTutor::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('accept_status','1')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = RequestTutor::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('accept_status','1')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->count() ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
        }else
        {
            $date_array[]=null;
        }
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function lostJobs($req=null)
{
    $first_record = RequestTutor::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('accept_status','2')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = RequestTutor::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('tutor_id',$req->id)
        ->where('accept_status','2')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->count() ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
        }else
        {
            $date_array[]=null;
        }
        
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminEarning($req=null)
{
    $first_record = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    $date_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
        $record=$data->where('day' , $i)->pluck('created_at')->first();
        if($record)
        {
           $date_array[]=$record->format('Y-m-d'); 
       }else
       {
            $date_array[]=null;
       }
        
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminPaidIncome($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('status','1')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('status','1')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminUnpaidIncome($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('status','0')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('status','0')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function tutorsIncome($req=null)
{
    $first_record = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminRevenue($req=null)
{
    $first_record = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $tutor_data = TutorTransaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();
    $admin_data = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $tutor_income=$tutor_data->where('day' , $i)->sum('amount') ?? 0;
        $admin_income=$admin_data->where('day' , $i)->sum('amount') ?? 0;
        $data_array[]=$tutor_income+$admin_income;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminProfit($req=null)
{
    $first_record = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('type','2')
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->where('type','2')
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function adminIncome($req=null)
{
    $first_record = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->first();
    $days_result=get_start_end_days($req,$first_record->created_at ?? null);

    $data = Transaction::selectRaw("*,WEEKDAY(created_at) as day")
        ->whereBetween('created_at', [$days_result->start_day,$days_result->end_day])
        ->get();

    $data_array=array();
    for($i = 0;$i < $days_result->limit;$i++)
    {
        $data_array[]=$data->where('day' , $i)->sum('amount') ?? 0;
    }
    if(count($data_array)>0)
    {
        $min=min($data_array);
        $max=max($data_array);
    }else
    {
        $min=0;
        $max=10;
    }
    $limit=$days_result->limit ?? 0;
    
    return (object)get_defined_vars();
}

function get_start_end_days($req,$first_record_date=null)
{
    if(!isset($req->from_date) && !isset($req->to_date))
    {
        $report = 'day';
        $limit = 7;
        $days=getNDaysDates($limit, 'Y-m-d');
        $start_day=$days[0];
        $end_day=$days[1];
    }elseif(isset($req->from_date) && isset($req->to_date))
    {
        $start_day=Carbon::parse($req->from_date);
        $end_day=Carbon::parse($req->to_date);
        $limit=$start_day->diffInDays($end_day) ?? 0;

        $start_day=$start_day->format('Y-m-d');
        $end_day=$end_day->format('Y-m-d');
    }elseif(isset($req->from_date))
    {
        $start_day=Carbon::parse($req->from_date);
        $end_day=Carbon::now();
        // dd("Calling");
        $limit=$start_day->diffInDays($end_day) ?? 0;

        $start_day=$start_day->format('Y-m-d');
        $end_day=$end_day->format('Y-m-d');
    }elseif(isset($req->to_date))
    {

        $start_day=$first_record_date;
        $end_day=Carbon::now();
        $limit=$start_day->diffInDays($end_day) ?? 0;

        $start_day=$start_day->format('Y-m-d');
        $end_day=$end_day->format('Y-m-d');
    }

    return (object)get_defined_vars();
}

function tutorAmount()
{
    $all=User::has('tutor')->get();
    foreach($all as $item)
    {
        $unpaid_amount=TutorTransaction::where('tutor_id',$item->id)->sum('amount');
        $tutor=TutorProfile::where('user_id',$item->id)->first();
        $tutor->unpaid_amount=$unpaid_amount;
        $tutor->paid_amount=0.0;
        $tutor->save();
    }
    return true;
    
}

function is_review_submitted($id)
{
    $count=Review::where('meeting_session_id',$id)
        ->where('user_id',auth()->user()->id)
        ->count();
    if($count>0)
    {
        return true;
    }else
    {
        return false;
    }
}

function time_zone_list()
{
    return TimeZone::all();
}

function time_dropdown()
{
    $time_array=array();
    $value='';
    for($i = 1; $i <12 ; $i++)
    {
        $value=$i.":00 AM-".($i+1).":00";
        if($i==11)
        {
            $value=$value." PM";
        }else
        {
            $value=$value." AM";
        }
        $time_array[]=$value;
        $value='';
    }
    $time_array[]="12:00 PM-1:00 PM";
    for($i = 1; $i <12 ; $i++)
    {
        $value=$i.":00 PM-".($i+1).":00";
        if($i==11)
        {
            $value=$value." AM";
        }else
        {
            $value=$value." PM";
        }
        $time_array[]=$value;
        $value='';
    }
    $time_array[]="12:00 AM-1:00 AM";
    return $time_array;
}

function days_dropdown()
{
    $days[]="Monday";
    $days[]="Tuesday";
    $days[]="Wednesday";
    $days[]="Thursday";
    $days[]="Friday";
    $days[]="Saturday";
    $days[]="Sunday";
    return $days;
}

function testimonials()
{
    return Testimonial::all();
}