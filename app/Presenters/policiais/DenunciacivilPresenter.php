<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class DenunciacivilPresenter extends Presenter {
    
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
		'rg_cadastro',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'processocrime',
		'julgamento',
		'tipodapena',
		'pena_anos',
		'pena_meses',
		'pena_dias',
		'transitojulgado_bl',
		'restritiva_bl',
		'obs_txt'
	];
*/
