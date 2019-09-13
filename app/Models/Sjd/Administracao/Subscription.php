<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
// use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Subscription
 * 
 * @property int $id_subscription
 * @property string $nome
 * @property string $email
 * @property string $processo_tipo
 * @property int $processo_id
 * @property bool $ativo
 * @property string $observacao
 *
 * @package App\Models
 */
class Subscription extends Eloquent
{
    //Activitylog
	// use LogsActivity;
    // protected static $logName = 'subscription';
    // protected static $logAttributes = ['*'];
	// protected static $logOnlyDirty = true;
	
	protected $table = 'subscription';
	protected $primaryKey = 'id_subscription';
	public $timestamps = false;

	protected $casts = [
		'processo_id' => 'int',
		'ativo' => 'bool'
	];

	protected $fillable = [
		'nome',
		'email',
		'processo_tipo',
		'processo_id',
		'ativo',
		'observacao'
	];
}
