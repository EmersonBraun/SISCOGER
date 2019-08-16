<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\rhparana\Policial;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;
use App\Models\Sjd\Policiais\Comportamentopm as Comportamentopm;

class PolicialRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 *24;  

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
    public function efetivoOPM($unidade)
    {
        $efetivo = Cache::tags('policial')->remember('efetivo:'.$unidade, $this->expiration, function() use ($unidade){

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

    public function totalEfetivoOPM($unidade)//TOTAL EFETIVO
    {
        $total_efetivo = Cache::tags('policial')->remember('total_efetivo:'.$unidade, $this->expiration, function() use ($unidade){

            return $this->model
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });
        return $total_efetivo;
    }
    
    public function get($rg)//dados principais do policial
    {
        $militar_estadual = Cache::remember('fdi:'.$rg, $this->expiration, function() use ($rg)
        {
            $pm = $this->pm($rg);
            if(is_null($pm)){//caso não encontre busca nos INATIVOS
                $inativo = $this->inativo($rg);

                if (is_null($inativo)) {//caso não encontre nos inativos busca na RESERVA
                    $reserva = $this->reserva($rg);

                    if (is_null($reserva)) {//Caso não encontre NÃO HÁ DADOS
                        $encontrado = false;
                        $tabela = null;
                        //cria objeto com dados vazios
                        $pm = $this->PMnaoEncontrado();
                    } else {
                        $encontrado = true;
                        $tabela = 'Reserva';
                        //cria objeto com dados do reserva
                        $pm = $this->PMreserva($reserva);
                    }
                } else {
                    $encontrado = true;
                    $tabela = 'Inativo';
                    //cria objeto com dados do inativo
                    $pm = $this->PMinativo($inativo);
                }        
            }else{
                $encontrado = true;
                $tabela = 'Ativo';
                //força ser objeto
                $pm = (object) $pm;
                //coloca o status e situacao
                $pm->STATUS = 'Ativo';
                $pm->SITUACAO = 'Normal';
            }
            //Idade
            $pm->IDADE = ($encontrado) ? idade($pm->NASCIMENTO) : 'Não encontrado';

            return $pm;
        });
        return $militar_estadual;
    }

    public static function dados($rg, $dado)
    {
        $dados = Cache::remember('pm:dados:'.$rg, 60, function() use ($rg)
        {
            $ativo = (array) DB::connection('rhparana')->table('policial')->where('rg','=', $rg)->first();
            if($ativo) return $ativo;
            $inativo = (array) DB::connection('rhparana')->table('inativos')->where('CBR_NUM_RG','=', $rg)->first();
            if($inativo) return $inativo;
            $reserva = (array) DB::connection('rhparana')->table('RESERVA')->where('UserRG','=', $rg)->first();
            if($reserva) return $reserva;
            return 'Não Encontrado';
        });
        return $dados[$dado];
    }

    public static function opm($rg, $tipo='')
    {
        $dados = Cache::remember('pm:unidade:'.$rg, 60, function() use ($rg)
        {
            return Policial::where('rg','=', $rg)->first();
        });
        if($dados) {
            if($tipo == 'cod' || $tipo == 'cdopm') {
                if(isset($dados['CDOPM'])) return $dados['CDOPM'];
                return false;
            }
            if($tipo == 'base' || $tipo == 'cdopm_base') {
                if(isset($dados['CDOPM'])) return corta_zeros($dados['CDOPM']);
                return false;
            }
            if(!$tipo) {
                if(isset($dados['OPM_DESCRICAO'])) return $dados['OPM_DESCRICAO'];
                return 'Não encontado';
            }
        }
        return 'Não encontado';
    }

    public function pm($rg)
    {
        return DB::connection('rhparana')->table('policial')->where('rg','=', $rg)->first();
    }

    public function inativo($rg)
    {
        return DB::connection('rhparana')->table('inativos')->where('CBR_NUM_RG','=', $rg)->first();
    }

    public function reserva($rg)
    {
        return DB::connection('rhparana')->table('RESERVA')->where('UserRG','=', $rg)->first();
    }

    public function PMnaoEncontrado()
    {
        return (object) [
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

    public function PMreserva($reserva)
    {
        return (object) [
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

    public function PMinativo($inativo)
    {
        return (object) [
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

    public function adicionais($rg)
    {
        $adc = DB::connection('rhparana')->table('efetivo1')->where('CBR_NUM_RG','=', $rg)->first();

        if(is_null($adc)){
            $adc = DB::connection('rhparana')->table('efetivo2')->where('CBR_NUM_RG','=', $rg)->first();  
        }
        $adc = (is_null($adc)) ? '' : (object) $adc;

        return $adc;
    }

    public function sugest($dados) 
    {
        $result = [];
        $limit = 10 / $dados['opts'];

        if(in_array('ativos',$dados['tables'], true)){
            $query = DB::connection('rhparana')
            ->table('policial')->select('rg','nome')
            ->where($dados['type'],'like', '%'.$dados['search'].'%')
            ->distinct($dados['type']);
            $ativos = $query->limit(ceil($limit))->get()->toArray();
        }else {
            $ativos = [];
        }

        if(in_array('inativos',$dados['tables'], true)){
            $type = ($dados['type'] == 'rg') ? 'CBR_NUM_RG' : 'nome';
            $query = DB::connection('rhparana')
            ->table('inativos')->select('CBR_NUM_RG as rg','nome')
            ->where($type,'like', '%'.$dados['search'].'%')
            ->distinct($type);
            $inativos = $query->limit(floor($limit))->get()->toArray();
        }else {
            $inativos = [];
        }

        if(in_array('reserva',$dados['tables'], true))
        {
            $type = ($dados['type'] == 'rg') ? 'UserRG' : 'nome';
            $query = DB::connection('rhparana')
            ->table('RESERVA')->select('UserRG as rg','nome')
            ->where($type,'like', '%'.$dados['search'].'%')
            ->distinct($type);
            $reserva = $query->limit(floor($limit))->get()->toArray();
        }else {
            $reserva = [];
        }
        
        return array_merge($ativos, $inativos, $reserva);
    }

    public function comportamentoAtual($pm)
    {
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
            $comportamentopm = Comportamentopm::join('comportamento', 'comportamentopm.id_comportamento', '=', 'comportamento.id_comportamento')
                                ->where('rg','=', $pm->RG)
                                ->get()
                                ->first();

            if (!$comportamentopm) return "Nada encontrado";  
            return $comportamentopm->comportamento;
        }
    }

    public function comportamentos($rg='')
    {
        return DB::table('comportamentopm')
            ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento')
            ->where('rg','=', $rg)
            ->orderBy('data','DESC')
            ->get();
    }

    public function comportamentogeral()
    {
        return DB::table('comportamentopm')
        ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'comportamentopm.id_comportamento')
        ->get();
    }

    public function preso($rg='')
    {
        $preso = DB::table('preso')
            ->where('inicio_data','<=', date("Y-m-d"))
            ->where('fim_data','=', '')
            ->where('rg','=', $rg)
            ->first();

        $preso = (is_null($preso)) ? 'n' : (object) $preso;
        return $preso;
    }

    public function presoGeral()
    {
        return $preso = DB::table('preso')
        ->where('inicio_data','<=', date("Y-m-d"))
        ->where('fim_data','=', '')
        ->get();
    }

    public function suspenso($rg='')
    {
        return DB::table('suspenso')
            ->where('inicio_data','<=', date("Y-m-d"))
            ->where('fim_data','=', '')
            ->where('rg','=', $rg)
            ->first();
    }

    public function suspensoGeral()
    {
        return DB::table('suspenso')
        ->where('inicio_data','<=', date("Y-m-d"))
        ->where('fim_data','=', '')
        ->get();
    }

    public function excluido($rg='')
    {
        $excluido = DB::table('envolvido')
                ->where('resultado','=', 'Excluído')
                ->where('exclusaobg_numero','>', 0)
                ->where('rg','=', $rg)
                ->first();
        
        $excluido = (is_null($excluido)) ? 'n' : (object) $excluido;

        return $excluido;
    }

    public function excluidoGeral()
    {
        return DB::table('envolvido')
        ->where('resultado','=', 'Excluído')
        ->where('exclusaobg_numero','>', 0); 
    }

    public function subjudice($rg='')
    {
        return DB::table('envolvido')
                ->where('ipm_processocrime','=', 'Denunciado')
                ->where('rg','=', $rg)
                ->get();
        
    }

    public function subJudiceGeral()
    {
        return DB::table('envolvido')->where('ipm_processocrime','=', 'Denunciado')->get();
    }

    public function denunciaCivil($rg='')
    {
        return DB::table('denunciacivil')
        ->where('rg','=', $rg)
        ->get();
    }

    public function denunciaCivilGeral()
    {
        return DB::table('denunciacivil')->get(); 
    }

    public function prisoes($rg='')
    {
        return DB::table('preso')
                ->where('rg','=', $rg)
                ->get();
    }

    public function prisoesGeral()
    {
        return  DB::table('preso')->get();
    }

    public function restricoes($rg='')
    {
       return DB::table('restricao')
                    ->where('rg','=', $rg)
                    ->get();

    }

    public function restricoesGeral()
    {
        return DB::table('restricao')->get();
    }

    public function afastamentos($rg='')
    {
        return DB::connection('rhparana')
                        ->table('AUSENCIA')
                        ->where('rg','=', $rg)
                        ->get();
    }

    public function afastamentosGeral() 
    {
        return DB::connection('rhparana')->table('AUSENCIA')->get();
    }

    public function dependentes($rg)
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

    public function dependentesAtiva($rg='')
    {
        return DB::connection('rhparana')
                ->table('DEPENDENTES_ATIVA')
                ->where('rg','=', $rg)
                ->get();
    }

    public function dependentesAtivageral()
    {
        return DB::connection('rhparana')->table('DEPENDENTES_ATIVA')->get();
    }

    public function dependentesInativo($rg='')
    {
        return DB::connection('rhparana')
                ->table('DEPENDENTES_INATIVO')
                ->where('rg','=', $rg)
                ->get();
    }

    public function dependentesInativoGeral()
    {
        return DB::connection('rhparana')->table('DEPENDENTES_INATIVO')->get();
    }

    public function sai($rg='')
    {
        return DB::table('envolvido')
                ->leftJoin('sai', 'sai.id_sai', '=', 'envolvido.id_sai')
                ->leftJoin('ligacao', 'ligacao.id_sai', '=', 'envolvido.id_sai')
                ->where('envolvido.rg','=', $rg)
                ->where('envolvido.id_sai','<>', 0)
                ->get();
    }

    public function saiGeral()
    {
        return DB::table('envolvido')
        ->leftJoin('sai', 'sai.id_sai', '=', 'envolvido.id_sai')
        ->leftJoin('ligacao', 'ligacao.id_sai', '=', 'envolvido.id_sai')
        ->where('envolvido.id_sai','<>', 0);
    }

    public function tramitacao($rg='')
    {
        return DB::table('tramitacao')
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacao DESC')
                ->get();
    }

    public function tramitacaoGeral()
    {
        return  DB::table('tramitacao')->get();
    }
    
    public function tramitacaoopm($rg)
    {
        return DB::table('tramitacaoopm')
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacaoopm DESC')
                ->get();
    }

    public function tramitacaoopmGeral()
    {
        return DB::table('tramitacaoopm')->get();
    }
    
    public function procedimentos($rg)
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

    public function objetos($rg)
    {
        $situacao = ['Acusado', 'Indiciado', 'Sindicado','Paciente'];
        $envolvido = $this->envolvidos($rg, $situacao);
                
        $objetos = array();
        if(count($envolvido) > 0){
        $i=0;
            foreach ($envolvido as $e) {
                $procedimento = $this->procedimento($e);
                $proc = $this->envolvido($procedimento, $e);
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
                
                $objetos[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $proc['sjd_ref'],
                    'sjd_ref_ano' => $proc['sjd_ref_ano'],
                    'sintese_txt' => $proc['sintese_txt'],
                    'id_andamento' => $proc['id_andamento'],
                    'id_andamentocoger' => $proc['id_andamentocoger'],
                    'cdopm' => $proc['cdopm']
                ];
                $i++;     
            }
            return $objetos;
        }
        return $objetos;
    
    }

    public function membros($rg)
    {
        $situacao = ['Encarregado', 'Presidente', 'Acusador'];
        $envolvido = $this->envolvidos($rg, $situacao);
        $membros = array();
        if(count($envolvido) > 0){
        $i=0;
            foreach ($envolvido as $e) {
                $procedimento = $this->procedimento($e);
                $proc = $this->envolvido($procedimento, $e);
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
    
                $membros[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $proc['sjd_ref'],
                    'sjd_ref_ano' => $proc['sjd_ref_ano'],
                    'sintese_txt' => $proc['sintese_txt'],
                    'id_andamento' => $proc['id_andamento'],
                    'id_andamentocoger' => $proc['id_andamentocoger'],
                    'cdopm' => $proc['cdopm']
                ];
                $i++;

                
            }
            return $membros;
        }
        return $membros;
    }

    public function envolvidos($rg, $situacao)
    {
        return DB::table('envolvido')
                ->whereIn('situacao', $situacao)
                ->where('rg','=', $rg)
                ->get();
    }

    public function envolvido($procedimento, $e)
    {
        if($procedimento == 'Apagado') {
            return [
                'sjd_ref' => 'Apagado',
                'sjd_ref_ano' => 'Apagado',
                'sintese_txt' => 'Apagado',
                'id_andamento' => 'Apagado',
                'id_andamentocoger' => 'Apagado',
                'cdopm' => 'Apagado',
            ];
        }

        $proc = DB::table($procedimento)->where('id_'.$procedimento,'=', $e['id_'.$procedimento])->first();
        $proc = $this->procedimentoFormatadoParaRetorno($proc);
        return $proc;
    }

    public function procedimento($e)
    {
        if ($e['id_ipm'] !== 0) return 'ipm';
        elseif ($e['id_cj'] !== 0) return 'cj';
        elseif ($e['id_cd'] !== 0) return 'cd';
        elseif ($e['id_adl'] !== 0) return 'adl';
        elseif ($e['id_sindicancia'] !== 0) return 'sindicancia';
        elseif ($e['id_fatd'] !== 0) return 'fatd';
        elseif ($e['id_desercao'] !== 0) return 'desercao';
        elseif ($e['id_apfd'] !== 0) return 'apfd';
        elseif ($e['id_iso'] !== 0) return 'iso';
        elseif ($e['id_it'] !== 0) return 'it';
        elseif ($e['id_pad'] !== 0) return 'pad';
        elseif ($e['id_sai'] !== 0) return 'sai';
        elseif ($e['id_proc_outros'] !== 0) return 'proc_outros';
        else return 'Apagado';
    }

    public function procedimentoFormatadoParaRetorno($proc)
    {
        if(isset($proc['id_andamento'])) $proc['id_andamento'] = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamento',$proc['id_andamento']);
        if(isset($proc['id_andamentocoger'])) $proc['id_andamentocoger'] = ($proc['id_andamentocoger'] == 'Apagado') ? 'Apagado' : sistema('andamentocoger',$proc['id_andamentocoger']);
        if(isset($proc['cdopm'])) $proc['cdopm'] = ($proc['cdopm'] == 'Apagado') ? 'Apagado' : opm($proc['cdopm']);

        return $proc;
    }

    public function elogios($rg)
    {
        $elogios = DB::table('elogio')
            ->where('rg','=', $rg)
            ->orderBy('elogio_data', 'DESC')
            ->get();

        return $elogios;
    }
    public function elosgiosGerais()
    {
        return DB::table('elogio')->get();
    }


    public function punicoes($rg)
    {
        $punicoes = DB::table('punicao')
                ->leftJoin('gradacao', 'gradacao.id_gradacao', '=', 'punicao.id_gradacao')
                ->leftJoin('classpunicao', 'classpunicao.id_classpunicao', '=', 'punicao.id_classpunicao')
                ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'punicao.id_comportamento')
                ->where('rg','=', $rg)
                ->orderByRaw('ultimodia_data - id_punicao DESC')
                ->get();

        return $punicoes;
    }

    public function punicoesGerais()
    {
        $punicoes = DB::table('punicao')
                ->leftJoin('gradacao', 'gradacao.id_gradacao', '=', 'punicao.id_gradacao')
                ->leftJoin('classpunicao', 'classpunicao.id_classpunicao', '=', 'punicao.id_classpunicao')
                ->leftJoin('comportamento', 'comportamento.id_comportamento', '=', 'punicao.id_comportamento');

        return $punicoes;
    }

    public function apresentacoes($rg)
    {
        $apresentacoes =  DB::table('apresentacao')
        ->where('pessoa_rg','=', $rg)
        ->get();

        return $apresentacoes;
    }

    public function proc_outros($rg)
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

