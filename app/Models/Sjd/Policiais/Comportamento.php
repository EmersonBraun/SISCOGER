<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Comportamento
 * 
 * @property int $id_comportamento
 * @property string $comportamento
 *
 * @package App\Models
 */
class Comportamento extends Eloquent
{
	protected $table = 'comportamento';
	protected $primaryKey = 'id_comportamento';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_comportamento' => 'int'
	];

	protected $fillable = [
		'comportamento'
	];
}
