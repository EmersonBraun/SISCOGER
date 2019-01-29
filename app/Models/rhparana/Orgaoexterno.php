<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Orgaoexterno
 * 
 * @property int $id_orgaoExterno
 * @property string $cdoe
 * @property string $orgaoExterno
 * @property string $nome
 *
 * @package App\Models
 */
class Orgaoexterno extends Eloquent
{
	protected $table = 'orgaoexterno';
	protected $primaryKey = 'id_orgaoExterno';
	public $timestamps = false;

	protected $fillable = [
		'cdoe',
		'orgaoExterno',
		'nome'
	];
}
