<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class MovimentoPresenter extends Presenter {
	
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
		'id_ipm',
		'id_cj',
		'id_cd',
		'data',
		'descricao',
		'rg',
		'opm',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_iso',
		'id_apfd',
		'id_it',
		'id_pad',
		'id_sai',
		'id_proc_outros'
    ];
    */