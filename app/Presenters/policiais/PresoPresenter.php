<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class PresoPresenter extends Presenter {
    
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
		'nome',
		'cargo',
		'cdopm_quandopreso',
		'cdopm_prisao',
		'localreclusao',
		'local',
		'processo',
		'natureza',
		'complemento',
		'numeromandado',
		'id_presotipo',
		'origem_proc',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_opm',
		'inicio_data',
		'fim_data',
		'vara',
		'comarca',
		'obs_txt'
	];
*/
