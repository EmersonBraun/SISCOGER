<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaosituacao
 * 
 * @property int $id_apresentacaosituacao
 * @property string $apresentacaosituacao
 * @property int $apresentacao_concluida
 * @property int $ativo
 * @property int $ordem
 *
 * @package App\Models
 */
class Apresentacaosituacao extends Eloquent
{
	protected $table = 'apresentacaosituacao';
	protected $primaryKey = 'id_apresentacaosituacao';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_apresentacaosituacao' => 'int',
		'apresentacao_concluida' => 'int',
		'ativo' => 'int',
		'ordem' => 'int'
	];

	protected $fillable = [
		'apresentacaosituacao',
		'apresentacao_concluida',
		'ativo',
		'ordem'
	];
}
