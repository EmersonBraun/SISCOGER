<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class IsoPresenter extends Presenter {
	
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
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'tipo_penal',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'exclusao_txt',
		'opm_meta4',
		'relatoriomedico_file',
		'solucaoautoridade_file',
		'relatoriomedico_data',
		'solucaoautoridade_data',
		'prioridade'
    ];
    */