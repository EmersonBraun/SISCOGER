<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DesercaoPresenter extends Presenter {
	
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
		'doc_tipo',
		'doc_numero',
		'termo_exclusao',
		'termo_exclusao_pub',
		'termo_captura',
		'termo_captura_pub',
		'pericia',
		'pericia_pub',
		'termo_inclusao',
		'termo_inclusao_pub',
		'opm_meta4',
		'referenciavajme',
		'prioridade'
    ];
    */