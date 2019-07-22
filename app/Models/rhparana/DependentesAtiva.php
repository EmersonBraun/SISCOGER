<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class DependentesAtiva extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'DEPENDENTES_ATIVA';
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