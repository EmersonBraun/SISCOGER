<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\Apresentacao;
use App\Repositories\BaseRepository;
use App\Services\ICOService;

class ApresentacaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $opm;
    protected $ico;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(
        Apresentacao $model,
        CadastroOPMRepository $opm,
        ICOService $ico
    )
	{
        $this->model = $model;
        $this->opm = $opm;
        $this->ico = $ico;
        
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

    public function get($id)
	{
        // usado para o memorando apresentacao
        $registro = $this->model->findOrFail($id);
        $registro['condicao'] = sistema('apresentacaoCondicao',$registro['id_apresentacaocondicao']);
        $registro['data_ico'] = $this->ico->data(date('Y-m-d'));
        $registro['comparecimento_data_ico'] = $this->ico->data($registro['comparecimento_data']);
        $registro['comparecimento_hora_ico'] = $this->ico->hora($registro['comparecimento_hora']);
        $registro['cod_notificacao'] = $this->ico->cod_notificacao($registro['sjd_ref']);
        $registro['memorando_opm_intermediaria'] = $this->opm->opm_intermediaria($registro['cdopm']);
        $registro['sigla'] = 'SJD';
        return $registro;
    }


    public function opmAno($cdopm, $ano)
	{
        if(hasPermissionTo('listar-apresentacoes-reservadas')) $registros = $this->reservados($cdopm, $ano);
        else $registros = $this->publicos($cdopm, $ano);
        return $registros;
    }

    public function publicos($cdopm, $ano)
	{
        $registros = Cache::tags('apresentacao')->remember('apresentacao:publico:'.$cdopm.$ano, self::$expiration, function() use($cdopm, $ano){
            return $this->model
            ->orWhere('pessoa_opm_codigo','like',"$cdopm%")
            ->orWhere('pessoa_unidade_lotacao_codigo','like',"$cdopm%")
            ->where([
                ['id_apresentacaoclassificacaosigilo','<=','2'],
                ['comparecimento_data','like',"$ano-%"]
            ])
            ->get();
            // dd($registros);
        });

        return $registros;
    } 

    public function reservados($cdopm, $ano)
	{
        $registros = Cache::tags('apresentacao')->remember('apresentacao:reservados:'.$cdopm.$ano, self::$expiration, function() use($cdopm, $ano){
            return $this->model
            ->orWhere('pessoa_opm_codigo','like',"$cdopm%")
            ->orWhere('pessoa_unidade_lotacao_codigo','like',"$cdopm%")
            ->where('comparecimento_data','like',"$ano-%")
            ->get();
        });

        return $registros;
    } 

    public function listNota($id) {
        $registros = Cache::tags('apresentacao')->remember('apresentacao:notacoger:'.$id, self::$expiration, function() use($id){
            return $this->model
            ->where('id_notacomparecimento',$id)
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

}

