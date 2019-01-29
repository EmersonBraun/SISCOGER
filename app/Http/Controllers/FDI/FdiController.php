<?php

namespace App\Http\Controllers\FDI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Sjd\Policiais\Comportamentopm as Comportamentopm;
use App\Repositories\Policial;
use App\Models\Sjd\Policiais\Preso;

class FdiController extends Controller
{

    public function show($rg, Comportamentopm $comportamentopm)
    {
        //data de hoje
        $hoje=date("Y-m-d");

        //informações gerais

        $pm = Policial::get($rg);

        //Informações adicionais
        $adc = Policial::adicionais($rg);

        //comportamento
        $pm->comportamento = Policial::comportamentoAtual($pm);
        
        //verificar se está preso
        $preso = Policial::preso($rg);
        if($preso != 'n') $pm->SITUACAO = 'Preso';

        //Verifica se esta suspenso. 
        $suspenso = Policial::suspenso($rg);
        if($suspenso != 'n') $pm->SITUACAO = 'Suspenso';

        //Verifica se esta excluido. 
        $excluido = Policial::excluido($rg);
        if($excluido != 'n') $pm->SITUACAO = 'Excluído';

        //SUB JUDICE
        $subJudice = Policial::subjudice($rg);
        if(count($subJudice) > 0) $pm->SITUACAO = 'Sub Júdice';
        $proc = '';

        //Consulta das denuncias civis
        $denunciaCivil = Policial::denunciaCivil($rg);
        if(count($denunciaCivil)) $pm->SITUACAO = 'Sub Júdice';

        //prisões
        $prisoes = Policial::prisoes($rg);

        //restrições
        $restricoes = Policial::restricoes($rg);

        //afastamentos
        $afastamentos = Policial::afastamentos($rg);

        //dependentes
        $dependentes = Policial::dependentes($rg);
        
        //sai
        $sai = Policial::sai($rg);
        
        //objetos
        $objetos = Policial::objetos($rg);
        
        //membros
        $membros = Policial::membros($rg);
        
        //comportamentos
        $comportamentos = Policial::comportamentos($rg);

        //elogios
        $elogios = Policial::elogios($rg);

        //punicoes
        $punicoes = Policial::punicoes($rg);

        //tramitacao
        $tramitacao = Policial::tramitacao($rg);

        //tramitacaoopm
        $tramitacaoopm = Policial::tramitacaoopm($rg);

        //apresentacoes
        $apresentacoes = Policial::apresentacoes($rg);

        //outros
        $proc_outros = Policial::proc_outros($rg);
        //dd($membros);
        return view('FDI.ficha', compact(
            'pm',
            'adc',
            'preso',
            'suspenso',
            'excluido',
            'subJudice',
            'proc',
            'denunciaCivil',
            'prisoes',
            'restricoes',
            'afastamentos',
            'dependentes',
            'sai',
            'tramitacao',
            'tramitacaoopm',
            //'procedimentos',
            'objetos',
            'membros',
            'comportamentos',
            'elogios',
            'punicoes',
            'apresentacoes',
            'proc_outros'
        ));
    }

}
