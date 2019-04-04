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
 * Class Ofendido
 * 
 * @property int $id_ofendido
 * @property string $nome
 * @property string $rg
 * @property string $situacao
 * @property string $resultado
 * @property string $sexo
 * @property string $idade
 * @property string $escolaridade
 * @property int $id_ipm
 * @property int $id_cj
 * @property int $id_cd
 * @property int $id_adl
 * @property int $id_sindicancia
 * @property int $id_fatd
 * @property int $id_desercao
 * @property int $id_apfd
 * @property int $id_iso
 * @property int $id_it
 * @property int $id_pad
 * @property int $id_sai
 * @property int $id_proc_outros
 * @property string $fone
 * @property string $email
 *
 * @package App\Models
 */
class Ofendido extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'ofendido';
    protected static $logAttributes = [
		'nome',
		'rg',
		'situacao',
		'resultado',
		'sexo',
		'idade',
		'escolaridade',
		'id_ipm',
		'id_cj',
		'id_cd',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_apfd',
		'id_iso',
		'id_it',
		'id_pad',
		'id_sai',
		'id_proc_outros',
		'fone',
		'email'
	];
	
	protected $table = 'ofendido';
	protected $primaryKey = 'id_ofendido';
	public $timestamps = false;

	protected $casts = [
		'id_ipm' => 'int',
		'id_cj' => 'int',
		'id_cd' => 'int',
		'id_adl' => 'int',
		'id_sindicancia' => 'int',
		'id_fatd' => 'int',
		'id_desercao' => 'int',
		'id_apfd' => 'int',
		'id_iso' => 'int',
		'id_it' => 'int',
		'id_pad' => 'int',
		'id_sai' => 'int',
		'id_proc_outros' => 'int'
	];

	protected $fillable = [
		'nome',
		'rg',
		'situacao',
		'resultado',
		'sexo',
		'idade',
		'escolaridade',
		'id_ipm',
		'id_cj',
		'id_cd',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_apfd',
		'id_iso',
		'id_it',
		'id_pad',
		'id_sai',
		'id_proc_outros',
		'fone',
		'email'
	];

	public function scopeOfendido($query, $id_proc, $id)
	{
		return $query->where('situacao','=','Ofendido')
				 ->where($id_proc,'=',$id);
	}
}
