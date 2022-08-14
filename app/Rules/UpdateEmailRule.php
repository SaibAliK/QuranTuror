<?php

namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class UpdateEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count=User::where('email','!=',auth()->user()->email)
            ->where('email','=',$value)->count();
        if($count>0)
        {
            return false;
        }else
        {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email already exist.';
    }
}
