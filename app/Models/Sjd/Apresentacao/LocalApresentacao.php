<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Localdeapresentacao
 * 
 * @property int $id_localdeapresentacao
 * @property string $localdeapresentacao
 * @property int $id_municipio
 * @property string $bairro
 * @property string $uf
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property string $cep
 * @property string $telefone
 * @property int $id_genero
 *
 * @package App\Models
 */
class LocalApresentacao extends Eloquent
{
    use SoftDeletes;
	//Activitylog
	use LogsActivity;

    protected static $logName = 'localdeapresentacao';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

	protected $table = 'localdeapresentacao';
	protected $primaryKey = 'id_localdeapresentacao';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int',
		'id_genero' => 'int'
	];

	protected $fillable = [
		'localdeapresentacao',
		'id_municipio',
		'bairro',
		'uf',
		'logradouro',
		'numero',
		'complemento',
		'cep',
		'telefone',
		'id_genero'
	];
}
