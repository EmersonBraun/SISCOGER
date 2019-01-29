<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Pj
 * 
 * @property int $id_pj
 * @property int $id_pad
 * @property string $cnpj
 * @property string $razaosocial
 * @property string $contato
 * @property string $telefone
 *
 * @package App\Models
 */
class Pj extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'pj';
    protected static $logAttributes = [
		'id_pad',
		'cnpj',
		'razaosocial',
		'contato',
		'telefone'
	];
	
	protected $table = 'pj';
	protected $primaryKey = 'id_pj';
	public $timestamps = false;

	protected $casts = [
		'id_pad' => 'int'
	];

	protected $fillable = [
		'id_pad',
		'cnpj',
		'razaosocial',
		'contato',
		'telefone'
	];

	public function scopeRef_ano($query, $ref, $ano)
	{
		return $query->where('sjd_ref','=',$ref)
				->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno($query, $ano)
	{
		return $query->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno_unidade($query, $ano, $unidade)
	{
		return $query->where('sjd_ref_ano','=',$ano)
					->where('cdopm', 'like', $unidade.'%');
	}

	public function scopeUltimo_id($query)
	{
		return $query->max('id_pj');
	}
}
