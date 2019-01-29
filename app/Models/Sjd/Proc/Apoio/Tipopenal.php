<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tipopenal
 * 
 * @property int $TPCod
 * @property int $TICod
 * @property int $TPInciso
 * @property int $LGCod
 * @property string $TPNomeJuridico
 * @property string $TPDispLegal
 * @property string $TPRitoEspecial
 * @property string $TPPermiteTCip
 * @property string $TPStatus
 * @property string $TIPolicia
 * @property int $cdurgencia
 * @property string $imprensa
 * @property string $msrepl_tran_version
 * @property string $ativo
 * @property string $TPConceito
 *
 * @package App\Models
 */
class Tipopenal extends Eloquent
{
	protected $table = 'tipopenal';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'TPCod' => 'int',
		'TICod' => 'int',
		'TPInciso' => 'int',
		'LGCod' => 'int',
		'cdurgencia' => 'int'
	];

	protected $fillable = [
		'LGCod',
		'TPNomeJuridico',
		'TPDispLegal',
		'TPRitoEspecial',
		'TPPermiteTCip',
		'TPStatus',
		'TIPolicia',
		'cdurgencia',
		'imprensa',
		'msrepl_tran_version',
		'ativo',
		'TPConceito'
	];
}
