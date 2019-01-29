<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Andamento
 * 
 * @property int $id_andamento
 * @property string $andamento
 * @property string $procedimento
 *
 * @package App\Models
 */
class Andamento extends Eloquent
{
	protected $table = 'andamento';
	protected $primaryKey = 'id_andamento';
	public $timestamps = false;

	protected $fillable = [
		'andamento',
		'procedimento'
	];
}
