<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use App\Repositories\log\logRepository;

class LogService 
{

    protected $repository;

	public function __construct(
        logRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function acesso($user) {
        /*insere log de acesso com ip = 'desbloqueio' para que não seja barrado na validação do tempo de inatividade*/
        $logacesso = [
            'rg' => $user->rg,
            'nome' => $user->nome,
            'tipo' => 'desbloqueio',
            'created_at' => \Carbon\Carbon::now(),
            'ip' => 'desbloqueio' 
        ];
        $create = $this->repository->createAcesso($logacesso); 
        if($create) return true;
        return false;
    }

    public function block($user, $motive='') {
        $motive = !$motive ? 'senha errada' : $motive;
        $logBlock = [
            'acao' => 'bloqueio',
            'motivo' => $motive,
            'rg_acao' => session('rg'),
            'rg_block' => $user->rg,
            'ip' => $_SERVER["REMOTE_ADDR"]
        ];
        $create = $this->repository->createBloqueio($logBlock); 
        if($create) return true;
        return false;
    }

    public function fdi($pm)
    {
        /* se for o próprio PM acessando sua ficha não registra, 
        para tirar essa regra só comentar a linha de baixo*/
        if($pm->RG === session('rg')) return true;

        $dados = [
            'rg_ficha' => $pm->RG,
            'nome_ficha' => $pm->NOME,
            'cargo_ficha' => $pm->CARGO,
            'cidade_ficha' => $pm->CIDADE,
            'rg_acesso' => session('rg'),
            'nome_acesso' => session('nome'),
            'cargo_acesso' => session('cargo'),
            'cidade_acesso' => session('cidade'),
            'data_hora' => \Carbon\Carbon::now(),
            'ip' => $_SERVER["REMOTE_ADDR"],
        ];

        $this->repository->createFdi($dados);
    }
 
}

