<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class SobrestamentoPresenter extends Presenter {
	
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
		'rg',
		'inicio_data',
		'publicacao_inicio',
		'termino_data',
		'publicacao_termino',
		'motivo',
		'id_cj',
		'id_cd',
		'id_sindicancia',
		'id_fatd',
		'id_iso',
		'id_it',
		'id_adl',
		'id_pad',
		'id_sai',
		'id_proc_outros',
		'doc_controle_inicio',
		'doc_controle_termino'
    ];
    */