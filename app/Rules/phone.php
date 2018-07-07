<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class phone implements Rule
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
        return preg_match('/(?:^1[3456789]|^9[28])\d{9}$/',$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '请输入正确的手机号码';
    }
}
