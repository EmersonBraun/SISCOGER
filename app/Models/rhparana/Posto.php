<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Posto
 * 
 * @property string $posto
 * @property int $id_posto
 *
 * @package App\Models
 */
class Posto extends Eloquent
{
	protected $table = 'posto';
	protected $primaryKey = 'posto';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_posto' => 'int'
	];

	protected $fillable = [
		'id_posto'
	];
}
