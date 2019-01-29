<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Comportamentopm
 * 
 * @property int $id_comportamentopm
 * @property \Carbon\Carbon $data
 * @property string $motivo_txt
 * @property string $publicacao
 * @property int $id_comportamento
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cdopm
 * @property string $opm_abreviatura
 *
 * @package App\Models
 */
class Comportamentopm extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'comportamentopm';
    protected static $logAttributes = [
		'data',
		'motivo_txt',
		'publicacao',
		'id_comportamento',
		'rg',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura'
	];

	protected $table = 'comportamentopm';
	protected $primaryKey = 'id_comportamentopm';
	public $timestamps = false;

	protected $casts = [
		'id_comportamento' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'data',
		'motivo_txt',
		'publicacao',
		'id_comportamento',
		'rg',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura'
	];
}
