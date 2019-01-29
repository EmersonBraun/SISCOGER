<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
/**
 * Class Cadastroopmcogerautoridade
 * 
 * @property int $id_cadastroopmcogerautoridade
 * @property int $id_cadastroopmcoger
 * @property string $rg
 * @property string $funcao
 * @property int $ativado
 * @property \Carbon\Carbon $dh
 * @property string $usuario_rg
 *
 * @package App\Models
 */
class Cadastroopmcogerautoridade extends Eloquent
{

	protected $table = 'cadastroopmcogerautoridade';
	protected $primaryKey = 'id_cadastroopmcogerautoridade';
	public $timestamps = false;

	protected $casts = [
		'id_cadastroopmcoger' => 'int',
		'ativado' => 'int'
	];

	protected $dates = [
		'dh'
	];

	protected $fillable = [
		'id_cadastroopmcoger',
		'rg',
		'funcao',
		'ativado',
		'dh',
		'usuario_rg'
	];
}
