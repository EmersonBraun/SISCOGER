<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class ApfdPresenter extends Presenter {
	
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
		'tipo',
		'cdopm',
		'fato_data',
		'sintese_txt',
		'tipo_penal',
		'tipo_penal_novo',
		'especificar',
		'doc_tipo',
		'doc_numero',
		'exclusao_txt',
		'opm_meta4',
		'referenciavajme',
		'prioridade'
    ];
    */