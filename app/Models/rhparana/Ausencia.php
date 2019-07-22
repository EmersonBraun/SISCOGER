<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

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

    public function setDtInicAttribute($value)
    {
        $this->attributes['dt_inic'] = data_bd($value);
    }

    public function setDtFimAttribute($value)
    {
        $this->attributes['dt_fim'] = data_bd($value);
    }
}
