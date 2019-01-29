<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Situacaoconselho
 * 
 * @property int $id_situacaoconselho
 * @property string $situacaoconselho
 *
 * @package App\Models
 */
class Situacaoconselho extends Eloquent
{
	protected $table = 'situacaoconselho';
	protected $primaryKey = 'id_situacaoconselho';
	public $timestamps = false;

	protected $fillable = [
		'situacaoconselho'
	];
}
