<?php

namespace App\Models\meta4;

use Reliese\Database\Eloquent\Model as Eloquent;

class Local extends Eloquent
{
    protected $connection = 'meta4';
	protected $table = 'LOCAL';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD',
        'SUS_ID_WORK_CENTER',
        'STD_WORK_LOCBRA',
        'STD_ID_SUB_GEO_DIV',
        'STD_N_SUB_GEO_DIV',
        'SCO_ID_WORK_UNIT',
        'DT_START_REAL',
        'STD_N_WORK_UNITBRA',
	];
}