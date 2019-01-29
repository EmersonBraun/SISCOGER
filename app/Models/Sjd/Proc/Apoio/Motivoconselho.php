<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Motivoconselho
 * 
 * @property int $id_motivoconselho
 * @property string $motivoconselho
 *
 * @package App\Models
 */
class Motivoconselho extends Eloquent
{
	protected $table = 'motivoconselho';
	protected $primaryKey = 'id_motivoconselho';
	public $timestamps = false;

	protected $fillable = [
		'motivoconselho'
	];
}
