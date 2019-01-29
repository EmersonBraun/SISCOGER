<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:06:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pdf
 * 
 * @property string $html_file
 * @property string $pdf_file
 *
 * @package App\Models
 */
class Pdf extends Eloquent
{
	protected $table = 'pdf';
	protected $primaryKey = 'html_file';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'pdf_file'
	];
}
