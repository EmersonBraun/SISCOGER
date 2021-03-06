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
        $user = User::where('rg', '=', $value)->first();
        if(!$user->hasRole('admin')){
            //verifica o último acesso
            $ultimo_acesso = LogAcesso::where('rg', $value)->latest()->first();

            // if($ultimo_acesso->created_at == '0000-00-00 00:00:00' || !$ultimo_acesso) return false;
            //verifica o tempo do último acesso
            $data1 = (isset($ultimo_acesso)) ? \Carbon\Carbon::createFromTimeString($ultimo_acesso->created_at) : \Carbon\Carbon::now();
            $data2 = \Carbon\Carbon::now();
            $intervalo = $data1->diffInDays($data2);
            $ultrapassou_tempo = $intervalo >= config('sistema.tempo_inatividade') ? 1 : 0;
            
            if ($ultrapassou_tempo) 
            {
                $user->block = 1;
                $user->save();
                
                return $value !== $value;
            } 
        }
        return $value;
      
    }

    public function message()
    {
        return 'Usuário, Bloqueado por estar mais de '.config('sistema.tempo_inatividade').' dias sem acesso';
    }
}
