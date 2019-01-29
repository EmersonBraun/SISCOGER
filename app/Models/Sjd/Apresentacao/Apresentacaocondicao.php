<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaocondicao
 * 
 * @property int $id_apresentacaocondicao
 * @property string $apresentacaocondicao
 * @property int $ativo
 * @property int $ordem
 *
 * @package App\Models
 */
class Apresentacaocondicao extends Eloquent
{
	protected $table = 'apresentacaocondicao';
	protected $primaryKey = 'id_apresentacaocondicao';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int',
		'ordem' => 'int'
	];

	protected $fillable = [
		'apresentacaocondicao',
		'ativo',
		'ordem'
	];
}
