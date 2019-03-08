<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class ExistRg implements Rule
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
        $value = User::where('rg', '=', $value)->count();
        return $value > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'RG não cadastrado!';
    }
}
