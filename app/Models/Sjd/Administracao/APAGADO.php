<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Apagado
 * 
 * @property int $id_APAGADO
 * @property string $objeto
 * @property string $rg
 * @property string $nome
 * @property string $unidade
 * @property string $ip
 * @property \Carbon\Carbon $datahora
 * @property string $objetoapagado
 *
 * @package App\Models
 */
class Apagado extends Eloquent
{
	use LogsActivity;

    protected static $logName = 'apagado';
    protected static $logAttributes = [
		'objeto',
		'rg',
		'nome',
		'unidade',
		'ip',
		'datahora',
		'objetoapagado'
	];

	protected $table = 'apagado';
	protected $primaryKey = 'id_APAGADO';
	public $timestamps = false;

	protected $dates = [
		'datahora'
	];

	protected $fillable = [
		'objeto',
		'rg',
		'nome',
		'unidade',
		'ip',
		'datahora',
		'objetoapagado'
	];
}
