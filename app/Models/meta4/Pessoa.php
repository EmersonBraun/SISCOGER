<?php

namespace App\Models\meta4;

use Reliese\Database\Eloquent\Model as Eloquent;

class Pessoa extends Eloquent
{
    protected $connection = 'meta4';
	protected $table = 'PESSOA';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD',
        'SDT_DT_START',
        'STD_N_FIRST_NAME',
        'CBR_NUM_RG',
        'CBR_ID_FUNC_GRUOP',
        'STD_DT_BIRTH',
        'STD_ID_GENDER',
        'STD_N_GENDERBRA',
        'CBR_DT_START_REAL',
        'STD_EMAIL',
	];
}