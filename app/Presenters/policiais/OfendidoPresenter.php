<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class OfendidoPresenter extends Presenter {
    
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
		'nome',
		'rg',
		'situacao',
		'resultado',
		'sexo',
		'idade',
		'escolaridade',
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
		'id_proc_outros',
		'fone',
		'email'
	];
*/
