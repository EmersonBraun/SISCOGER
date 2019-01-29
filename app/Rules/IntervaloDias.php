<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Sjd\Administracao\LogAcesso as LogAcesso;
use App\User;
class IntervaloDias implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        //verifica o último acesso
        $ultimo_acesso = LogAcesso::where('rg', '=', $value)->latest()->first();
        //verifica o tempo do último acesso
        $data1 = (isset($ultimo_acesso)) ? \Carbon\Carbon::createFromTimeString($ultimo_acesso->created_at) : \Carbon\Carbon::now();
        $data2 = \Carbon\Carbon::now();
        $intervalo = $data1->diffInDays($data2);
        $true = $intervalo >= config('sistema.tempo_inatividade');
        
        if ($intervalo >= config('sistema.tempo_inatividade')) 
        {
            //traz os dados do usuário
            $user = User::where('rg', '=', $value)->first();
            //bloqueia o usuário
            $user->block = 1;
            $user->save();
            
            return $value !== $value;
        } 
        else 
        {
            return $value === $value;
        }     
      
    }

    public function message()
    {
        return 'Usuário, Bloqueado por estar mais de '.config('sistema.tempo_inatividade').' dias sem acesso';
    }
}
