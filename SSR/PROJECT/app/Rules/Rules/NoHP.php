<?php

namespace App\Rules\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoHP implements Rule
{
    protected $msg = 'Phone Number must start with 08';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($msg = null)
    {
        if ($msg != null) $this->msg = $msg;
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
        $attribute = "Phone Number";
        if (substr($value,0,2) != "08") return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
