<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

use App\Models\rhparana\Policial;

use App\Repositories\PM\AfastamentoRepository;
use App\Repositories\PM\ComportamentoRepository;
use App\Repositories\PM\DenunciacivilRepository;
use App\Repositories\PM\DependenteRepository;
use App\Repositories\PM\ExcluidoRepository;
use App\Repositories\PM\EnvolvidoRepository;
use App\Repositories\PM\ElogioRepository;
use App\Repositories\PM\InativoRepository;
use App\Repositories\PM\PunidoRepository;
use App\Repositories\PM\PresoRepository;
use App\Repositories\PM\ReservaRepository;
use App\Repositories\PM\RestricaoRepository;
use App\Repositories\PM\SaiRepository;
use App\Repositories\PM\SuspensoRepository;
use App\Repositories\PM\TramitacaoRepository;
use App\Repositories\PM\TramitacaoopmRepository;
use App\Repositories\PM\ProtocoloRepository;

use App\Repositories\apresentacao\ApresentacaoRepository;
use App\Repositories\proc\ProcRepository;
use App\Repositories\log\logRepository;

class PolicialRepository extends BaseRepository
{
    protected $policial; 
    protected $inativo;
    protected $reserva;
    protected $comportamento;
    protected $preso;
    protected $suspenso;
    protected $excluido;
    protected $envolvido;
    protected $denunciaCivil;
    protected $restricao;
    protected $afastamento;
    protected $dependente;
    protected $sai;
    protected $elogio;
    protected $punido;
    protected $tramitacao;
    protected $tramitacaoopm;
    protected $proc;
    protected $apresentacao;
    protected $log;
    protected $protocolo;

    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 *24;  

	public function __construct(
        Policial $policial,
        InativoRepository $inativo,
        ReservaRepository $reserva,
        ComportamentoRepository $comportamento,
        PresoRepository $preso,
        SuspensoRepository $suspenso,
        ExcluidoRepository $excluido,
        EnvolvidoRepository $envolvido,
        DenunciacivilRepository $denunciaCivil,
        RestricaoRepository $restricao,
        AfastamentoRepository $afastamento,
        DependenteRepository $dependente,
        SaiRepository $sai,
        ElogioRepository $elogio,
        PunidoRepository $punido,
        TramitacaoRepository $tramitacao,
        TramitacaoopmRepository $tramitacaoopm,
        ProcRepository $proc,
        ApresentacaoRepository $apresentacao,
        logRepository $log,
        ProtocoloRepository $protocolo
    )
	{
        $this->policial = $policial;
        $this->inativo = $inativo;
        $this->reserva = $reserva;
        $this->comportamento = $comportamento;
        $this->preso = $preso;
        $this->suspenso = $suspenso;
        $this->excluido = $excluido;
        $this->envolvido = $envolvido;
        $this->denunciaCivil = $denunciaCivil;
        $this->restricao = $restricao;
        $this->afastamento = $afastamento;
        $this->dependente = $dependente;
        $this->sai = $sai;
        $this->elogio = $elogio;
        $this->punido = $punido;
        $this->tramitacao = $tramitacao;
        $this->tramitacaoopm = $tramitacaoopm;
        $this->proc = $proc;
        $this->apresentacao = $apresentacao;
        $this->log = $log;
        $this->protocolo = $protocolo;

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

            return $this->policial
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

            return $this->policial
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });
        return $total_efetivo;
    }
    
    public function get($rg)//dados principais do policial
    {
        // $militar_estadual = Cache::remember('fdi:'.$rg, $this->expiration, function() use ($rg)
        // {
            $pm = $this->pm($rg);
            if(is_null($pm)){//caso não encontre busca nos INATIVOS
                $pm = $this->inativo($rg);

                if (!$pm) {//caso não encontre nos inativos busca na RESERVA
                    $pm = $this->reserva($rg);

                    if (!$pm) {//Caso não encontre NÃO HÁ DADOS
                        $encontrado = false;
                        $tabela = null;
                        //cria objeto com dados vazios
                        $pm = $this->PMnaoEncontrado();
                    } else {
                        $encontrado = true;
                        $tabela = 'Reserva';
                    }
                } else {
                    $encontrado = true;
                    $tabela = 'Inativo';
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

        // });
        // // dd($militar_estadual);

        // return $militar_estadual;
    }

    public static function dados($rg, $dado) // dados usados em presenters
    {
        $dados = Cache::remember('pm:dados:'.$rg, 60, function() use ($rg)
        {
            $ativo = DB::connection('rhparana')->table('policial')->where('rg','=', $rg)->first();
            if($ativo) $dados = $ativo;
            $inativo = DB::connection('rhparana')->table('inativos')->where('CBR_NUM_RG','=', $rg)->first();
            if($inativo) $dados = $inativo;
            $reserva = DB::connection('rhparana')->table('RESERVA')->where('UserRG','=', $rg)->first();
            if($reserva) $dados = $reserva;
            $dados = [];

            return $dados;
        });
        if(!$dados) return 'Não encontrado';
        if(array_key_exists($dado,$dados)) return $dados[$dado];
        return 'Não encontrado';
        
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

    public function opcoes($dado, $type)
    {
        $codigoOPM = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = hasPermissionTo('todas-unidades');
        
        if ($verTodasUnidades) {
        $pm = $this->policial->where($type,'like', "%".$dado."%")
            ->limit(10)
            ->get();

        } else {
            $pm = $this->policial->where($type,'like', "%".$dado."%")
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->limit(10)
            ->get();           
        }
        return response()->json($pm);
        
    }

    public function getByName($name)
    {
        return $this->policial->where('nome','like', '%'.$name.'%')->first();
    }

    public function pm($rg)
    {
        $registros = Cache::tags('pm')->remember('pm:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->policial->where('rg', $rg)->first();
        });

        return $registros;
    }

    public function ativo($rg)
    {
        return $this->pm($rg);
    }

    public function inativo($rg)
    {
        return $this->inativo->get($rg);
    }

    public function reserva($rg)
    {
        return $this->reserva->get($rg);
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

    public function adicionais($rg)
    {
        $adc = DB::connection('rhparana')->table('efetivo1')->where('CBR_NUM_RG','=', $rg)->first();

        if(is_null($adc)){
            $adc = DB::connection('rhparana')->table('efetivo2')->where('CBR_NUM_RG','=', $rg)->first();  
        }
        $adc = (is_null($adc)) ? false : (object) $adc;
        return $adc;
    }

    public function sugest($dados) 
    {
        $result = [];
        $limit = 10 / $dados['opts'];

        if(in_array('ativos',$dados['tables'], true)){
            $query = $this->policial->select('rg','nome')
            ->where($dados['type'],'like', '%'.$dados['search'].'%')
            ->distinct($dados['type']);
            $ativos = $query->limit(ceil($limit))->get()->toArray();
        }else {
            $ativos = [];
        }

        if(in_array('inativos',$dados['tables'], true)){
            $inativos = $this->inativo->sugest($dados, $limit);
        }else {
            $inativos = [];
        }

        if(in_array('reserva',$dados['tables'], true))
        {
            $reserva = $this->reserva->sugest($dados, $limit);
        }else {
            $reserva = [];
        }
        
        return array_merge($ativos, $inativos, $reserva);
    }

    public function sugestions($type, $data) 
    { //mostrar sugestões buscando por RG ou  NOME
        $type = strtolower($type); 
        $search = $this->policial
        ->join('opmPMPR','POLICIAL.CDOPM','=','opmPMPR.CODIGO')
        ->where($type,'like', '%'."$data%")
        ->distinct($type)->get();

        return $search;
    }


    public function comportamentoAtual($pm)
    {
        return $this->comportamento->comportamentoAtual($pm);

    }

    public function comportamentos($rg)
    {
        return $this->comportamento->comportamentoPM($rg);

    }

    public function preso($rg)
    {
        return $this->preso->estaPreso($rg);
    }

    public function suspenso($rg)
    {
        return $this->suspenso->estaSuspenso($rg);
    }

    public function excluido($rg)
    {
        return $this->excluido->estaExcluido($rg);
    }

    public function subjudice($rg)
    {
        return $this->envolvido->estaSubjudice($rg);   
    }

    public function denunciaCivil($rg)
    {
        return $this->denunciaCivil->estaDenunciado($rg);
    }

    public function prisoes($rg)
    {
        return $this->preso->prisoes($rg);
    }

    public function restricoes($rg='')
    {
       return $this->restricao->restricoes($rg);
    }

    public function afastamentos($rg='')
    {
        return $this->afastamento->afastamentos($rg);
    }

    public function dependentes($rg)
    {
        return $this->dependente->dependentes($rg);
    }

    public function sai($rg)
    {

        return $this->envolvido->sai($rg);
    }

    public function tramitacao($rg)
    {
        return $this->tramitacao->tramitacaoPM($rg);
    }
    
    public function tramitacaoopm($rg)
    {
        return $this->tramitacaoopm->tramitacaoopmPM($rg);
    }
    
    public function procedimentos($rg)
    {
        return $this->proc->procedimentos($rg);
    }

    public function objetos($rg)
    {
        return $this->envolvido->objetos($rg);
    }

    public function membros($rg)
    {
        return $this->envolvido->membros($rg);
    }

    public function elogios($rg)
    {
        return $this->elogio->elogiosPM($rg);
    }

    public function punicoes($rg)
    {
        return $this->punido->punicoes($rg);
    }

    public function apresentacoes($rg)
    {
        return $this->apresentacao->apresentacoesPM($rg);
    }

    public function proc_outros($rg)
    {
        return $this->envolvido->procOutros($rg);
    }

    public function log($rg)
    {
        return $this->log->LogFdiRG($rg);
    }

    public function protocolo($rg)
    {
        return $this->protocolo->protocolo($rg);
    }
}

