<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\PolicialRepository as PM;
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
        $difer = 0;

        $user = User::where('rg', '=', $value)->first();
        $opmUser = corta_zeros($user->cdopm);
        $pm = PM::get($value);
        $opmPM = corta_zeros($pm->cdopm);
        if($opmUser !== $opmPM){
            $user->block = 1;
            $difer = 1;
        }
        
        return $difer !== 1;    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'OPM diferente - Usuário Bloqueado! Entre em contato com sua SJD!';
    }
}
