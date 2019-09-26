<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use App\Models\Sjd\Administracao\LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio;

class LogService 
{

    public function acesso($user) {
        /*insere log de acesso com ip = 'desbloqueio' para que não seja barrado na validação do tempo de inatividade*/
        $logacesso = [
            'rg' => $user->rg,
            'nome' => $user->nome,
            'tipo' => 'desbloqueio',
            'created_at' => \Carbon\Carbon::now(),
            'ip' => 'desbloqueio' 
        ];
        $create = LogAcesso::create($logacesso); 
        if($create) return true;
        return false;
    }

    public function block($user) {
        $logBlock = [
            'acao' => 'desbloqueio',
            'rg_acao' => session('rg'),
            'rg_block' => $user->rg,
            'ip' => $_SERVER["REMOTE_ADDR"]
        ];
        $create = LogBloqueio::create($logBlock); 
        if($create) return true;
        return false;
    }
 
}

