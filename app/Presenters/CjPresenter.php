<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class CjPresenter extends Presenter {
	
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
    'id_motivoconselho',
    'id_decorrenciaconselho',
    'id_situacaoconselho',
    'outromotivo',
    'cdopm',
    'sjd_ref',
    'sjd_ref_ano',
    'fato_data',
    'abertura_data',
    'sintese_txt',
    'doc_tipo',
    'doc_numero',
    'portaria_numero',
    'portaria_data',
    'doc_prorrogacao',
    'numero_tj',
    'prescricao_data',
    'exclusao_txt',
    'opm_meta4',
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