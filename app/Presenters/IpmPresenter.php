<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class IpmPresenter extends Presenter {
	
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
		'id_municipio',
		'id_situacao',
		'cdopm',
		'opm_sigla',
		'opm_ref',
		'opm_ref_ano',
		'sjd_ref',
		'sjd_ref_ano',
		'abertura_data',
		'fato_data',
		'autuacao_data',
		'crime',
		'tentado',
		'crime_especificar',
		'sintese_txt',
		'relato_enc',
		'relato_enc_data',
		'relato_cmtopm',
		'relato_cmtopm_data',
		'relato_cmtgeral',
		'relato_cmtgeral_data',
		'vajme_ref',
		'justicacomum_ref',
		'vitima',
		'confronto_armado_bl',
		'vitima_qtdd',
		'julgamento',
		'portaria_numero',
		'exclusao_txt',
		'relato_enc_file',
		'relato_cmtopm_file',
		'relato_cmtgeral_file',
		'relcomplementar_file',
		'defensor_oab',
		'defensor_nome',
		'relcomplementar_data',
		'opm_meta4',
		'bou_ano',
		'bou_numero',
		'prioridade'
    ];
    */