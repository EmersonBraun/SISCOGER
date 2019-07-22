<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Inativos extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'INATIVOS';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_RH_PERIOD',
        'DT_INI_RH',
        'ID_TIPO_RH',
        'N_TIPO_RH',
        'CBR_NUM_RG',
        'NOME',
        'DT_NASC',
        'SEXO',
        'cargo',
        'POSTO',
        'N_RUA',
        'N_TIPO_LOCAL_END',
        'QUADRO',
        'ORD_FONE',
        'N_TIPO_LOCAL_FONE',
        'N_TIPO_LINHA',
        'FONE',
        'END_LOGRADOURO',
        'END_NUMERO',
        'END_COMPL',
        'END_BAIRRO',
        'END_CIDADE',
        'END_CEP',  
	];
}