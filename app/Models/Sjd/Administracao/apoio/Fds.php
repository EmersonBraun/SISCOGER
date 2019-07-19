<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Feriado
 * 
 * @property int $id_feriado
 * @property \Carbon\Carbon $data
 * @property string $feriado
 *
 * @package App\Models
 */
class Fds extends Eloquent
{
	
	protected $table = 'fds';
	protected $primaryKey = 'id_fds';
	public $timestamps = false;

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'data',
		'descr'
	];
}
