<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class ComportamentoPresenter extends Presenter {
    
    public function comportamento()
    {
        return array_get(config('sistema.comportamento','Não Há'), $this->id_comportamento);
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
		'data',
		'motivo_txt',
		'publicacao',
		'id_comportamento',
		'rg',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura'
	];
*/
