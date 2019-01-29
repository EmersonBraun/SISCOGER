<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 28 Sep 2018 11:57:15 +0000.
 */

namespace App\Models\Sjd\Historia;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Historium
 * 
 * @property int $id_historia
 * @property \Carbon\Carbon $data
 * @property string $titulo
 * @property string $conteudo
 * @property string $rodape
 * @property string $rg
 * @property string $nome
 *
 * @package App\Models
 */
class Historia extends Eloquent
{
	protected $primaryKey = 'id_historia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_historia' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'data',
		'ano',
		'titulo',
		'conteudo',
		'rodape',
		'rg',
		'nome'
	];
}
