<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 17 Sep 2019 14:16:18 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Email
 * 
 * @property int $id_email
 * @property string $contexto_email
 * @property string $id_contexto_email
 * @property string $remetente_nome
 * @property string $remetente_email
 * @property string $destinatario_nome
 * @property string $destinatario_email
 * @property string $assunto
 * @property string $mensagem_txt
 * @property string $formato
 * @property string $anexos
 * @property string $usuario_rg
 * @property \Carbon\Carbon $dh
 * @property \Carbon\Carbon $dh_agendamento
 * @property \Carbon\Carbon $dh_ult_tentativa_com_erro
 * @property int $nr_tentativas_com_erro
 * @property string $erros
 * @property int $prioridade
 * @property \Carbon\Carbon $dh_envio
 * @property \Carbon\Carbon $dh_confirmacao_de_leitura
 * @property \Carbon\Carbon $dh_cancelamento
 * @property string $usuario_rg_cancelamento
 *
 * @package App\Models
 */
class Email extends Eloquent
{
	protected $table = 'email';
	protected $primaryKey = 'id_email';
	public $timestamps = false;

	protected $casts = [
		'nr_tentativas_com_erro' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'dh',
		'dh_agendamento',
		'dh_ult_tentativa_com_erro',
		'dh_envio',
		'dh_confirmacao_de_leitura',
		'dh_cancelamento'
	];

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
    
    //mutators (para alterar na hora da exibição)
	public function getDhAttribute($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
    }
    
    public function getDhAgendamentoAttribute($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
    }
    
    public function getDhUltTentativaComErroAttribute($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
    }
    
    public function getDhEnvioAttribute($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
    }
    
    public function getDhConfirmacaoDeLeituraAttribute($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
    }
    
    public function getDhCancelamento($value)
	{
        if($value == '0000-00-00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
	}

}
