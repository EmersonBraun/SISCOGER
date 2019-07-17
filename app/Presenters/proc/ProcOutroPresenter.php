<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class ProcOutroPresenter extends Presenter {
	
    public function createdAt()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function statusPriorityColor()
    {
            $labels = [
                '4'  => 'primary',
                '3'  => 'success',
                '2'  => 'warning',
                '1'  => 'danger'
            ];

            return $labels[$this->prioridade];
    }

}
/*
protected $fillable = [
		'sjd_ref',
		'sjd_ref_ano',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura',
		'cdopm_apuracao',
		'abertura_data',
		'data',
		'bou_ano',
		'bou_numero',
		'id_municipio',
		'doc_origem',
		'num_doc_origem',
		'motivo_abertura',
		'sintese_txt',
		'relatorio1',
		'relatorio1_file',
		'relatorio1_data',
		'relatorio2',
		'relatorio2_file',
		'relatorio2_data',
		'relatorio3',
		'relatorio3_file',
		'relatorio3_data',
		'desc_outros',
		'andamento',
		'andamentocoger',
		'vtr1_placa',
		'vtr1_prefixo',
		'vtr2_placa',
		'vtr2_prefixo',
		'digitador',
		'num_pid',
		'limite_data'
    ];
    */