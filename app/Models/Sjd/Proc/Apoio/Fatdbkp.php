<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Fatdbkp
 * 
 * @property int $id_fatd
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $cdopm
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $doc_origem_txt
 * @property string $despacho_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $fato_file
 * @property string $relatorio_file
 * @property string $sol_cmt_file
 * @property string $sol_cg_file
 * @property string $rec_ato_file
 * @property string $rec_cmt_file
 * @property string $rec_crpm_file
 * @property string $rec_cg_file
 *
 * @package App\Models
 */
class Fatdbkp extends Eloquent
{
	protected $table = 'fatdbkp';
	protected $primaryKey = 'id_fatd';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'portaria_data'
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
		'despacho_numero',
		'portaria_data',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file'
	];
}
