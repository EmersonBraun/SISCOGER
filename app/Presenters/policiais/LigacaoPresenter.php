<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class LigacaoPresenter extends Presenter {
    
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
		'origem_opm',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_proc',
		'destino_sjd_ref',
		'destino_sjd_ref_ano',
		'destino_proc',
		'id_adl',
		'id_apfd',
		'id_cd',
		'id_cj',
		'id_desercao',
		'id_fatd',
		'id_ipm',
		'id_iso',
		'id_it',
		'id_sindicancia',
		'id_preso',
		'id_falecimento',
		'id_sai',
		'id_proc_outros'
	];
*/
