<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:06:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Parecer
 * 
 * @property int $id_parecer
 * @property string $titulo
 * @property string $texto
 * @property string $html_file
 * @property string $pdf_file
 *
 * @package App\Models
 */
class Parecer extends Eloquent
{
	protected $table = 'parecer';
	protected $primaryKey = 'id_parecer';
	public $timestamps = false;

	protected $fillable = [
		'titulo',
		'texto',
		'html_file',
		'pdf_file'
	];
}
