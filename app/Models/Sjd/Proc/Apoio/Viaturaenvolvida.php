<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Viaturaenvolvida
 * 
 * @property int $id_viaturaenvolvida
 * @property int $id_sai
 * @property string $placa
 * @property string $prefixo
 * @property string $situacao
 *
 * @package App\Models
 */
class Viaturaenvolvida extends Eloquent
{
	protected $table = 'viaturaenvolvida';
	protected $primaryKey = 'id_viaturaenvolvida';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_viaturaenvolvida' => 'int',
		'id_sai' => 'int'
	];

	protected $fillable = [
		'id_sai',
		'placa',
		'prefixo',
		'situacao'
	];
}
