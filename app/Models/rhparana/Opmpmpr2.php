<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Opmpmpr
 * 
 * @property string $META4
 * @property string $NOME_META4
 * @property string $CODIGO
 * @property string $DESCRICAO
 * @property string $ABREVIATURA
 * @property string $TIPO
 * @property string $MUNICIPIO
 * @property string $CDMUNICIPIO
 * @property string $TITULO
 * @property string $CODIGOBASE
 * @property string $CODIGONOVO
 * @property string $TELEFONE
 *
 * @package App\Models
 */
class Opmpmpr2 extends Eloquent
{
    protected $connection = 'rhparana2';
	protected $table = 'opmPMPR';
	protected $primaryKey = 'META4';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'NOME_META4',
		'CODIGO',
		'DESCRICAO',
		'ABREVIATURA',
		'TIPO',
		'MUNICIPIO',
		'CDMUNICIPIO',
		'TITULO',
		'CODIGOBASE',
		'CODIGONOVO',
		'TELEFONE'
	];
}
