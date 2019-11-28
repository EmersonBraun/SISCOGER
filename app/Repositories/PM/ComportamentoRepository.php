<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Cache;
use App\Models\Sjd\Policiais\Comportamentopm;
use App\Models\rhparana\Policial;
use App\Models\rhparana\Policial2;
use App\Repositories\BaseRepository;

class ComportamentoRepository extends BaseRepository
{
    protected $model;
    protected $policial;
    protected $policial2;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24 * 7;  //uma semana
    protected $partes = 4; // quantidade de partes que divide a consulda de SD1C

	public function __construct(Comportamentopm $model, Policial $policial, Policial2 $policial2)
	{
        $this->model = $model; 
        $this->policial = $policial;     
        $this->policial2 = $policial2;  
    }
    
    public function cleanCache()
	{
        Cache::tags('comportamento')->flush();
    }

    public function pracasOPM($unidade)
    {
        $rgs = Cache::tags('comportamento')->remember('rg:'.$unidade, $this->expiration, function() use ($unidade){
            $cargos = [
                ['cargo', '<>', 'CELAGREG'],
                ['cargo', '<>', 'CEL'],
                ['cargo', '<>', 'TENCEL'],
                ['cargo', '<>', 'MAJ'],
                ['cargo', '<>', 'CAP'],
                ['cargo', '<>', '1TEN'],
                ['cargo', '<>', '2TEN'],
            ];

            try {
                return $this->policial->select('rg')->where('cdopm', 'LIKE', $unidade.'%')->where($cargos)->get();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->policial2->select('rg')->where('cdopm', 'LIKE', $unidade.'%')->where($cargos)->get();
            }

        });
        return $rgs;
    }

    public function comportamentos($unidade)
    {
        $rgs = $this->pracasOPM($unidade);
        
        if($rgs) {

            $comportamentos = Cache::tags('comportamento')->remember('comportamento:'.$unidade, 600, function() use ($rgs, $unidade){
               /*busca na VIEW comportamento_pracas que é a junção das tabelas 
                *comportamento e comportamentopm
                */
                return DB::connection('sjd')
                ->table('comportamento_pracas')
                ->whereIn('rg',$rgs)
                ->where('cdopm','like',$unidade.'%')
                ->get();
            });

            return $comportamentos;
        }

        return [];

    }

    public function rgsPosto($posto)
    {
        if($posto == 'SD1C') return abort(403);
        $rgs = Cache::tags('comportamento')->remember('rg:Posto:'.$posto, 600, function() use ($posto){
            try {
                return $this->policial->where('cargo', $posto)->get();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->policial2->where('cargo', $posto)->get();
            }

        });
        return $rgs;
    }

    public function rgSoldados($parte)
    {
        //SD1C tive que dividir pois eram muitos registros estavam causando lentidão
        $rgs = Cache::tags('comportamento')->remember('rg:posto:soldados:'.$parte, $this->expiration, function() use ($parte){

            try {
                $count = $this->policial->where('cargo', 'SD1C')->count(); //total
            } catch (\Throwable $th) {
                //throw $th;
                $count = $this->policial2->where('cargo', 'SD1C')->count(); //total
            }

            $partes = (int) ceil($count / $this->partes); //valor de cada parte

            try {
                $total = $this->policial->where('cargo', 'SD1C')->get(); //todos registros
            } catch (\Throwable $th) {
                //throw $th;
                $total = $this->policial2->where('cargo', 'SD1C')->get(); //todos registros
            }
            
            $atual = 0;
            $dividido = [];
            for($i = 1; $i <= $this->partes; $i++) { //divide e salva as partes no array
                array_push($dividido, $total->slice($atual,$partes));
                $atual += $partes;
            }
            return $dividido[$parte - 1];
        });

        return $rgs;
    }

    public function rgsAlunos()
    {
        // juntei pois eram muito pouco
        $rgs = Cache::tags('comportamento')->remember('rg:posto:alunos', $this->expiration, function() {
            try {
                return $this->policial 
                ->orWhere('cargo', 'ALUNO1A')
                ->orWhere('cargo', 'ALUNO2A')
                ->orWhere('cargo', 'ALUNO3A')
                ->get();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->policial2 
                ->orWhere('cargo', 'ALUNO1A')
                ->orWhere('cargo', 'ALUNO2A')
                ->orWhere('cargo', 'ALUNO3A')
                ->get();
            }
             
        });
        return $rgs;
    }

    public function posto($posto, $parte)
    {
        if($posto == 'SD1C') {
            if(intval($parte) > $this->partes) return abort(403);
            $policiais = $this->rgSoldados($parte);
        }else if($posto == 'ALUNO'){
            $policiais = $this->rgsAlunos();
        }else $policiais = $this->rgsPosto($posto);


        $comportamentos = Cache::tags('comportamento')->remember('comportamento:praca:'.$posto.':'.$parte, $this->expiration, function() use ($policiais){
            $registros = [];
        
            foreach($policiais as $policial){
                // apagar esse registro quando houver alteração Cache::pull('comportamento:rg:'.$policial['RG'])
                $result = Cache::rememberForever('comportamento:rg:'.$policial['RG'], function() use ($policial){
                    try {
                        return $this->model
                            ->select('rg','id_comportamento',DB::raw("MAX(data) as data_comportamento"))
                            ->where('rg',$policial['RG'])
                            ->groupBy('rg')
                            ->first();
                    } catch (\Throwable $th) {
                        return $th;
                    }
                    
                });

                if($result) {
                    // adicionado dados do meta 4
                    $result['nome'] = $policial['NOME'];
                    $result['classe'] = $policial['CLASSE'];
                    $result['opm_descricao'] = $policial['OPM_DESCRICAO'];
                    array_push($registros,$result);
                }
            }

            return $registros;
        });

        return $comportamentos;

    }

    public function comportamentoAtual($rg)
    {
        try {
            $pm = $this->policial->where('rg',$rg)->first();
        } catch (\Throwable $th) {
            //throw $th;
            $pm = $this->policial2->where('rg',$rg)->first();
        }
        
        /*verificar se é oficial
        Se o id_posto for menor ou igual a 6, nao tem comportamento
        1-CEL 2-TENCEL 3-MAJ 4-CAP 5-1TEN 6-2TEN*/

        //$posto = array_get(config('sistema.posto'), $pm->CARGO);
        $posto = sistema('posto', $pm->CARGO);
        if (($posto <=6 && $posto >=1) || ($posto == 0 and substr($posto,0,3)=="CEL")) return "OFICIAL";
        //verifica se é da Reserva
        elseif (trim($posto)=="" AND substr($posto,0,3)!="CEL") return "RESERVA";
        else {
            //PARA AS PRACAS Pega a ultima mudanca de comportamento
            $comportamentopm = $this->model->join('comportamento', 'comportamentopm.id_comportamento', '=', 'comportamento.id_comportamento')
                                ->where('rg','=', $pm->RG)
                                ->orderBy('comportamentopm.data','DESC')
                                ->first();
            if (!$comportamentopm) return "Nada encontrado";  
            return $comportamentopm->comportamento;
        }
    }

    public function comportamentoPM($rg)
    {
        $comportamentos = DB::table('comportamentopm')
            ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento')
            ->where('rg','=', $rg)
            ->orderBy('comportamentopm.data','DESC')
            ->get();

        return $comportamentos;

    }

    public function comportamentogeral()
    {
        return DB::table('comportamentopm')
        ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento')
        ->get();
    }
}

