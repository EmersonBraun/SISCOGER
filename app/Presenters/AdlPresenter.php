<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class AdlPresenter extends Presenter {
    
    public function andamento()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamento);
    }

    public function andamentocoger()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamentocoger);
    }

    public function motivoconselho()
    {
        return array_get(config('sistema.motivoconselho','Não Há'), $this->id_motivoconselho);
    }

    public function decorrenciaconselho()
    {
        return array_get(config('sistema.decorrenciaconselho','Não Há'), $this->id_decorrenciaconselho);
    }

    public function situacaoconselho()
    {
        return array_get(config('sistema.situacaoconselho','Não Há'), $this->id_situacaoconselho);
    }

    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }
    
    // public function createdAt()
    // {
    //     return $this->created_at->format('d/m/Y');
    // }

    // public function statusPriorityColor()
    // {
    //         $labels = [
    //             '4'  => 'primary',
    //             '3'  => 'success',
    //             '2'  => 'warning',
    //             '1'  => 'danger'
    //         ];

    //         return $labels[$this->prioridade];
    // }

}
/*
protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'doc_prorrogacao',
		'sjd_ref',
		'sjd_ref_ano',
		'prescricao_data',
		'parecer_comissao',
		'parecer_cmtgeral',
		'exclusao_txt',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'libelo_file',
		'parecer_file',
		'decisao_file',
		'rec_ato_file',
		'rec_gov_file',
		'tjpr_file',
		'stj_file',
		'prioridade'
    ];
    */