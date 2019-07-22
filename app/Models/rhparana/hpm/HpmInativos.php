<?php

namespace App\Models\rhparana\hpm;

use Reliese\Database\Eloquent\Model as Eloquent;

class HpmInativos extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'HPM_INATIVOS';
	protected $primaryKey = 'RG';
	public $timestamps = false;

	protected $fillable = [
		'RG',
        'NOME',
        'DATA_NASCIMENTO',
        'CIDADE',
        'SEXO',
        'BAIRRO',
	];
}