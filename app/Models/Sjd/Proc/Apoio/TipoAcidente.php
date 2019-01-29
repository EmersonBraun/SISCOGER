<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TipoAcidente
 * 
 * @property string $id_tipo_acidente
 * @property string $tipo_acidente
 * @property string $procedimento
 *
 * @package App\Models
 */
class TipoAcidente extends Eloquent
{
	protected $table = 'tipo_acidente';
	protected $primaryKey = 'id_tipo_acidente';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'tipo_acidente',
		'procedimento'
	];
}
