<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class EnvolvidoPresenter extends Presenter {
    
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
		'rg_substituto',
		'nome',
		'rg',
		'situacao',
		'cargo',
		'resultado',
		'inclusao_ano',
		'id_ipm',
		'id_cj',
		'id_cd',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_apfd',
		'id_iso',
		'id_it',
		'id_pad',
		'id_sai',
		'ipm_julgamento',
		'ipm_processocrime',
		'ipm_pena_anos',
		'ipm_pena_meses',
		'ipm_pena_dias',
		'ipm_tipodapena',
		'ipm_transitojulgado_bl',
		'ipm_restritiva_bl',
		'obs_txt',
		'exclusaoportaria_data',
		'exclusaoportaria_numero',
		'exclusaoboletim',
		'exclusaobg_numero',
		'exclusaobg_ano',
		'exclusaobg_data',
		'exclusaoopm',
		'id_punicao',
		'id_proc_outros'
	];
*/
