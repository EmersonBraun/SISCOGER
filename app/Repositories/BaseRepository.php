<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    public function find($id)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        $proc = $this->model->findOrFail($id);

        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) 
        {
            $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;
        } 
        else 
        {
            $opm = ($proc['cdopm'] != session()->get('cdopmbase')) ? 1 : 0;
        }

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) 
        {
            return abort(403);
        }
        else
        {
            return $proc;
        }

    }

    public function findAndDelete($id)
	{
        $this->model->findOrFail($id)->delete();
        return true;
    }

    public function refAno($ref, $ano)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        $proc = $this->model->where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();

        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) 
        {
            $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;
        } 
        else 
        {
            $opm = ($proc['cdopm'] != session()->get('cdopmbase')) ? 1 : 0;
        }

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) 
        {
            return abort(403);
        }
        else
        {
            return $proc;
        }

    }

    public function maxRef()
    {
        //ano atual
        $ano = (int) date('Y');

        //última ref inserida
        $ref = $this->model->where('sjd_ref_ano','=',$ano)->max('sjd_ref');

        return $ref;
    }

    public function QtdProc($ano='')
    {
        //inicializar a variável
        $qtd = [];

        if($ano != '')
        {
            $qtd_ano = $this->model
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
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
        }
        
        return $qtd;
    }

    public function QtdProcOM($unidade, $ano='')
    {
        //inicializar a variável
        $qtd = [];

        if($ano != '')
        {
            $qtd_ano = $this->model
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
        {
            for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de cd por ano
                $qtd_proc = DB::connection('sjd')
                ->table('cd')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $qtd_ano = array_add($qtd_ano,$i, $qtd_proc['qtd']);
            }
        }
        
        return $qtd;
    }

    public function apagados()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = $this->model->onlyTrashed()->get();
        }
        else 
        {
            $registros = $this->model->onlyTrashed()->where('cdopm','like',$unidade.'%')->get();
        }

        return $registros;
    }


    
}

