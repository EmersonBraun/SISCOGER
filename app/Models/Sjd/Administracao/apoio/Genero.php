<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Genero
 * 
 * @property int $id_genero
 * @property string $genero
 *
 * @package App\Models
 */
class Genero extends Eloquent
{
	protected $table = 'genero';
	protected $primaryKey = 'id_genero';
	public $timestamps = false;

	protected $fillable = [
		'genero'
	];
}
