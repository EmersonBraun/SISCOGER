<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    public function getProc($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findOrFail($id)
    {
        return $this->find($id);
    }

    public function find($id)
    {
        $proc = $this->getProc($id);
        $this->canSeeProc($proc);
        return $proc;
    }

    public function findAndDelete($id)
	{
        if(session('is_admin')) {
            return $this->model->findOrFail($id)->delete();
        }
        return false;
    }

    public function canSeeProc($proc)
    {
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');
        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) $opm = ($proc->cdopm !== $unidade) ? 1 : 0; 
        else $opm = ($proc['cdopm'] !== $unidade) ? 1 : 0;

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) return abort(403);
        return true;
    }

    public function refAno($ref, $ano)
	{
        $proc = $this->model->where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();
        $this->canSeeProc($proc);
        return $proc;

    }

    public function prioritario()
    {
        return $this->model->where('prioridade',1)->get();
    }

    public function maxRef()
    {
        $ano = (int) date('Y');
        return $this->model->where('sjd_ref_ano','=',$ano)->max('sjd_ref');
    }

    public function QtdProc($ano='')
    {
        if($ano != '') return $this->QtdProcAno($ano);
        return $this->QtdProcTotal();
    }

    public function QtdProcAno($ano)
    {
       return $this->model
       ->select(DB::raw('count(sjd_ref) AS qtd'))
       ->where('sjd_ref_ano','=',$ano)
       ->groupBy('sjd_ref_ano')
       ->first();
    }

    public function QtdProcTotal()
    {
        for($i = 2008; $i <= date('Y'); $i++)
        {
            //Quantidade de cd por ano
            $qtd_proc = DB::connection('sjd')
            ->table('cd')
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$i)
            ->groupBy('sjd_ref_ano')
            ->first();
            //insere no array para ficar 'ano' => 'qtd'
            $qtd_ano = array_add($qtd_ano,$i, $qtd_proc['qtd']);
        }
        return $qtd_ano;
    }

    public function QtdProcOM($unidade, $ano='')
    {
        if($ano != '') return $this->QtdProcOMAno($ano, $unidade);
        return $this->QtdProcOMTotal($unidade);
    }

    public function QtdProcOMAno($ano, $unidade)
    {
       return $this->model
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
    }

    public function QtdProcOMTotal($unidade)
    {
        for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de cd por ano
                $qtd_proc = $this->model
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $qtd_ano = array_add($qtd_ano,$i, $qtd_proc['qtd']);
            }
        return $qtd_ano;
    }

    public function apagados()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        $registros = ($verTodasUnidades) ? $this->model->onlyTrashed() : $this->model->onlyTrashed()->where('cdopm','like',$unidade.'%');
        return $registros->get();
    }


    
}

