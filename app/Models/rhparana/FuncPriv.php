<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class FuncPriv extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'FUNC_PRIV';
	protected $primaryKey = 'CBR_ID_FUNC_PRIV';
	public $timestamps = false;

	protected $fillable = [
		'STD_ID_HR',
        'STD_OR_HR_PERIOD_NUMBER',
        'DT_START',
        'DT_END',
        'CBR_ID_FUNC_PRIV',
        'CBR_ID_FORM_ACT',
        'SCO_ID_REA_CHANG', 
	];
}