<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 28 Aug 2019 11:18:41 +0000.
 */

namespace App\Models\Sjd\Link;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LinkUtei
 * 
 * @property int $id_link_uteis
 * @property string $link
 * @property string $nome
 * @property string $related
 *
 * @package App\Models
 */
class LinkUtil extends Eloquent
{
    protected $table = 'link_uteis';
	protected $primaryKey = 'id_link_uteis';
	public $timestamps = false;

	protected $fillable = [
		'link',
		'nome',
		'related'
	];
}
