<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProcedimentosTipo
 * 
 * @property string $sigla
 * @property string $nome
 *
 * @package App\Models
 */
class ProcedimentosTipo extends Eloquent
{
	protected $primaryKey = 'sigla';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nome'
	];
}
