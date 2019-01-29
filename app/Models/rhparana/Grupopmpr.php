<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Grupopmpr
 * 
 * @property int $id_grupoPMPR
 * @property string $cdgrupo
 * @property string $grupoPMPR
 *
 * @package App\Models
 */
class Grupopmpr extends Eloquent
{
	protected $table = 'grupopmpr';
	protected $primaryKey = 'id_grupoPMPR';
	public $timestamps = false;

	protected $fillable = [
		'cdgrupo',
		'grupoPMPR'
	];
}
