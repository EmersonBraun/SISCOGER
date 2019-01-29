<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

'0' => 'NOME',
            '1' => 'CODIGO',
            '2' => 'RG',
            '3' => 'OPM_META4',
            '4' => 'OPM_DESCRICAO',
            '5' => 'COD_INCIDENTE',
            '6' => 'DESC_INCIDENTE',
            '7' => 'UNITS',
            '8' => 'DT_INIC',
            '9' => 'DT_FIM',
/**
 * Class Ausencia
 * 
 * @property int $codigo
 * @property string $rg
 * @property string $opm_meta4
 * @property string $opm_descricao
 * @property string cod_incidente
 * @property string $desc_incidente
 * @property string $units
 * @property \Carbon\Carbon $dt_inic
 * @property \Carbon\Carbon $dt_fim
 *
 * @package App\Models
 */
class Ausencia extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'ausencia';
	protected $primaryKey = 'codigo';
	public $timestamps = false;


	protected $dates = [
		'dt_inic',
		'dt_fim'
	];

	protected $fillable = [
		'codigo',
		'rg',
		'opm_meta4',
		'opm_descricao',
		'cod_incidente',
		'units',
		'dt_inic',
		'dt_fim'
	];

}
