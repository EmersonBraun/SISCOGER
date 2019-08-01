<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPM\OPMRepository;
use App\Repositories\OPM\MunicipioRepository;

class ObitoLesaoPresenter extends Presenter {
    
    public function situacao()
    {
        return array_get(config('sistema.situacaoOCOR','Não Há'), $this->id_situacao);
    }

    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }

    public function municipio()
    {
        return MunicipioRepository::nome($this->id_municipio);
    }

}
/*
	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'data',
		'id_municipio',
		'endereco',
		'endereco_numero',
		'cdopm',
		'bou_ano',
		'bou_numero',
		'id_situacao',
		'resultado',
		'descricao_txt'
	];
*/
