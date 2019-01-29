<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sindicanciateste
 * 
 * @property int $id_sindicancia
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $cdopm
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $doc_origem_txt
 * @property string $portaria_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $sol_cmt_file
 * @property \Carbon\Carbon $sol_cmt_data
 * @property string $sol_cmtgeral_file
 * @property \Carbon\Carbon $sol_cmtgeral_data
 * @property string $opm_meta4
 *
 * @package App\Models
 */
class Sindicanciateste extends Eloquent
{
	protected $table = 'sindicanciateste';
	protected $primaryKey = 'id_sindicancia';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'portaria_data',
		'sol_cmt_data',
		'sol_cmtgeral_data'
	];

	protected $fillable = [
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'portaria_numero',
		'portaria_data',
		'sol_cmt_file',
		'sol_cmt_data',
		'sol_cmtgeral_file',
		'sol_cmtgeral_data',
		'opm_meta4'
	];
}
