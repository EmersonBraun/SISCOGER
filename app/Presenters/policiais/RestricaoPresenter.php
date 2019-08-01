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

    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }

    public function nome()
    {
        return PolicialRepository::dados($this->rg,'nome');
    }

    public function nomeCadastro()
    {
        return PolicialRepository::dados($this->rg_cadastro,'nome');
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
