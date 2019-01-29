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
 * Class Denunciacivil
 * 
 * @property int $id_denunciacivil
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cargo
 * @property string $nome
 * @property string $processo
 * @property string $infracao
 * @property string $processocrime
 * @property string $julgamento
 * @property string $tipodapena
 * @property int $pena_anos
 * @property int $pena_meses
 * @property int $pena_dias
 * @property string $transitojulgado_bl
 * @property string $restritiva_bl
 * @property string $obs_txt
 *
 * @package App\Models
 */
class Denunciacivil extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'denunciacivil';
    protected static $logAttributes = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'processocrime',
		'julgamento',
		'tipodapena',
		'pena_anos',
		'pena_meses',
		'pena_dias',
		'transitojulgado_bl',
		'restritiva_bl',
		'obs_txt'
	];

	protected $table = 'denunciacivil';
	protected $primaryKey = 'id_denunciacivil';
	public $timestamps = false;

	protected $casts = [
		'pena_anos' => 'int',
		'pena_meses' => 'int',
		'pena_dias' => 'int'
	];

	protected $fillable = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'processocrime',
		'julgamento',
		'tipodapena',
		'pena_anos',
		'pena_meses',
		'pena_dias',
		'transitojulgado_bl',
		'restritiva_bl',
		'obs_txt'
	];
}
