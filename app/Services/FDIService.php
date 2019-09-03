<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use App\Repositories\log\logRepository;

class FDIService 
{
    protected $repository;

	public function __construct(logRepository $repository)
	{
        $this->repository = $repository;
    }

    public function registerAcesso($pm)
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

    public function verOutraOPM($pm)
    {
        /* se pode ver todas unidades já passa */
        if(session('ver_todas_unidades')) return true;
        /* comparativo por código base */
        $cod_base = corta_zeros($pm->CDOPM);
        if($cod_base == session('cdopmbase')) return true; 
        /* comparativo pelos 3 primeiros dígitos */
        $prim_num_sessao = substr(session('cdopm'),0,3);
        $prim_num_ficha = substr($pm->CDOPM,0,3);
        if($prim_num_ficha == $prim_num_sessao) return true;
        /* comparativo pelo primeiro nome da OM */
        $nome_sessao = explode(' ',session('opm_descricao'))[0];
        $nome_ficha = explode(' ',$pm->OPM_DESCRICAO)[0];
        if(strtoupper($nome_ficha) == strtoupper($nome_sessao)) return true;

        return false;

    }

    public function verSuperior($pm)
    {
        // se pode ver superior já passa
        if(session('ver_superior')) return true;
        // teste de nivel hierárquico
        $nivel_ficha = sistema('posto', $pm->CARGO);
        $nivel_sessao = session('nivel');
        if($nivel_ficha >= $nivel_sessao) return true;

        return false;
    }

    public function verInativo($pm)
    {
        // ver-inativo ver-reserva
        // se a ficha é de ativo já passa
        if($pm->STATUS == 'Ativo') return true;
        // ver se pode ver inativo ou reserva
        $verInativo = in_array('ver-inativo',session('permissions'));
        $verReserva = in_array('ver-reserva',session('permissions'));
        if($verReserva || $verInativo) return true;

        return false;
    }
  
}

