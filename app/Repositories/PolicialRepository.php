<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\rhparana\Policial;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class PolicialRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60;  

	public function __construct(Policial $model)
	{
		$this->model = $model;
        
        // ver se vem da api (não logada)
        $proc = Route::currentRouteName(); //listar.algo
        $proc = explode ('.', $proc); //divide em [0] -> listar e [1]-> algo
        $proc = $proc[0];

        $isapi = ($proc == 'api') ? 1 : 0;
        $verTodasUnidades = session('ver_todas_unidades');

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : session('cdopmbase');
    }
     
    //EFETIVO
    public static function efetivoOPM($unidade)
    {
        $efetivo = Cache::remember('efetivo'.$unidade, self::$expiration, function() use ($unidade){

            return $this->model
            ->select('cargo', DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->groupBy('cargo')
                    ->havingRaw('count(cargo) > ?', [0])
                    ->orderBy('qtd','asc')
                    ->get();
            });

        return $efetivo;
    }

    //TOTAL EFETIVO
    public static function totalEfetivoOPM($unidade)
    {
        $total_efetivo = Cache::remember('total_efetivo'.$unidade, self::$expiration, function() use ($unidade){

            return $this->model
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });
        return $total_efetivo;
    }
    //dados principais do policial
    public static function get($rg)
    {
        //busca primeiro nos ATIVOS
        $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','=', $rg)
            ->first();
        //caso não encontre busca nos INATIVOS
        if(is_null($pm))
        {
            $inativo = DB::connection('rhparana')
            ->table('inativos')
            ->where('CBR_NUM_RG','=', $rg)
            ->first();

            //caso não encontre nos inativos busca na RESERVA
            if (is_null($inativo)) 
            {
                $reserva = DB::connection('rhparana')
                ->table('RESERVA')
                ->where('UserRG','=', $rg)
                ->first();

                //Caso não encontre NÃO HÁ DADOS
                if (is_null($reserva)) 
                {
                    $encontrado = false;
                    //cria objeto com dados vazios
                    $pm = (object) [
                        'CARGO' => 'Não encontrado',
                        'QUADRO' => 'Não encontrado',
                        'SUBQUADRO' => 'Não encontrado',
                        'NOME' => 'Não encontrado',
                        'RG' => 'Não encontrado',
                        'OPM_DESCRICAO' => '-',
                        'NASCIMENTO' => 'Não encontrado',
                        'ADMISSAO_REAL' => '',
                        'CIDADE' => 'Não encontrado',
                        'EMAIL_META4' => '-',
                        'SEXO' => 'Não encontrado',
                        'STATUS' => "Não encontrado - Buscado em Ativo, Inativo e Reserva",
                        ];
                } 
                else 
                {
                    $encontrado = true;
                    //cria objeto com dados do reserva
                    $pm = (object) [
                        'CARGO' => $reserva['posto'],
                        'QUADRO' => $reserva['quadro'],
                        'SUBQUADRO' => $reserva['subquadro'],
                        'NOME' => $reserva['nome'],
                        'RG' => $reserva['UserRG'],
                        'OPM_DESCRICAO' => '-',
                        'NASCIMENTO' => '',
                        'ADMISSAO_REAL' => $reserva['data'],
                        'CIDADE' => '-',
                        'EMAIL_META4' => '-',
                        'SEXO' => '-',
                        'STATUS' => "Reserva",
                        'SITUACAO' => "Normal",
                        ];
                }
                
            } 
            else 
            {
                $encontrado = true;
                //cria objeto com dados do inativo
                $pm = (object) [
                'CARGO' => $inativo['cargo'],
                'QUADRO' => $inativo['QUADRO'],
                'SUBQUADRO' => 'RR',
                'NOME' => $inativo['NOME'],
                'RG' => $inativo['CBR_NUM_RG'],
                'OPM_DESCRICAO' => '-',
                'NASCIMENTO' => $inativo['DT_NASC'],
                'ADMISSAO_REAL' => $inativo['DT_INI_RH'],
                'CIDADE' => $inativo['END_CIDADE'],
                'EMAIL_META4' => '-',
                'SEXO' => $inativo['SEXO'],
                'END_RUA' => $inativo['END_LOGRADOURO'],
                'END_NUM' => $inativo['END_NUMERO'],
                'END_COMPL' => $inativo['END_COMPL'],
                'END_BAIRRO' => $inativo['END_BAIRRO'],
                'END_CIDADE' => $inativo['END_CIDADE'],
                'END_CEP' => $inativo['END_CEP'],
                'FONE' => $inativo['FONE'],
                'STATUS' => "Inativo",
                'SITUACAO' => "Normal",
                ];
            }        
        }
        else
        {
            $encontrado = true;
            //força ser objeto
            $pm = (object) $pm;
            //coloca o status e situacao
            $pm->STATUS = 'Ativo';
            $pm->SITUACAO = 'Normal';
        }
        //Idade
        $pm->IDADE = ($encontrado) ? idade($pm->NASCIMENTO) : 'Não encontrado';

        return $pm;
    }

    //dados adicionais
    public static function adicionais($rg)
    {
        $adc = DB::connection('rhparana')
        ->table('efetivo1')
        ->where('CBR_NUM_RG','=', $rg)
        ->first();

        if(is_null($adc))
        {
            $adc = DB::connection('rhparana')
            ->table('efetivo2')
            ->where('CBR_NUM_RG','=', $rg)
            ->first();  
        }
        $adc = (is_null($adc)) ? '' : (object) $adc;

        return $adc;
    }

    public static function comportamentoAtual($pm)
    {
        /*verificar se é oficial
        Se o id_posto for menor ou igual a 6, nao tem comportamento
        1-CEL 2-TENCEL 3-MAJ 4-CAP 5-1TEN 6-2TEN*/

        //$posto = array_get(config('sistema.posto'), $pm->CARGO);
        $posto = sistema('posto', $pm->CARGO);
        //dd($posto);
        if (($posto <=6 && $posto >=1) || ($posto == 0 and substr($posto,0,3)=="CEL")) 
        {
            return "OFICIAL";
        }
        //varifica se é da Reserva
        elseif (trim($posto)=="" AND substr($posto,0,3)!="CEL") {
            return "RESERVA";
        }
        else 
        {
            //PARA AS PRACAS
            //Pega a ultima mudanca de comportamento
            $comportamentopm = Comportamentopm::join('comportamento', 'comportamentopm.id_comportamento', '=', 'comportamento.id_comportamento')
                                ->where('rg','=', $pm->RG)
                                ->get()
                                ->first();

            if (!$comportamentopm)
            {
                return "Nada encontrado";  
            } 
            else 
            {
                return $comportamentopm->comportamento;
            }
        }
    }

    public static function comportamentos($rg='')
    {
        if($rg != '')
        {
            $comportamentos = DB::table('comportamentopm')
            ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento')
            ->where('rg','=', $rg)
            ->orderBy('data','DESC')
            ->get();
        }
        else
        {
            $comportamentos = DB::table('comportamentopm')
            ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento');
        }
        
        return $comportamentos;
    }

    public static function preso($rg='')
    {
        //data de hoje
        $hoje=date("Y-m-d");

        if($rg != '')
        {
        $preso = DB::table('preso')
            ->where('inicio_data','<=', $hoje)
            ->where('fim_data','=', '')
            ->where('rg','=', $rg)
            ->first();

        $preso = (is_null($preso)) ? 'n' : (object) $preso;
        }
        else
        {
            $preso = DB::table('preso')
            ->where('inicio_data','<=', $hoje)
            ->where('fim_data','=', '');
        }
        return $preso;
    }

    public static function suspenso($rg='')
    {
        //data de hoje
        $hoje=date("Y-m-d");

        if($rg != '')
        {
        $suspenso = DB::table('suspenso')
            ->where('inicio_data','<=', $hoje)
            ->where('fim_data','=', '')
            ->where('rg','=', $rg)
            ->first();

        $suspenso = (is_null($suspenso)) ? 'n' : (object) $suspenso;

        }
        else
        {
            $suspenso = DB::table('suspenso')
            ->where('inicio_data','<=', $hoje)
            ->where('fim_data','=', '');
        }

        return $suspenso;
    }

    public static function excluido($rg='')
    {
        //data de hoje
        $hoje=date("Y-m-d");

        if($rg != '')
        {

        $excluido = DB::table('envolvido')
                ->where('resultado','=', 'Excluído')
                ->where('exclusaobg_numero','>', 0)
                ->where('rg','=', $rg)
                ->first();
        
        $excluido = (is_null($excluido)) ? 'n' : (object) $excluido;
        
        }
        else
        {
            $excluido = DB::table('envolvido')
            ->where('resultado','=', 'Excluído')
            ->where('exclusaobg_numero','>', 0); 
        }

        return $excluido;
    }

    public static function subjudice($rg='')
    {
        if($rg != '')
        {

        $subJudice = DB::table('envolvido')
                ->where('ipm_processocrime','=', 'Denunciado')
                ->where('rg','=', $rg)
                ->get();
        
        }
        else
        {
            $subJudice = DB::table('envolvido')
                ->where('ipm_processocrime','=', 'Denunciado');
        }
        return $subJudice;
    }

    public static function denunciaCivil($rg='')
    {
        if($rg != '')
        {

        $denunciaCivil = DB::table('denunciacivil')
        ->where('rg','=', $rg)
        ->get();

        }
        else
        {
            $denunciaCivil = DB::table('denunciacivil'); 
        }
        
        return $denunciaCivil;
    }

    public static function prisoes($rg='')
    {
        if($rg != '')
        {

        $prisoes = DB::table('preso')
                ->where('rg','=', $rg)
                ->get();
        }
        else
        {
            $prisoes = DB::table('preso');
        }

        return $prisoes;
    }

    public static function restricoes($rg='')
    {
        if($rg != '')
        {

        $restricoes = DB::table('restricao')
                    ->where('rg','=', $rg)
                    ->get();
        }
        else
        {
            $restricoes = DB::table('restricao');
        }
        return $restricoes;
    }

    public static function afastamentos($rg='')
    {
        if($rg != '')
        {

        $afastamentos = DB::connection('rhparana')
                        ->table('AUSENCIA')
                        ->where('rg','=', $rg)
                        ->get();
        }
        else
        {
            $afastamentos = DB::connection('rhparana')
            ->table('AUSENCIA'); 
        }

        return $afastamentos;
    }

    public static function dependentes($rg)
    {
        $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_ATIVA')
                ->where('rg','=', $rg)
                ->get();
        
        if(is_null($dependentes))
        {
            $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_INATIVO')
                ->where('rg','=', $rg)
                ->get();
        }
        
        return $dependentes;
    }

    public static function dependentesAtiva($rg='')
    {
        if($rg != '')
        {

        $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_ATIVA')
                ->where('rg','=', $rg)
                ->get();
        
        }
        else
        {
            $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_ATIVA');
        }
        
        return $dependentes;
    }

    public static function dependentesInativo($rg='')
    {
        if($rg != '')
        {

        $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_INATIVO')
                ->where('rg','=', $rg)
                ->get();
        
        }
        else
        {
            $dependentes = DB::connection('rhparana')
                ->table('DEPENDENTES_INATIVO');
        }
        
        return $dependentes;
    }

    public static function sai($rg='')
    {
        if($rg != '')
        {

        $sai = DB::table('envolvido')
                ->leftJoin('sai', 'sai.id_sai', '=', 'envolvido.id_sai')
                ->leftJoin('ligacao', 'ligacao.id_sai', '=', 'envolvido.id_sai')
                ->where('envolvido.rg','=', $rg)
                ->where('envolvido.id_sai','<>', 0)
                ->get();
        }
        else
        {
            $sai = DB::table('envolvido')
                ->leftJoin('sai', 'sai.id_sai', '=', 'envolvido.id_sai')
                ->leftJoin('ligacao', 'ligacao.id_sai', '=', 'envolvido.id_sai')
                ->where('envolvido.id_sai','<>', 0);  
        }
        return $sai;
    }

    public static function tramitacao($rg='')
    {
        if($rg != '')
        {

        $tramitacao = DB::table('tramitacao')
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacao DESC')
                ->get();
        }
        else
        {

        $tramitacao = DB::table('tramitacao');

        }
        return $tramitacao;
    }
    
    public static function tramitacaoopm($rg='')
    {
        if($rg != '')
        {

        $tramitacaoopm = DB::table('tramitacaoopm')
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacaoopm DESC')
                ->get();
        }
        else
        {
            $tramitacaoopm = DB::table('tramitacaoopm');
        }
        return $tramitacaoopm;
    }
    
    public static function procedimentos($rg)
    {
        $envolvido = DB::table('envolvido')
        ->select('envolvido.rg',
                'envolvido.rg_substituto',
                'envolvido.nome',
                'envolvido.situacao',
                'envolvido.resultado',
                'envolvido.id_ipm',
                'envolvido.id_cj',
                'envolvido.id_cd',
                'envolvido.id_adl',
                'envolvido.id_sindicancia',
                'envolvido.id_fatd',
                'envolvido.id_desercao',
                'envolvido.id_apfd',
                'envolvido.id_iso',
                'envolvido.id_it',
                'envolvido.id_pad',
                'envolvido.id_proc_outros')
                ->where('rg','=', $rg);

        $procedimentos = DB::table('ofendido')
                ->unionAll($envolvido)
                ->select(DB::raw('rg, rg as rg2,
                ofendido.nome,
                ofendido.situacao,
                ofendido.resultado,
                ofendido.id_ipm,
                ofendido.id_cj,
                ofendido.id_cd,
                ofendido.id_adl,
                ofendido.id_sindicancia,
                ofendido.id_fatd,
                ofendido.id_desercao,
                ofendido.id_apfd,
                ofendido.id_iso,
                ofendido.id_it,
                ofendido.id_pad,
                ofendido.id_proc_outros'))
                ->where('rg','=', $rg)
                ->get();


        return $procedimentos;
    }

    public static function objetos($rg)
    {
        $envolvido = DB::table('envolvido')
                ->whereIn('situacao', ['Acusado', 'Indiciado', 'Sindicado','Paciente'])
                ->where('rg','=', $rg)
                ->get();
                
        $objetos = array();
        if(count($envolvido) > 0)
        {
        $i=0;
            foreach ($envolvido as $e) {
                if ($e['id_ipm'] !== 0) {
                    $procedimento = 'ipm';
                    $proc = DB::table('ipm')
                    ->where('id_ipm','=', $e['id_ipm'])
                    ->first();
                }elseif ($e['id_cj'] !== 0) {
                    $procedimento = 'cj';
                    $proc = DB::table('cj')
                    ->where('id_cj','=', $e['id_cj'])
                    ->first();
                }elseif ($e['id_cd'] !== 0) {
                    $procedimento = 'cd';
                    $proc = DB::table('cd')
                    ->where('id_cd','=', $e['id_cd'])
                    ->first();
                }elseif ($e['id_adl'] !== 0) {
                    $procedimento = 'adl';
                    $proc = DB::table('adl')
                    ->where('id_adl','=', $e['id_adl'])
                    ->first();
                }elseif ($e['id_sindicancia'] !== 0) {
                    $procedimento = 'sindicancia';
                    $proc = DB::table('sindicancia')
                    ->where('id_sindicancia','=', $e['id_sindicancia'])
                    ->first();
                }elseif ($e['id_fatd'] !== 0) {
                    $procedimento = 'fatd';
                    $proc = DB::table('fatd')
                    ->where('id_fatd','=', $e['id_fatd'])
                    ->first();
                }elseif ($e['id_desercao'] !== 0) {
                    $procedimento = 'desercao';
                    $proc = DB::table('desercao')
                    ->where('id_desercao','=', $e['id_desercao'])
                    ->first();
                }elseif ($e['id_apfd'] !== 0) {
                    $procedimento = 'apfd';
                    $proc = DB::table('apfd')
                    ->where('id_apfd','=', $e['id_apfd'])
                    ->first();
                }elseif ($e['id_iso'] !== 0) {
                    $procedimento = 'iso';
                    $proc = DB::table('iso')
                    ->where('id_iso','=', $e['id_iso'])
                    ->first();
                }elseif ($e['id_it'] !== 0) {
                    $procedimento = 'it';
                    $proc = DB::table('it')
                    ->where('id_it','=', $e['id_it'])
                    ->first();
                }elseif ($e['id_pad'] !== 0) {
                    $procedimento = 'pad';
                    $proc = DB::table('ipm')
                    ->where('id_ipm','=', $e['id_ipm'])
                    ->first();
                }elseif ($e['id_sai'] !== 0) {
                    $procedimento = 'sai';
                    $proc = DB::table('sai')
                    ->where('id_sai','=', $e['id_sai'])
                    ->first();
                }elseif ($e['id_proc_outros'] !== 0) {
                    $procedimento = 'proc_outros';
                    $proc = DB::table('proc_outros')
                    ->where('id_proc_outros','=', $e['id_proc_outros'])
                    ->first();
                }
                if(!isset($proc)){
                    $proc = [
                        'sjd_ref' => 'Apagado',
                        'sjd_ref_ano' => 'Apagado',
                        'sintese_txt' => 'Apagado',
                        'id_andamento' => 'Apagado',
                        'id_andamentocoger' => 'Apagado',
                        'cdopm' => 'Apagado',
                    ];
                    $procedimento = 'Apagado';
                }
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
                $ref = $proc['sjd_ref'];
                $ano = $proc['sjd_ref_ano'];
                $sintese = $proc['sintese_txt'];
                $andamento = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamento',$proc['id_andamento']);
                $andamentocoger = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamentocoger',$proc['id_andamentocoger']);
                $cdopm = ($proc['cdopm'] == 'Apagado') ? 'Apagado' : opm($proc['cdopm']);
                
                $objetos[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $ref,
                    'sjd_ref_ano' => $ano,
                    'sintese_txt' => $sintese,
                    'id_andamento' => $andamento,
                    'id_andamentocoger' => $andamentocoger,
                    'cdopm' => $cdopm
                ];
                $i++;

                
            }
            return $objetos;
        }
        else
        {
            return $objetos;
        }
    
    }

    public static function membros($rg)
    {
        $envolvido = DB::table('envolvido')
                ->whereIn('situacao', ['Encarregado', 'Presidente', 'Acusador'])
                ->where('rg','=', $rg)
                ->get();
        $membros = array();
        if(count($envolvido) > 0)
        {
        $i=0;
            foreach ($envolvido as $e) {
                if ($e['id_ipm'] !== 0) {
                    $procedimento = 'ipm';
                    $proc = DB::table('ipm')
                    ->where('id_ipm','=', $e['id_ipm'])
                    ->first();
                }elseif ($e['id_cj'] !== 0) {
                    $procedimento = 'cj';
                    $proc = DB::table('cj')
                    ->where('id_cj','=', $e['id_cj'])
                    ->first();
                }elseif ($e['id_cd'] !== 0) {
                    $procedimento = 'cd';
                    $proc = DB::table('cd')
                    ->where('id_cd','=', $e['id_cd'])
                    ->first();
                }elseif ($e['id_adl'] !== 0) {
                    $procedimento = 'adl';
                    $proc = DB::table('adl')
                    ->where('id_adl','=', $e['id_adl'])
                    ->first();
                }elseif ($e['id_sindicancia'] !== 0) {
                    $procedimento = 'sindicancia';
                    $proc = DB::table('sindicancia')
                    ->where('id_sindicancia','=', $e['id_sindicancia'])
                    ->first();                      
                }elseif ($e['id_fatd'] !== 0) {
                    $procedimento = 'fatd';
                    $proc = DB::table('fatd')
                    ->where('id_fatd','=', $e['id_fatd'])
                    ->first();
                }elseif ($e['id_desercao'] !== 0) {
                    $procedimento = 'desercao';
                    $proc = DB::table('desercao')
                    ->where('id_desercao','=', $e['id_desercao'])
                    ->first();
                }elseif ($e['id_apfd'] !== 0) {
                    $procedimento = 'apfd';
                    $proc = DB::table('apfd')
                    ->where('id_apfd','=', $e['id_apfd'])
                    ->first();
                }elseif ($e['id_iso'] !== 0) {
                    $procedimento = 'iso';
                    $proc = DB::table('iso')
                    ->where('id_iso','=', $e['id_iso'])
                    ->first();
                }elseif ($e['id_it'] !== 0) {
                    $procedimento = 'it';
                    $proc = DB::table('it')
                    ->where('id_it','=', $e['id_it'])
                    ->first();
                }elseif ($e['id_pad'] !== 0) {
                    $procedimento = 'pad';
                    $proc = DB::table('ipm')
                    ->where('id_ipm','=', $e['id_ipm'])
                    ->first();
                }elseif ($e['id_sai'] !== 0) {
                    $procedimento = 'sai';
                    $proc = DB::table('sai')
                    ->where('id_sai','=', $e['id_sai'])
                    ->first();
                }elseif ($e['id_proc_outros'] !== 0) {
                    $procedimento = 'proc_outros';
                    $proc = DB::table('proc_outros')
                    ->where('id_proc_outros','=', $e['id_proc_outros'])
                    ->first();
                }
                if(!isset($proc)){
                    $proc = [
                        'sjd_ref' => 'Apagado',
                        'sjd_ref_ano' => 'Apagado',
                        'sintese_txt' => 'Apagado',
                        'id_andamento' => 'Apagado',
                        'id_andamentocoger' => 'Apagado',
                        'cdopm' => 'Apagado',
                    ];
                    $procedimento = 'Apagado';
                }
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
                $ref = $proc['sjd_ref'];
                $ano = $proc['sjd_ref_ano'];
                $sintese = $proc['sintese_txt'];
                $andamento = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamento',$proc['id_andamento']);
                $andamentocoger = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamentocoger',$proc['id_andamentocoger']);
                $cdopm = ($proc['cdopm'] == 'Apagado') ? 'Apagado' : opm($proc['cdopm']);
    
                $membros[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $ref,
                    'sjd_ref_ano' => $ano,
                    'sintese_txt' => $sintese,
                    'id_andamento' => $andamento,
                    'id_andamentocoger' => $andamentocoger,
                    'cdopm' => $cdopm
                ];
                $i++;

                
            }
            //dd($membros);
            return $membros;
        }
        else
        {
            return $membros;
        }
    
    }

    public static function elogios($rg='')
    {
        if($rg != '')
        {
            $elogios = DB::table('elogio')
                ->where('rg','=', $rg)
                ->orderBy('elogio_data', 'DESC')
                ->get();
        }
        else
        {
            $elogios = DB::table('elogio');
        }
        
        return $elogios;
    }

    public static function punicoes($rg='')
    {
        if($rg != '')
        {
        $punicoes = DB::table('punicao')
                ->leftJoin('gradacao', 'gradacao.id_gradacao', '=', 'punicao.id_gradacao')
                ->leftJoin('classpunicao', 'classpunicao.id_classpunicao', '=', 'punicao.id_classpunicao')
                ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'punicao.id_comportamento')
                ->where('rg','=', $rg)
                ->orderByRaw('ultimodia_data - id_punicao DESC')
                ->get();
        }
        else
        {
            $punicoes = DB::table('punicao')
                ->leftJoin('gradacao', 'gradacao.id_gradacao', '=', 'punicao.id_gradacao')
                ->leftJoin('classpunicao', 'classpunicao.id_classpunicao', '=', 'punicao.id_classpunicao')
                ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'punicao.id_comportamento');
        }
        return $punicoes;
    }

    public static function apresentacoes($rg)
    {
        $apresentacoes =  DB::table('apresentacao')
        ->where('pessoa_rg','=', $rg)
        ->get();

        return $apresentacoes;
    }

    public static function proc_outros($rg)
    {
        $outros =  DB::table('proc_outros')
        ->leftJoin('envolvido', 'envolvido.id_proc_outros', '=', 'proc_outros.id_proc_outros')
        ->leftJoin('ligacao', 'ligacao.id_proc_outros', '=', 'envolvido.id_proc_outros')
        ->where('rg','=', $rg)
        ->where('envolvido.id_proc_outros','<>', 0)
        ->get();

        return $outros;
    }

    

}

