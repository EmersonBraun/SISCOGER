<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Apresentacaomassificado
 * 
 * @property int $id_apresentacaomassificado
 * @property string $cdopm
 * @property string $nome_original_do_arquivo
 * @property \Carbon\Carbon $datahora
 * @property string $nome_do_arquivo
 * @property string $nome_da_folha
 * @property int $qtde_registros
 * @property int $qtde_registros_inconsistentes
 * @property int $situacao
 * @property string $usuario_rg
 * @property int $id_notacomparecimento
 * @property int $id_apresentacaocondicao
 *
 * @package App\Models
 */
class Apresentacaomassificado extends Eloquent
{
	protected $table = 'apresentacaomassificado';
	protected $primaryKey = 'id_apresentacaomassificado';
	public $timestamps = false;

	protected $casts = [
		'qtde_registros' => 'int',
		'qtde_registros_inconsistentes' => 'int',
		'situacao' => 'int',
		'id_notacomparecimento' => 'int',
		'id_apresentacaocondicao' => 'int'
	];

	protected $dates = [
		'datahora'
	];

	protected $fillable = [
		'cdopm',
		'nome_original_do_arquivo',
		'datahora',
		'nome_do_arquivo',
		'nome_da_folha',
		'qtde_registros',
		'qtde_registros_inconsistentes',
		'situacao',
		'usuario_rg',
		'id_notacomparecimento',
		'id_apresentacaocondicao'
	];
}
