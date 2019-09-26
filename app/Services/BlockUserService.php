<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use App\Services\LogService;
use App\User;

class BlockUserService 
{
    protected $log;

	public function __construct(
        LogService $log
    )
	{
        $this->log = $log;
    }

    public function block($id)
    {
        $user = User::findOrFail($id);

        if(!$user->hasRole('admin')) 
        {
            $block = $user->update(['block' => 1]);
            if($block) {
                $this->log->block($user);
                return true;
            }
        }

        return false;
    }

    public function unblock($id)
    {
        //desbloqueio usuário
        $user = User::findOrFail($id);
        $unblock = $user->update(['block' => 0]);

        if($unblock) {
            $this->log->acesso($user);
            $this->log->block($user);
            return true;
        }

        return false;
    }
 
}

