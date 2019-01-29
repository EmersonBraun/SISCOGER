<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FatdAndamento
 * 
 * @property int $id_fatd_andamento
 * @property string $fatd_andamento
 *
 * @package App\Models
 */
class FatdAndamento extends Eloquent
{
	protected $table = 'fatd_andamento';
	protected $primaryKey = 'id_fatd_andamento';
	public $timestamps = false;

	protected $fillable = [
		'fatd_andamento'
	];
}
