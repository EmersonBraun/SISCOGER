<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
 */

namespace App\Models\Sjd\Policiais;

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
}
