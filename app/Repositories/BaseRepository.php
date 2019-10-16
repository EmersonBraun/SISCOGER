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
        return $this->model->findOrFail($id);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        try {
            $this->model->find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->model->find($id)->update($data);
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function create(array $data)
    {
        try {
            $create = $this->model->create($data);
            return $create;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function findAndUpdate($id, array $data)
    {
        try {
            $this->model->findOrFail($id)->update($data);
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function firstOrCreate(array $data)
    {
        try {
            $this->model->firstOrCreate($data);
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function findAndDelete($id)
	{
        try {
            $this->model->findOrFail($id)->delete();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function findAndRestore($id)
	{
        try {
            $this->model->withTrashed()->findOrFail($id)->restore();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function findAndDestroy($id)
	{
        try {
            $this->model->withTrashed()->findOrFail($id)->forceDelete();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function forceDelete($id)
	{
        try {
            $this->model->forceDelete();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }

    public function datesToCreate(array $data) {// para procedimentos que tem referência e ano
        $ref = $this->maxRef();
        //referência e ano
        $data['sjd_ref'] = $ref+1;
        $data['sjd_ref_ano'] = (int) date('Y');
        
        return $data;
    }

    public function refAno($ref, $ano='')
    {
        if(!$ano) return $this->findOrFail($ref);
        return $this->model->where([
            ['sjd_ref',$ref],
            ['sjd_ref_ano',$ano]
        ])->first();
    }

    public function prioritario()
    {
        return $this->model->where('prioridade',1)->get();
    }

    public function maxRef()
    {
        $sjd_ref = $this->model->where('sjd_ref_ano','=',date('Y'))->max('sjd_ref');
        $maxRef = (!$sjd_ref) ? 1 : $sjd_ref;
        return $maxRef;
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
        $qtd_ano = [];
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
        $qtd_ano = [];
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
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        $registros = ($verTodasUnidades) ? $this->model->onlyTrashed() : $this->model->where('cdopm','like',$unidade.'%')->onlyTrashed();
        return $registros->get();
    }

    public function apagadosAno($ano)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        $registros = ($verTodasUnidades) ? $this->model->where('sjd_ref_ano',$ano)->onlyTrashed() : $this->model->where('sjd_ref_ano',$ano)->where('cdopm','like',$unidade.'%')->onlyTrashed();
        return $registros->get();
    }


    
}

