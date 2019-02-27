<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ItPresenter extends Presenter {
	
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
		'cdopm',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'vtr_placa',
		'vtr_prefixo',
		'vtr_propriedade',
		'portaria_numero',
		'boletiminterno_numero',
		'boletiminterno_data',
		'tipo_acidente',
		'avarias',
		'situacao_objeto',
		'sintese_txt',
		'br_numero',
		'situacaoviatura',
		'acordoamigavel',
		'id_causa_acidente',
		'id_resp_civil',
		'arquivo_numero',
		'protocolo_numero',
		'acaojudicial',
		'danoestimado_rs',
		'danoreal_rs',
		'opm_meta4',
		'objetoprocedimento',
		'identificacao_arma',
		'identificacao_municao',
		'identificacao_semovente',
		'outros',
		'relatorio_data',
		'solucao_unidade_data',
		'solucao_complementar_data',
		'relatorio_file',
		'solucao_unidade_file',
		'solucao_complementar_file',
		'prioridade'
    ];
    */