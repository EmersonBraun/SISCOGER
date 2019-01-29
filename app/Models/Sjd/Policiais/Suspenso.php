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
 * Class Suspenso
 * 
 * @property int $id_suspenso
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $processo
 * @property string $infracao
 * @property string $numerounico
 * @property \Carbon\Carbon $inicio_data
 * @property \Carbon\Carbon $fim_data
 * @property string $obs_txt
 *
 * @package App\Models
 */
class Suspenso extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'suspenso';
    protected static $logAttributes = [
		'rg',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'numerounico',
		'inicio_data',
		'fim_data',
		'obs_txt'
	];
	
	protected $table = 'suspenso';
	protected $primaryKey = 'id_suspenso';
	public $timestamps = false;

	protected $dates = [
		'inicio_data',
		'fim_data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'numerounico',
		'inicio_data',
		'fim_data',
		'obs_txt'
	];
}
