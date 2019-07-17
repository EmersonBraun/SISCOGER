<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class CdPresenter extends Presenter {
	
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
[
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'libelo_file',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'parecer_file',
		'decisao_file',
		'doc_prorrogacao',
		'sjd_ref',
		'sjd_ref_ano',
		'prescricao_data',
		'parecer_comissao',
		'parecer_cmtgeral',
		'exclusao_txt',
		'rec_ato_file',
		'rec_gov_file',
		'cdopm',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'tjpr_file',
		'stj_file',
		'prioridade'
    ];
    */