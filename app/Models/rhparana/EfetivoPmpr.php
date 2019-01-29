<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EfetivoPmpr
 * 
 * @property string $STD_ID_HR
 * @property int $STD_OR_HR_PERIOD
 * @property \Carbon\Carbon $STD_DT_START
 * @property string $STD_N_FIRST_NAME
 * @property string $CBR_NUM_RG
 * @property string $CBR_ID_FUNC_GRUOP
 * @property string $SUS_ID_WORK_CENTER
 * @property string $STD_WORK_LOCBRA
 * @property string $STD_ID_SUB_GEO_DIV
 * @property string $STD_N_SUB_GEO_DIV
 * @property string $SCO_ID_WORK_UNIT
 * @property string $STD_N_WORK_UNITBRA
 * @property string $STD_ID_JOB_CODE
 * @property string $CBR_ID_CLASS_ORDER
 * @property string $CBR_ID_CLASS
 * @property string $CBR_ID_REFERENCE
 * @property string $CBR_ID_FUNC
 * @property string $CBR_NM_FUNCBRA
 * @property \Carbon\Carbon $STD_DT_BIRTH
 * @property string $STD_ID_GENDER
 * @property string $STD_N_GENDERBRA
 * @property string $STD_EMAIL
 *
 * @package App\Models
 */
class EfetivoPmpr extends Eloquent
{
	protected $table = 'efetivo_pmpr';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'STD_OR_HR_PERIOD' => 'int'
	];

	protected $dates = [
		'STD_DT_START',
		'STD_DT_BIRTH'
	];

	protected $fillable = [
		'STD_ID_HR',
		'STD_OR_HR_PERIOD',
		'STD_DT_START',
		'STD_N_FIRST_NAME',
		'CBR_NUM_RG',
		'CBR_ID_FUNC_GRUOP',
		'SUS_ID_WORK_CENTER',
		'STD_WORK_LOCBRA',
		'STD_ID_SUB_GEO_DIV',
		'STD_N_SUB_GEO_DIV',
		'SCO_ID_WORK_UNIT',
		'STD_N_WORK_UNITBRA',
		'STD_ID_JOB_CODE',
		'CBR_ID_CLASS_ORDER',
		'CBR_ID_CLASS',
		'CBR_ID_REFERENCE',
		'CBR_ID_FUNC',
		'CBR_NM_FUNCBRA',
		'STD_DT_BIRTH',
		'STD_ID_GENDER',
		'STD_N_GENDERBRA',
		'STD_EMAIL'
	];
}
