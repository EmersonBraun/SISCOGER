<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class SindicanciaPresenter extends Presenter {
	
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
		'id_andamentocoger',
		'id_andamento',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'portaria_numero',
		'portaria_data',
		'sol_cmt_file',
		'sol_cmt_data',
		'sol_cmtgeral_file',
		'sol_cmtgeral_data',
		'opm_meta4',
		'relatorio_file',
		'relatorio_data',
		'prioridade'
    ];
    */