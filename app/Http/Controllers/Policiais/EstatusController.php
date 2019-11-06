<?php

namespace App\Http\Controllers\Policiais;

use App\Http\Controllers\Controller;
use App\Repositories\PM\DenunciacivilRepository;
use App\Repositories\PM\ExcluidoRepository;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\PM\PresoRepository;
use App\Repositories\PM\RestricaoRepository;
use App\Repositories\PM\SuspensoRepository;

class EstatusController extends Controller
{
    protected $rg;
    protected $denuncia;
    protected $excluido;
    protected $preso;
    protected $restricao;
    protected $suspenso;
    protected $policial;

    public function __construct(
        DenunciacivilRepository $denuncia,
        ExcluidoRepository $excluido,
        PresoRepository $preso,
        PolicialRepository $policial,
        RestricaoRepository $restricao,
        SuspensoRepository $suspenso
    )
	{
        $this->denuncia = $denuncia;
        $this->excluido = $excluido;
        $this->preso = $preso;
        $this->policial = $policial;
        $this->restricao = $restricao;
        $this->suspenso = $suspenso;
    }

    public function total($rg)
    {
        $this->rg = $rg;
        $pm = $this->getName($rg);
        if(!$pm) return response()->json($this->vazio(), 404);

        return [
            'rg' => $rg,
            'nome'=> $pm->NOME,
            'denunciado'=> (bool) $this->denunciado(),
            'excluido' => (bool) $this->excluido(),
            'preso' => (bool) $this->preso(),
            'restricao_arma' => (bool) $this->restricaoArma(),
            'restricao_fardamento' => (bool) $this->restricaoFarda(),
            'suspenso' => (bool) $this->suspenso()
        ];
    }

    public function lista()
    {
        return 
        ['42601446','48990738','81842744','44306450','64733095','65284472','49757123','54204337','64333640','70472694',
            '76404011','50338223','71318036','72105010','43133047','63389102','73512484','72467647','58573612','77649484',
            '65982579','92052230','40573950','44758032','61066225','92330150','58631485','80908237','81065934','39850176',
            '66020525','58510521','43468308','49251874','70651211','49574630','42355313','41905794','42589756','37491616',
            '39718359','63817503','59270362','130881270','72161505','42595608','70249472','58581470','86772124','73720591',
            '53371175','58494348','57918284','62952083','62952083','61851542','60096147','70011611','62952083','55369313',
            '68599903','84227005','58961680','60173800','58614599','68679346','66162354','64285726','81749930','82454705',
            '59534068','41716169','83503025','87525929','82548025','76161399','61126791','87081818','91796511','66076156',
            '73693217','65107678','84878049','63214124','85156659','86158604','52495709','96567308','91800748','123383427',
            '80737220','104820450','90690949','49747349','60006083','72216695','82645748','76154929','48830021','46264401',
            '88570057','82568808','97530726','70721627','73290880','70757966','58319325','75027931','77353984','106504105',
            '79864641','110583427','110413700','71156630','59805916','85839870','68412668','96573405','104465668','91297337',
            '77249540','88157958','82396810','139819284','65191229','71450414','98560629','51977238','96422644','65357895',
            '105732023','78215135','58481394','96095902','45116778','85797530','55380880','87144941','75846339','87960315',
            '72186257','62703512','61588647','79530581','105382960','102309090','59504371','135173991','84233927','81359431',
            '53025730','62767642','85875140','97498237','90281259','87983986','91211734','82432450','71697835','83269170',
            '124770408','95399819','52032130','69995470','124104963','98838309','94208840','130213251','75354207','83052732',
            '142065584','88279611','78893885','82821201','103925959','63718050','73081718','44308762','68209900','61385991',
            '104506194','79459917','71597318','55974780','77557180','139663535','97673322','81011630','51975260','75320817',
            '67367235','108724609','107353437','110654332','124272521','98778195','89772702','92980324','98965726','70801116',
            '69857280','85034391','88593049','69272959','92770710','94661633','64940589','70519313','92933709','80099525',
            '80746539','89210410','91470039','98309748','88182375','135027278','86012634','94211662','87050629','86719088',
            '71164349','108761199','72504925','59483668','87694305','66960862','88840097','83961333','68404886','130092756',
            '104337007','88819918','72504267','66302032','70881233','72180992','44916630','46262131','84631957','105679327',
            '104242472','79850195','102248651','73381398','79864501','77529829','97857717','55736014','75405588','134848723',
            '60363439','84854670','83178850','139839960','76295921','53519660','98723870','84128635','71047415','67802357',
            '72484630','76233420','71612821','78145889','58700347','99482001','83140976','75866704','44936798','65811367',
            '62641738','82122028','77592580','85871501','72051254','85308890','95655157','89191017','84966088','68406919',
            '87197751','47074886','44791382','49468660','45890821'];
    }

    public function operacaoVerao()
    {
        $registros = [];
        foreach ($this->lista() as $key => $value) {
            array_push($registros,$this->total($value));  
        }
        return view('relatorios.outros.lista_restricoes',compact('registros'));
    }

    protected function vazio()
    {
        return [
            'nome'=> 'Não Encontrado',
            'denunciado'=> false,
            'excluido' => false,
            'preso' => false,
            'restricao_arma' => false,
            'restricao_fardamento' => false,
            'suspenso' => false
        ];
    }

    protected function getName()
    {
        return $this->policial->get($this->rg);
    }

    protected function denunciado()
    {
        return $this->denuncia->estaDenunciado($this->rg);
    }

    protected function excluido()
    {
        return $this->excluido->estaExcluido($this->rg);
    }

    protected function preso()
    {
        return $this->preso->estaPreso($this->rg);
    }

    protected function restricaoArma()
    {
        return $this->restricao->arma($this->rg);
    }

    protected function restricaoFarda()
    {
        return $this->restricao->fardamento($this->rg);
    }

    protected function suspenso()
    {
        return $this->suspenso->estaSuspenso($this->rg);
    }
}
