<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class PresoPresenter extends Presenter {
    
    public function presotipo()
    {
        return array_get(config('sistema.presotipo','Não Há'), $this->id_presotipo);
    }

    public function opm_quando_preso()
    {
        return OPMRepository::abreviatura($this->cdopm_quandopreso);
    }

    public function opm_prisao()
    {
        return OPMRepository::abreviatura($this->cdopm_prisao);
    }

    public function opmatual()
    {
        return PolicialRepository::opm($this->rg);
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
