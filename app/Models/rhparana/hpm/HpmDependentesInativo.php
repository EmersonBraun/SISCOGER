<?php

namespace App\Models\rhparana\hpm;

use Reliese\Database\Eloquent\Model as Eloquent;

class HpmDependentesInativo extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'HPM_DEPENDENTES_INATIVO';
	protected $primaryKey = 'RG';
	public $timestamps = false;

	protected $fillable = [
        'RG',
        'NOME',
        'DATA_NASCIMENTO',
        'SEXO',
        'PARENTESCO',
        'IRPF',
        'DT_INI',
        'DT_FIM', 
	];
}