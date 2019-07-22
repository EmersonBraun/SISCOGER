<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class FuncoesPrivativas extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'FUNCOES_PRIVATIVAS';
	protected $primaryKey = 'CBR_ID_FUNC';
	public $timestamps = false;

	protected $fillable = [
		'CBR_ID_FUNC_PRIV',
        'DT_START',
        'DT_END',
        'CBR_ID_FUNC',
        'STD_ID_JOB_CODE',
        'CBR_ID_CLASS_ORDER',
        'CBR_ID_CLASS',
        'STD_ID_WORK_UNIT',
        'CBR_ID_FORM_ACT',
        'CBR_Q_VACANCY',
        'CBR_COMMENT', 
	];
}