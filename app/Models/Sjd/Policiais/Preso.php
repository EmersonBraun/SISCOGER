<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Preso
 * 
 * @property int $id_preso
 * @property string $rg
 * @property string $nome
 * @property string $cargo
 * @property string $cdopm_quandopreso
 * @property string $cdopm_prisao
 * @property string $localreclusao
 * @property string $local
 * @property string $processo
 * @property string $natureza
 * @property string $complemento
 * @property string $numeromandado
 * @property int $id_presotipo
 * @property string $origem_proc
 * @property int $origem_sjd_ref
 * @property int $origem_sjd_ref_ano
 * @property string $origem_opm
 * @property \Carbon\Carbon $inicio_data
 * @property \Carbon\Carbon $fim_data
 * @property string $vara
 * @property string $comarca
 * @property string $obs_txt
 *
 * @package App\Models
 */
class Preso extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'preso';
    protected static $logAttributes = [
		'rg',
		'nome',
		'cargo',
		'cdopm_quandopreso',
		'cdopm_prisao',
		'localreclusao',
		'local',
		'processo',
		'natureza',
		'complemento',
		'numeromandado',
		'id_presotipo',
		'origem_proc',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_opm',
		'inicio_data',
		'fim_data',
		'vara',
		'comarca',
		'obs_txt'
	];

	protected $table = 'preso';
	protected $primaryKey = 'id_preso';
	public $timestamps = false;

	protected $casts = [
		'id_presotipo' => 'int',
		'origem_sjd_ref' => 'int',
		'origem_sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'inicio_data',
		'fim_data'
	];

	protected $fillable = [
		'rg',
		'nome',
		'cargo',
		'cdopm_quandopreso',
		'cdopm_prisao',
		'localreclusao',
		'local',
		'processo',
		'natureza',
		'complemento',
		'numeromandado',
		'id_presotipo',
		'origem_proc',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_opm',
		'inicio_data',
		'fim_data',
		'vara',
		'comarca',
		'obs_txt'
	];
}
