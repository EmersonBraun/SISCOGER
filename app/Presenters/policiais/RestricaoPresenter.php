<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class RestricaoPresenter extends Presenter {
    
    public function tiponotacomparecimento()
    {
        return array_get(config('sistema.tiponotacomparecimento','Não Há'), $this->id_tiponotacomparecimento);
    }

    public function nome()
    {
        return PolicialRepository::dados($this->rg,'nome');
    }

    public function nomeCadastro()
    {
        return PolicialRepository::dados($this->rg_cadastro,'nome');
    }

    public function opm()
    {
        return PolicialRepository::opm($this->rg);
    }

    public function fimData()
    {
        if(!$this->fim_data) return 'Vigente';
        return $this->fim_data;
    }
    
    public function restricaoArma()
    {
        if($this->arma_bl == 'S') {
            return "<span style='color:red'>Sim</span>";
        } else {
            return "<span>Não</span>";
        }
    }

    public function restricaoFardamento()
    {
        if($this->fardamento_bl == 'S') {
            return "<span style='color:red'>Sim</span>";
        } else {
            return "<span>Não</span>";
        }
    }
}
/*
	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'fardamento_bl',
		'arma_bl',
		'origem',
		'cadastro_data',
		'inicio_data',
		'fim_data',
		'retirada_data',
		'proc',
		'sjd_ref',
		'sjd_ref_ano',
		'obs_txt'
	];
*/
