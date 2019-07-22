<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Efetivo2 extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'efetivo2';
	protected $primaryKey = 'CBR_NUM_RG';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD',
        'STD_DT_START',
        'STD_N_FIRST_NAME',
        'CBR_NUM_RG',
        'CPF',
        'CBR_ID_FUNC_GRUOP',
        'STD_DT_BIRTH',
        'STD_ID_GENDER',
        'STD_N_GENDERBRA',
        'CBR_DT_START_REAL',
        'STD_EMAIL',
        'CBR_NAME_MATHER',
        'CBR_NAME_FATHER',
        'SBR_NUM_TIT',
        'SBR_ZONA',
        'SBR_SECAO',
        'STD_ID_GEO_DIV',
	];
}