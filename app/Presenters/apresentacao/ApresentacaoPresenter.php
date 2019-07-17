<?php
namespace App\Presenters\apresentacao;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class ApresentacaoPresenter extends Presenter {
    
    public function tiponotacomparecimento()
    {
        return array_get(config('sistema.tiponotacomparecimento','Não Há'), $this->id_tiponotacomparecimento);
    }

    public function pm()
    {
        return OPMRepository::abreviatura($this->rg);
    }


}
/*
protected $fillable = [
		'chave_de_acesso',
		'id_notacomparecimento',
		'id_apresentacaoclassificacaosigilo',
		'id_apresentacaosituacao',
		'id_apresentacaonotificacao',
		'pessoa_rg',
		'pessoa_posto',
		'pessoa_quadro',
		'pessoa_nome',
		'pessoa_email',
		'pessoa_unidade_lotacao_meta4',
		'pessoa_unidade_lotacao_codigo',
		'pessoa_unidade_lotacao_sigla',
		'pessoa_unidade_lotacao_descricao',
		'pessoa_opm_meta4',
		'pessoa_opm_codigo',
		'pessoa_opm_sigla',
		'pessoa_opm_descricao',
		'documento_de_origem',
		'documento_de_origem_data',
		'documento_de_origem_file',
		'id_apresentacaotipoprocesso',
		'autos_numero',
		'autos_ano',
		'acusados',
		'id_apresentacaocondicao',
		'comparecimento_data',
		'comparecimento_hora',
		'comparecimento_dh',
		'comparecimento_local_txt',
		'id_localdeapresentacao',
		'observacao_txt',
		'usuario_rg',
		'criacao_dh',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'memorando_pdf'
    ];
    */