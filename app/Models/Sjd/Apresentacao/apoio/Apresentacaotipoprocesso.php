<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaotipoprocesso
 * 
 * @property int $id_apresentacaotipoprocesso
 * @property string $apresentacaotipoprocesso
 * @property string $procedimentointerno
 * @property int $ativo
 * @property int $ordem
 *
 * @package App\Models
 */
class Apresentacaotipoprocesso extends Eloquent
{
	protected $table = 'apresentacaotipoprocesso';
	protected $primaryKey = 'id_apresentacaotipoprocesso';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int',
		'ordem' => 'int'
	];

	protected $fillable = [
		'apresentacaotipoprocesso',
		'procedimentointerno',
		'ativo',
		'ordem'
	];
}
