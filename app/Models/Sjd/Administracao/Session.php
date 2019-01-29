<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Session
 * 
 * @property string $id
 * @property int $user_id
 * @property string $ip_address
 * @property string $user_agent
 * @property string $payload
 * @property int $last_activity
 * @property string $nome
 * @property string $rg
 * @property string $classe
 * @property string $nascimento
 * @property string $sexo
 * @property string $email
 * @property string $cargo
 * @property string $quadro
 * @property string $subquadro
 * @property string $referencia
 * @property string $cidade
 * @property string $opm
 * @property string $cdopm
 *
 * @package App\Models
 */
class Session extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'last_activity' => 'int'
	];

	protected $fillable = [
		'id',
		'user_id',
		'ip_address',
		'user_agent',
		'payload',
		'last_activity',
		'nome',
		'rg',
		'classe',
		'nascimento',
		'sexo',
		'email',
		'cargo',
		'quadro',
		'subquadro',
		'referencia',
		'cidade',
		'opm',
		'cdopm'
	];
}
