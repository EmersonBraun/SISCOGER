<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Municipio
 * 
 * @property string $UF
 * @property int $id_municipio
 * @property string $municipio
 *
 * @package App\Models
 */
class Municipio extends Eloquent
{
	protected $table = 'municipio';
	protected $primaryKey = 'id_municipio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int'
	];

	protected $fillable = [
		'UF',
		'municipio'
	];
}
