<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaoclassificacaosigilo
 * 
 * @property int $id_apresentacaoclassificacaosigilo
 * @property string $apresentacaoclassificacaosigilo
 * @property int $ativo
 * @property int $ordem
 *
 * @package App\Models
 */
class Apresentacaoclassificacaosigilo extends Eloquent
{
	protected $table = 'apresentacaoclassificacaosigilo';
	protected $primaryKey = 'id_apresentacaoclassificacaosigilo';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int',
		'ordem' => 'int'
	];

	protected $fillable = [
		'apresentacaoclassificacaosigilo',
		'ativo',
		'ordem'
	];
}
