<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class DependentesInativo extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'DEPENDENTES_INATIVO';
	protected $primaryKey = 'rg';
	public $timestamps = false;

	protected $fillable = [
		'rg',
        'nome',
        'sexo',
        'data_nasc',
        'irpf',
        'parentesco',
        'dt_ini',
        'dt_fim', 
	];
}