<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Relatorios;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SobrestamentoBkp
 * 
 * @property int $id_sobrestamento
 * @property string $rg
 * @property \Carbon\Carbon $inicio_data
 * @property string $publicacao_inicio
 * @property \Carbon\Carbon $termino_data
 * @property string $publicacao_termino
 * @property string $motivo
 * @property int $id_cj
 * @property int $id_cd
 * @property int $id_sindicancia
 * @property int $id_fatd
 * @property int $id_iso
 * @property int $id_it
 * @property int $id_adl
 *
 * @package App\Models
 */
class SobrestamentoBkp extends Eloquent
{
	protected $table = 'sobrestamento_bkp';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_sobrestamento' => 'int',
		'id_cj' => 'int',
		'id_cd' => 'int',
		'id_sindicancia' => 'int',
		'id_fatd' => 'int',
		'id_iso' => 'int',
		'id_it' => 'int',
		'id_adl' => 'int'
	];

	protected $dates = [
		'inicio_data',
		'termino_data'
	];

	protected $fillable = [
		'id_sobrestamento',
		'rg',
		'inicio_data',
		'publicacao_inicio',
		'termino_data',
		'publicacao_termino',
		'motivo',
		'id_cj',
		'id_cd',
		'id_sindicancia',
		'id_fatd',
		'id_iso',
		'id_it',
		'id_adl'
	];
}
