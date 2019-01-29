<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Saidiligencia
 * 
 * @property int $id_saidiligencias
 * @property int $sai
 * @property string $rg_cadastro
 * @property \Carbon\Carbon $data
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $diligencias_txt
 * @property string $digitador
 *
 * @package App\Models
 */
class Saidiligencia extends Eloquent
{
	protected $primaryKey = 'id_saidiligencias';
	public $timestamps = false;

	protected $casts = [
		'sai' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'sai',
		'rg_cadastro',
		'data',
		'cdopm',
		'opm_abreviatura',
		'diligencias_txt',
		'digitador'
	];
}
