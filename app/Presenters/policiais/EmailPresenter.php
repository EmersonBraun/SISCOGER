<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\OPM\OPMRepository;

class EmailPresenter extends Presenter {
    
    public function tiponotacomparecimento()
    {
        return array_get(config('sistema.tiponotacomparecimento','Não Há'), $this->id_tiponotacomparecimento);
    }

    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }

    public function nome()
    {
        return PolicialRepository::dados($this->rg,'nome');
    }

    public function nomeCadastro()
    {
        return PolicialRepository::dados($this->rg_cadastro,'nome');
    }
}
/*
	protected $fillable = [
		'contexto_email',
		'id_contexto_email',
		'remetente_nome',
		'remetente_email',
		'destinatario_nome',
		'destinatario_email',
		'assunto',
		'mensagem_txt',
		'formato',
		'anexos',
		'usuario_rg',
		'dh',
		'dh_agendamento',
		'dh_ult_tentativa_com_erro',
		'nr_tentativas_com_erro',
		'erros',
		'prioridade',
		'dh_envio',
		'dh_confirmacao_de_leitura',
		'dh_cancelamento',
		'usuario_rg_cancelamento'
	];
*/