<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Presotipo
 * 
 * @property int $id_presotipo
 * @property string $presotipo
 *
 * @package App\Models
 */
class Presotipo extends Eloquent
{
	protected $table = 'presotipo';
	protected $primaryKey = 'id_presotipo';
	public $timestamps = false;

	protected $fillable = [
		'presotipo'
	];
}
