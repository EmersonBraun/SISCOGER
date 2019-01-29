<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Objetoprocedimento
 * 
 * @property string $id_objetoprocedimento
 * @property string $objetoprocedimento
 * @property string $procedimento
 *
 * @package App\Models
 */
class Objetoprocedimento extends Eloquent
{
	protected $table = 'objetoprocedimento';
	protected $primaryKey = 'id_objetoprocedimento';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'objetoprocedimento',
		'procedimento'
	];
}
