<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class SaiPresenter extends Presenter {
    
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
		'rg_cadastro',
		'data',
		'docorigem',
		'cdopm',
		'cdopm_fato',
		'cdopm_controle',
		'opm_abreviatura',
		'sintese_txt',
		'digitador',
		'arquivopasta',
		'bou_ano1',
		'bou_numero1',
		'id_municipio',
		'bairro',
		'logradouro',
		'numerodoc',
		'motivo_principal',
		'motivo_secundario',
		'desc_outros',
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'abertura_data',
		'sjd_ref_ano',
		'vtr1_placa',
		'vtr1_prefixo',
		'vtr2_placa',
		'vtr2_prefixo',
		'relatorio1',
		'relatorio1_data',
		'relatorio1_file',
		'relatorio2',
		'relatorio2_data',
		'relatorio2_file',
		'relatorio3',
		'relatorio3_data',
		'relatorio3_file',
		'bou_ano2',
		'bou_ano3',
		'bou_numero2',
		'bou_numero3'
    ];
    */
