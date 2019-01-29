<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Relatorios;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pendencia
 * 
 * @property string $cdopm
 * @property int $comportamento
 * @property int $fatd_punicao
 * @property int $fatd_prazo
 * @property int $fatd_abertura
 * @property int $ipm_prazo
 * @property int $ipm_abertura
 * @property int $sindicancia_prazo
 * @property int $sindicancia_abertura
 *
 * @package App\Models
 */
class Pendencia extends Eloquent
{
	protected $primaryKey = 'cdopm';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'comportamento' => 'int',
		'fatd_punicao' => 'int',
		'fatd_prazo' => 'int',
		'fatd_abertura' => 'int',
		'ipm_prazo' => 'int',
		'ipm_abertura' => 'int',
		'sindicancia_prazo' => 'int',
		'sindicancia_abertura' => 'int'
	];

	protected $fillable = [
		'comportamento',
		'fatd_punicao',
		'fatd_prazo',
		'fatd_abertura',
		'ipm_prazo',
		'ipm_abertura',
		'sindicancia_prazo',
		'sindicancia_abertura'
	];
}
