<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Decorrenciaconselho
 * 
 * @property int $id_decorrenciaconselho
 * @property string $decorrenciaconselho
 *
 * @package App\Models
 */
class Decorrenciaconselho extends Eloquent
{
	protected $table = 'decorrenciaconselho';
	protected $primaryKey = 'id_decorrenciaconselho';
	public $timestamps = false;

	protected $fillable = [
		'decorrenciaconselho'
	];
}
