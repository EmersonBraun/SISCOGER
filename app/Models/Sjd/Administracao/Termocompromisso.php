<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
/**
 * Class Termocompromisso
 * 
 * @property string $rg
 * @property string $ip
 * @property \Carbon\Carbon $datahora
 * @property string $concorda_bl
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $UserExpresso
 * @property string $celular
 * @property string $opm
 *
 * @package App\Models
 */
class Termocompromisso extends Eloquent
{
	
	protected $table = 'termocompromisso';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'datahora'
	];

	protected $fillable = [
		'ip',
		'datahora',
		'nome',
		'email',
		'telefone',
		'UserExpresso',
		'celular',
		'opm'
	];
}
