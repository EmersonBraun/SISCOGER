<?php

namespace App\Models\meta4;

use Reliese\Database\Eloquent\Model as Eloquent;

class Ausencia extends Eloquent
{
    protected $connection = 'meta4';
	protected $table = 'AUSENCIA';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'NOME',
        'CODIGO',
        'RG',
        'OPM_META4',
        'OPM_DESCRICAO',
        'COD_INCIDENTE',
        'DESC_INCIDENTE',
        'UNITS',
        'DT_INIC',
        'DT_FIM',
	];
}