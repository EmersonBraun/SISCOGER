<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Notacomparecimento
 * 
 * @property int $id_notacomparecimento
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $expedicao_data
 * @property int $id_tiponotacomparecimento
 * @property string $observacao_txt
 * @property string $autoridade_rg
 * @property string $autoridade_cargo
 * @property string $autoridade_quadro
 * @property string $autoridade_nome
 * @property string $autoridade_funcao
 * @property string $planilha_file
 * @property string $planilha_nome
 * @property string $nota_file
 * @property string $rg
 * @property \Carbon\Carbon $criacao_dh
 * @property string $status
 *
 * @package App\Models
 */
class Notacomparecimento extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'notacomparecimento';
    protected static $logAttributes = [
		'sjd_ref',
		'sjd_ref_ano',
		'expedicao_data',
		'id_tiponotacomparecimento',
		'observacao_txt',
		'autoridade_rg',
		'autoridade_cargo',
		'autoridade_quadro',
		'autoridade_nome',
		'autoridade_funcao',
		'planilha_file',
		'planilha_nome',
		'nota_file',
		'rg',
		'criacao_dh',
		'status'
	];

	protected $table = 'notacomparecimento';
	protected $primaryKey = 'id_notacomparecimento';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_tiponotacomparecimento' => 'int'
	];

	protected $dates = [
		'expedicao_data',
		'criacao_dh'
	];

	protected $fillable = [
		'sjd_ref',
		'sjd_ref_ano',
		'expedicao_data',
		'id_tiponotacomparecimento',
		'observacao_txt',
		'autoridade_rg',
		'autoridade_cargo',
		'autoridade_quadro',
		'autoridade_nome',
		'autoridade_funcao',
		'planilha_file',
		'planilha_nome',
		'nota_file',
		'rg',
		'criacao_dh',
		'status'
	];
}
