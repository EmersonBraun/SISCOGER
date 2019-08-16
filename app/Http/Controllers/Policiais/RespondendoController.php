<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\RespondendoRepository;
use Illuminate\Support\Collection;
class RespondendoController extends Controller
{
    protected $repository;
    protected $cargos;

    public function __construct(RespondendoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return view('policiais.respondendo.index');
    }

    public function search(Request $request)
    {
        $dados = $request->all();
        // postos/graduações
        $this->cargos($dados['cargo']);
        if(!$this->cargos) return redirect()->back();

        if ($dados['tipo_relatorio'] == 'lista') {

            $registros = $this->lista($dados['proc'], $dados);
            return view('policiais.respondendo.search', compact('registros'));
        } 

        if ($dados['tipo_relatorio'] == 'relatorio') {

            $registros = $this->relatorio($dados['proc'], $dados);
            return view('policiais.respondendo.relatorio', compact('registros'));
        }

        return redirect()->route('respondendo.index');
    }

    public function lista($proc, $dados)
    {
        $registros = [];
        foreach ($proc as $p => $vf) {
            if($vf) {
                $registros[$p] = $this->query($dados, $p, false);
            }
        }

        return $registros;
    }

    public function relatorio($proc, $dados)
    {
        $registros = new Collection();
        foreach ($proc as $p => $vf) {
            if($vf) {
                $result = $this->query($dados, $p, true);
                $registros = $registros->merge($result);
            }
        }

        return $registros;
    }

    public function baseQuery($dados)
    {
        $query = [];
        if($dados['cdopm']) array_push($query,['cdopm','=',$dados['cdopm']]);
        if($dados['sjd_ref_ano_ini']) array_push($query,['sjd_ref_ano','>=',$dados['sjd_ref_ano_ini']]);
        if($dados['sjd_ref_ano_fim']) array_push($query,['sjd_ref_ano','<=',$dados['sjd_ref_ano_fim']]);
        return $query;
    }

    public function query($dados, $proc, $tipo)
    {
        $query = $this->baseQuery($dados);
        if($dados['andamento']) array_push($query,['id_andamento','=',array_search($this->andamento,config('sistema.andamento'))]);
        array_push($query,['situacao','=',sistema('procSituacao',$proc)]);

        return $this->repository->busca($proc, $query, $this->cargos);
    }

    public function cargos($cargos)
    {
        $cargo = [];
        $count = 0;
        foreach ($cargos as $key => $value) {
            if($value !== '0') {
                array_push($cargo,$key);
                $count++;
            }
        } 
        if(!$count) {
            toast()->warning('Deve ter ao menos um Posto/Graduação selecionado','ERRO!');
            return redirect()->back();
        }
        $this->cargos = $cargo;
        return true;
    }
}
