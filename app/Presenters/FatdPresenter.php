<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class FatdPresenter extends Presenter {
	
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
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'despacho_numero',
		'portaria_data',
		'opm_meta4',
		'publicacaonp',
		'prioridade',
		'situacao_fatd',
		'motivo_fatd',
		'motivo_outros',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'notapunicao_file',
    ];
    */