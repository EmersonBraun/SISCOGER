<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Classpunicao
 * 
 * @property int $id_classpunicao
 * @property string $classpunicao
 *
 * @package App\Models
 */
class Classpunicao extends Eloquent
{
	protected $table = 'classpunicao';
	protected $primaryKey = 'id_classpunicao';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_classpunicao' => 'int'
	];

	protected $fillable = [
		'classpunicao'
	];
}
