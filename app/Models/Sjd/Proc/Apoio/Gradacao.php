<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Gradacao
 * 
 * @property int $id_gradacao
 * @property string $gradacao
 * @property string $rel
 *
 * @package App\Models
 */
class Gradacao extends Eloquent
{
	protected $table = 'gradacao';
	protected $primaryKey = 'id_gradacao';
	public $timestamps = false;

	protected $fillable = [
		'gradacao',
		'rel'
	];
}
