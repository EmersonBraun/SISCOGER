<?php

namespace App\Models\rhparana\hpm;

use Reliese\Database\Eloquent\Model as Eloquent;

class HpmAtiva extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'HPM_ATIVA';
	protected $primaryKey = 'RG';
	public $timestamps = false;

	protected $fillable = [
		'RG',
        'CARGO',
        'QUADRO',
        'NOME',
        'DATA_INCLUSAO',
        'DATA_NASCIMENTO',
        'CIDADE',
        'SEXO',
        'LOCAL_TRABALHO',
        'UNIDADE',
	];
}