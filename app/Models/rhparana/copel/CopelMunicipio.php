<?php

namespace App\Models\rhparana\copel;

use Reliese\Database\Eloquent\Model as Eloquent;

class CopelLogradouro extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'COPEL_LOGRADOURO';
	protected $primaryKey = 'CDMUNICIPIO';
	public $timestamps = false;

	protected $fillable = [
		'UF',
        'CDMUNICIPIO',
        'NOME',
        'NOMEMETA4',
        'LAT',
        'LNG',
        'POPULACAO', 
	];
}