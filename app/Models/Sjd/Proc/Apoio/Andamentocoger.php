<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Andamentocoger
 * 
 * @property int $id_andamentocoger
 * @property string $andamentocoger
 * @property string $procedimento
 *
 * @package App\Models
 */
class Andamentocoger extends Eloquent
{
	protected $table = 'andamentocoger';
	protected $primaryKey = 'id_andamentocoger';
	public $timestamps = false;

	protected $fillable = [
		'andamentocoger',
		'procedimento'
	];
}
