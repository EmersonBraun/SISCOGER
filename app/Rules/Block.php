<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use App\User;

class Block implements Rule
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
        $user = User::where('rg', '=', $value)->first();
        $value = $user->block;
        
        return $value !== 1;    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Usuário Bloqueado!';
    }
}
