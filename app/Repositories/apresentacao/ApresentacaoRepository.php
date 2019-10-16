<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\Apresentacao;
use App\Repositories\BaseRepository;

class ApresentacaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Apresentacao $model)
	{
        $this->model = $model;
        
        $this->verTodasUnidades = session('ver_todas_unidades');
        $this->unidade = session('cdopmbase');
    }

    public function clearCache()
	{
        Cache::tags('apresentacao')->flush();
    }

    public function datesToCreate($dados) {
        $ano = (int) date('Y');

        $ref = $this->maxRef();
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function opmAno($cdopm, $ano)
	{
        if(hasPermissionTo('listar-apresentacoes-reservadas')) $registros = $this->reservados($cdopm, $ano);
        else $registros = $this->publicos($cdopm, $ano);

        return $registros;
    }

    public function publicos($cdopm, $ano)
	{
        $registros = Cache::tags('apresentacao')->remember('apresentacao:publicos:'.$cdopm, self::$expiration, function() use($cdopm, $ano){
            return $this->model->where([
                ['pessoa_opm_codigo','like',"$cdopm%"],
                ['id_apresentacaoclassificacaosigilo','<=','2']
            ])
            ->whereYear('comparecimento_data', $ano)
            ->get();
        });

        return $registros;
    } 

    public function reservados($cdopm, $ano)
	{
        $registros = Cache::tags('apresentacao')->remember('apresentacao:reservados:'.$cdopm, self::$expiration, function() use($cdopm, $ano){
            return $this->model->where('pessoa_opm_codigo','like',"$cdopm%")
            ->whereYear('comparecimento_data', $ano)
            ->get();
        });

        return $registros;
    } 

    public function ano($ano, $cdopm)
	{

        $registros = Cache::tags('apresentacao')->remember('apresentacao:'.$ano.$cdopm, self::$expiration, function() use ($ano, $cdopm) {
            return $this->model->whereYear('comparecimento_data', $ano)->where('pessoa_opm_codigo','like',"$cdopm%")->get();
        });

        return $registros;
    } 


    public function apresentacoesPM($rg)
    {
        $registros = Cache::tags('apresentacao')->remember('apresentacao:rg'.$rg, self::$expiration, function() use ($rg) {
            return $this->model->where('pessoa_rg','=', $rg)->get();
        });

        return $registros;
    }

}

