<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaonotificacao
 * 
 * @property int $id_apresentacaonotificacao
 * @property string $apresentacaonotificacao
 * @property int $ativo
 * @property int $ordem
 *
 * @package App\Models
 */
class Apresentacaonotificacao extends Eloquent
{
	protected $table = 'apresentacaonotificacao';
	protected $primaryKey = 'id_apresentacaonotificacao';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_apresentacaonotificacao' => 'int',
		'ativo' => 'int',
		'ordem' => 'int'
	];

	protected $fillable = [
		'apresentacaonotificacao',
		'ativo',
		'ordem'
	];
}
