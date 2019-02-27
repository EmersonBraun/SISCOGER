<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ReintegradoPresenter extends Presenter {
	
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
		'cargo',
		'nome',
		'motivo',
		'procedimento',
		'sjd_ref',
		'sjd_ref_ano',
		'retorno_data',
		'bg_numero',
		'bg_ano'
    ];
    */