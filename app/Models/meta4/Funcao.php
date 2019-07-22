<?php

namespace App\Models\meta4;

use Reliese\Database\Eloquent\Model as Eloquent;

class Funcao extends Eloquent
{
    protected $connection = 'meta4';
	protected $table = 'FUNCAO';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD',
        'DT_START_FUNCAO',
        'CBR_ID_FUNC',
        'DATA_REAL',
        'CBR_NM_FUNCBRA',
	];
}