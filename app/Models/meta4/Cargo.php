<?php

namespace App\Models\meta4;

use Reliese\Database\Eloquent\Model as Eloquent;

class Cargo extends Eloquent
{
    protected $connection = 'meta4';
	protected $table = 'CARGO';
	protected $primaryKey = 'STD_ID_HR';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD',
        'DT_START',
        'STD_ID_JOB_CODE',
        'CBR_ID_CLASS_ORDER',
        'CBR_ID_CLASS',
        'CBR_DT_START_REAL',
        'CBR_ID_REFERENCE',
	];
}