<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tiponotacomparecimento
 * 
 * @property int $id_tiponotacomparecimento
 * @property string $nomeunico
 * @property string $tiponotacomparecimento
 * @property int $ativo
 *
 * @package App\Models
 */
class Tiponotacomparecimento extends Eloquent
{
	protected $table = 'tiponotacomparecimento';
	protected $primaryKey = 'id_tiponotacomparecimento';
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int'
	];

	protected $fillable = [
		'nomeunico',
		'tiponotacomparecimento',
		'ativo'
	];
}
