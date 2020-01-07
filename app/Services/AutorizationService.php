<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use App\Repositories\proc\EncaminhamentoRepository;
use App\Repositories\PM\EnvolvidoRepository;
use Illuminate\Support\Facades\Route;

class AutorizationService 
{
    protected $data;
    protected $name = 'fdi';
    protected $cdopm = false;
    protected $nivel;
    // para fdi
    protected $opm_descricao = false;
    protected $status;
    // para proc
    protected $id;

    protected $encaminhamento;
    protected $envolvido;

    public function __construct(
        EncaminhamentoRepository $encaminhamento,
        EnvolvidoRepository $envolvido
    )
	{
        $this->encaminhamento = $encaminhamento;
        $this->envolvido = $envolvido;
    }

    // salvar os dados para os comparativos
    public function bootService($data, $name)
    {
        // validar se existe
        if(!$data) return 'Faltam os dados';
        if(!$name) return 'Falta o nome';
        // cast para array
        $data = $this->convertDataToArray($data);
        
        // atribuições
        $this->nivel = $this->getCorrectNivel();
        // dd(session('nivel'));
        $this->name = $name;
        try {
            $this->cdopm = $data['CDOPM'];
        } catch (\Throwable $th) {
            //throw $th;
            $this->cdopm = $data['cdopm'];
        }
        
        if($this->name == 'fdi') {
            try {
                $this->opm_descricao = $data['OPM_DESCRICAO'];
            } catch (\Throwable $th) {
                //throw $th;
                $this->opm_descricao = $data['opm_descricao'];
            }
            $this->status = $data['STATUS'];
        } else {
            $this->id = $data['id_'.$name];
        }
    }

    public function convertDataToArray($data)
    {
        if($data instanceof Illuminate\Database\Eloquent\Collection)  $data = $data->toArray();
        if(is_object($data)) $data = json_decode(json_encode($data), true);
        return $data;
    }


    public function canSee($data, $name)
	{
        if(!session('rg')) abort(401,'Not Logged');
        if(!$this->cdopm) $this->bootService($data, $name);
        $data = $this->convertDataToArray($data);

        $canSeeOPM = $this->canSeeOPM($data, $name);
        if(!$canSeeOPM) toast()->error('Você não tem acesso a PPMM de outras OM');

        $canSeeSuperior = $this->canSeeSuperior($data, $name);
        if(!$canSeeSuperior) toast()->error('Você não tem acesso a ficha de superiores');

        $canSeeInativo = $this->canSeeInativo($data, $name);
        if(!$canSeeInativo) toast()->error('Você não tem acesso a ficha de Inativos/Reserva');

        if(!$canSeeOPM || !$canSeeSuperior || !$canSeeInativo) abort(403);
        return true;
    }

    // ----------- comparativos para ver se pode ver a OPM ---------------
    public function canSeeOPM($data, $name)
    {
        if(!$this->cdopm) $this->bootService($data, $name); 
        $canSeeAllOpm = $this->verTodasOPM();
        if($canSeeAllOpm) return true;
        $isTheSameOpm = $this->isTheSameOPM();
        if($isTheSameOpm) return true;
        $hasAutorizationToSeeOtherOPM = $this->autorizationToSeeOtherOPM($data);
        if($hasAutorizationToSeeOtherOPM) return true;
        return false;
    }

    public function isCRPM()
    {
        if(strlen(session('cdopmbase')) == 1) return true;
    }

    /* se pode ver todas unidades já passa */
    public function verTodasOPM()
    {
        if(hasPermissionTo('todas-unidades')) return true;
        return false;
    }

    public function isTheSameOPM()
    {
        /* comparativo por CRPM */
        $sammeCRPM = $this->comparateByCRPM();
        if($sammeCRPM) return true;
        /* comparativo por código base */
        $equalCodeBase = $this->comparateByCodeBase();
        if($equalCodeBase) return true;
        /* comparativo pelos 3 primeiros dígitos */
        $equalFirstNums = $this->comparateByFirstsNums();
        if($equalFirstNums) return true;
        /* comparativo pelo primeiro nome da OM */
        if($this->name == 'fdi') {
            $equalName = $this->comparateByName();
            if($equalName) return true;
        }
        return false;  
    }

    public function comparateByCRPM()
    {
        if($this->isCRPM() && session('cdopmbase') == substr($this->cdopm,0,1)) return true;
        return false;
    }
 
    public function comparateByCodeBase()
    {
        $cod_base = corta_zeros($this->cdopm);
        if($cod_base == session('cdopmbase')) return true;
        return false;
    }

    public function comparateByFirstsNums()
    {
        $prim_num_sessao = substr(session('cdopm'),0,3);
        $prim_num_ficha = substr($this->cdopm,0,3);
        if($prim_num_ficha == $prim_num_sessao) return true;
        return false;
    }

    public function comparateByName()
    {
        $nome_sessao = explode(' ',session('opm_descricao'))[0];
        $nome_ficha = explode(' ',$this->opm_descricao)[0];
        if(strtoupper($nome_ficha) == strtoupper($nome_sessao)) return true;
        return false;
    }  

    public function autorizationToSeeOtherOPM($data)
    {
        // outras autorizações de visualização
        $autorizationByUser = $this->getAutorizationByUser();
        if($autorizationByUser) return true;
        $atualEncaminhamentoIsThisOPM = $this->atualEncaminhamentoIsThisOPM($data);
        if($atualEncaminhamentoIsThisOPM) return true;
        return false;
    }

    public function getAutorizationByUser()
    {
        // aqui pode ser colocada alguma regra que seja criada para dar autorização a usuários
        return false;
    }

    public function atualEncaminhamentoIsThisOPM($data)
    {
        // $id = $this->id;
        // $encaminhamento = $this->encaminhamento->getByProcId($this->name, $id);
        // if(!$encaminhamento) return false;
        // $this->cdopm = $encaminhamento->cdopm_destino;
        
        // $isTheSameOpm = $this->isTheSameOPM();
        // if($isTheSameOpm) return true;
        return false;
    }


    //teste para verificar se pode ver superior, caso não possa aborta
    public function canSeeSuperior($data, $name)
	{
        if(!$this->cdopm) $this->bootService($data, $name);
        $canSeeSuperior = ($this->name == 'fdi') ?
        $this->comparatePostoWithFDI($data) :
        $this->comparatePostoWithEnvolvidos($data);
        if($canSeeSuperior) return true;
        return false;
    }

    /**
     * Aqui ficam as regras de acesso de subordinados a superiores
     * caso sejam criadas novas regras só adicionar aqui
     */
    public function getCorrectNivel()
    {
        $oficiais = in_array('ver-superior-oficiais',session('permissions'));
        if($oficiais) return sistema('posto','CELAGREG'); //mais alto cargo na lista (sistema.posto)
        $pracas = in_array('ver-superior-pracas',session('permissions'));
        if($pracas) return sistema('posto','SUBTEN'); //mais alto cargo na lista (sistema.posto)
        return session('nivel');
    }

    public function comparatePostoWithEnvolvidos($data)
    {
        // pegar posto mais alto (cod mais baixo)
        $maxPosto = $this->envolvido->maxPosto($this->name, $this->id);
        if(!$maxPosto || $maxPosto->id_posto >= $this->nivel) return true;
        return false;
    }

    public function comparatePostoWithFDI($data)
    {
        $cargo = isset($data['CARGO']) ? $data['CARGO'] : $data['cargo'];
        $nivel_ficha = sistema('posto', $cargo);
        if($nivel_ficha >= $this->nivel) return true;

        return false;
    }

    public function canSeeInativo($data, $name)
    {
        if(!$this->cdopm) $this->bootService($data, $name);
        $canSeeInativo = ($this->name == 'fdi') ?
        $this->canSeeInativoFDI() :
        $this->canSeeEnvolvidoInativoProc($data, $name);
        if($canSeeInativo) return true;
        return false;
    }

    public function canSeeInativoFDI()
    {
        // se a ficha é de ativo já passa
        if($this->status == 'Ativo') return true;
        $hasPermissionToSeeInativo = $this->hasPermissionToSeeInativo();
        if($hasPermissionToSeeInativo) return true;
        return false;
    }

    public function canSeeEnvolvidoInativoProc($data, $name)
    {
        // aqui é para ser criada lógica se algum envolvido é inativo
        return true;
    }

    public function hasPermissionToSeeInativo()
    {
        $verInativo = in_array('ver-inativo',session('permissions'));
        $verReserva = in_array('ver-reserva',session('permissions'));
        if($verReserva || $verInativo) return true;
        return false;
    }

    public function isApi()
    {
        $proc = Route::currentRouteName(); //listar.algo
        $proc = explode ('.', $proc); //divide em [0] -> listar e [1]-> algo
        $proc = $proc[0];

        return ($proc == 'api') ? true : false;
    }
 
}



