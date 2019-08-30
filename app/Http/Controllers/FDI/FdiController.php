<?php

namespace App\Http\Controllers\FDI;

use App\Http\Controllers\Controller;
use App\Repositories\PM\PolicialRepository;

class FdiController extends Controller
{
    private $rg;
    public function show(PolicialRepository $policial,$rg)
    {
        $this->rg = $rg;

        $pm = $this->dadosGerais($policial);
        $adc = $this->dadosAdicionais($policial);
        $pm->comportamento = $this->comportamento($policial, $pm);
        $preso = $this->preso($policial);
        $suspenso = $this->suspenso($policial);
        $excluido = $this->excluido($policial);
        $subJudice = $this->subJudice($policial);
        $denunciaCivil = $this->denunciaCivil($policial);
        $prisoes = $this->prisoes($policial);
        $restricoes = $this->restricoes($policial);
        $dependentes = $this->dependentes($policial);
        $sai = $this->sai($policial);
        $objetos = $this->objetos($policial);
        $membros = $this->membros($policial);
        $comportamentos = $this->comportamentos($policial);
        $elogios = $this->elogios($policial);
        $punicoes = $this->punicoes($policial);
        $tramitacao = $this->tramitacao($policial);
        $tramitacaoopm = $this->tramitacaoopm($policial);
        $apresentacoes = $this->apresentacoes($policial);
        $proc_outros = $this->procOutros($policial);

        $proc = '';

        if($suspenso && $suspenso !== 'n') $pm->SITUACAO = 'Suspenso';
        if($preso && $preso !== 'n') $pm->SITUACAO = 'Preso';
        if($excluido && $excluido !== 'n') $pm->SITUACAO = 'Excluído';
        if($subJudice) {
            $pm->SITUACAO = 'Sub Júdice';
        } else {
            $subJudice = [];
        }
        if($denunciaCivil) {
            $pm->SITUACAO = 'Sub Júdice';
        } else {
            $denunciaCivil = [];
        }
        //dd($membros);
        return view('FDI.ficha', compact('rg',
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
        'dependentes',
        'sai',
        'tramitacao',
        'tramitacaoopm',
        'objetos',
        'membros',
        'comportamentos',
        'elogios',
        'punicoes',
        'apresentacoes',
        'proc_outros'
        ));
    }

    public function dadosGerais($policial) //informações gerais
    {
        return $policial->get($this->rg);
    }
    
    public function dadosAdicionais($policial) //Informações adicionais
    {
        return $policial->adicionais($this->rg);
    }
    
    public function comportamento($policial, $pm) //comportamento
    {
        return $policial->comportamentoAtual($pm);
    }
    
    public function preso($policial) //verificar se está preso
    {
        return  $policial->preso($this->rg);
    }
    
    public function suspenso($policial) //Verifica se esta suspenso.
    {
        return $policial->suspenso($this->rg);
    }

    public function excluido($policial) //Verifica se esta excluido. 
    {
        return $policial->excluido($this->rg);
    }

    public function subJudice($policial) //SUB JUDICE
    {
        return $policial->subjudice($this->rg);
    }

    public function denunciaCivil($policial) //Consulta das denuncias civis
    {
        return $policial->denunciaCivil($this->rg);
    }
    
    public function prisoes($policial) //prisões
    {
        return $policial->prisoes($this->rg);
    }

    public function restricoes($policial) 
    {
        return $policial->restricoes($this->rg);
    }

    public function afastamentos($policial) 
    {
        return $policial->afastamentos($this->rg);
    }

    public function dependentes($policial) 
    {
        return $policial->dependentes($this->rg);
    }

    public function sai($policial) 
    {
        return $policial->sai($this->rg);
    }
    public function objetos($policial) 
    {
        return $policial->objetos($this->rg);
    }

    public function membros($policial) 
    {
        return $policial->membros($this->rg);
    }

    public function comportamentos($policial) 
    {
        return $policial->comportamentos($this->rg);
    }

    public function elogios($policial) 
    {
        return $policial->elogios($this->rg);
    }

    public function punicoes($policial) 
    {
        return $policial->punicoes($this->rg);
    }

    public function tramitacao($policial) 
    {
        return $policial->tramitacao($this->rg);
    }

    public function tramitacaoopm($policial) 
    {
        return $policial->tramitacaoopm($this->rg);
    }

    public function apresentacoes($policial) 
    {
        return $policial->apresentacoes($this->rg);
    }

    public function procOutros($policial) 
    {
        return $policial->proc_outros($this->rg);
    }
}
