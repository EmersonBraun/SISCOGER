<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Funcional extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'funcional';
	protected $primaryKey = 'cif';
	public $timestamps = false;

	protected $fillable = [
		'cif',
        'nome',
        'rg',
        'data',
        'sit_pm',
        'motivo',
        'cargo',
        'sit_funcional',
        'rg_alterante',
        'boletim',
        'data_fim',
	];
}