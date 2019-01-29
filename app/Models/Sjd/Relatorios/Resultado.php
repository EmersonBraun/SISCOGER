<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Relatorios;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Resultado
 * 
 * @property int $id_resultado
 * @property string $resultado
 * @property string $procedimento
 *
 * @package App\Models
 */
class Resultado extends Eloquent
{
	protected $table = 'resultado';
	protected $primaryKey = 'id_resultado';
	public $timestamps = false;

	protected $fillable = [
		'resultado',
		'procedimento'
	];
}
