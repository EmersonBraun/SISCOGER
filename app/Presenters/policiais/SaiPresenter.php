<?php
namespace App\Presenters\policiais;

use App\Presenters\BasePresenter;

class SaiPresenter extends BasePresenter {

    public function resultado()
    {
        if($this->origem_proc) {
            return $this->origem_proc.' - '.$this->origem_sjd_ref.' / '.$this->origem_sjd_ref_ano;
        } else {
            return 'Não há';
        }
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
