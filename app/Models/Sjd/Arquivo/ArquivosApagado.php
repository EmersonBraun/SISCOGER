<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Sep 2018 13:16:48 +0000.
 */

namespace App\Models\Sjd\Arquivo;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ArquivosApagado
 * 
 * @property int $id_arquivos_apagados
 * @property string $procedimento
 * @property int $id_procedimento
 * @property string $sjd_ref
 * @property string $sjd_ref_ano
 * @property string $rg
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class ArquivosApagado extends Eloquent
{
	protected $primaryKey = 'id_arquivos_apagados';

	protected $casts = [
		'id_procedimento' => 'int'
	];

	protected $fillable = [
		'procedimento',
		'id_procedimento',
		'objeto',
		'rg',
		'nome'
	];

	public function scopeProc_id($query, $proc, $id)
	{
		return $query->where('procedimento','=',$proc)
				->where('id_procedimento','=',$id);
	}
}
