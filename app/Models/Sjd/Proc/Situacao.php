<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Situacao
 * 
 * @property int $id_situacao
 * @property string $situacao
 * @property string $situacao_abreviada
 *
 * @package App\Models
 */
class Situacao extends Eloquent
{
	protected $table = 'situacao';
	protected $primaryKey = 'id_situacao';
	public $timestamps = false;

	protected $fillable = [
		'situacao',
		'situacao_abreviada'
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
		return $query->max('id_situacao');
	}
}
