<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 14:37:11 +0000.
 */

namespace App\Models\Sjd\Policiais;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Protocolo
 * 
 * @property int $id_protocolo
 * @property string $numero
 * @property string $rg
 * @property string $descricao_txt
 * @property string $rg_autor
 * @property string $rg_analista
 * @property string $obs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Protocolo extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'protocolo';
	protected $primaryKey = 'id_protocolo';

	protected $fillable = [
		'numero',
		'rg',
		'descricao_txt',
		'rg_autor',
		'rg_analista',
		'obs'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'protocolo';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
