<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApresentacaoTemp
 * 
 * @property int $id_apresentacao_temp
 * @property string $arquivo
 * @property string $folha
 * @property int $linha
 * @property string $erros_txt
 * @property int $divergencia_rg
 * @property int $divergencia_nome
 * @property int $divergencia_opm
 * @property int $erro_dia
 * @property int $erro_horario
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $cdopm
 * @property int $id_notacomparecimento
 * @property int $id_apresentacaoclassificacaosigilo
 * @property int $id_apresentacaosituacao
 * @property string $planilha_rg
 * @property string $planilha_nome
 * @property string $planilha_opm_sigla
 * @property string $planilha_dia_comp
 * @property string $planilha_horario_comp
 * @property string $pessoa_rg
 * @property string $pessoa_posto
 * @property string $pessoa_quadro
 * @property string $pessoa_nome
 * @property string $pessoa_email
 * @property string $pessoa_unidade_lotacao_meta4
 * @property string $pessoa_unidade_lotacao_codigo
 * @property string $pessoa_unidade_lotacao_sigla
 * @property string $pessoa_unidade_lotacao_descricao
 * @property string $pessoa_opm_meta4
 * @property string $pessoa_opm_codigo
 * @property string $pessoa_opm_sigla
 * @property string $pessoa_opm_descricao
 * @property string $documento_de_origem
 * @property \Carbon\Carbon $documento_de_origem_data
 * @property string $documento_de_origem_file
 * @property int $id_apresentacaotipoprocesso
 * @property string $autos_numero
 * @property int $autos_ano
 * @property string $acusados
 * @property int $id_apresentacaocondicao
 * @property \Carbon\Carbon $comparecimento_data
 * @property \Carbon\Carbon $comparecimento_hora
 * @property \Carbon\Carbon $comparecimento_dh
 * @property string $comparecimento_local_txt
 * @property string $observacao_txt
 * @property string $usuario_rg
 * @property \Carbon\Carbon $criacao_dh
 *
 * @package App\Models
 */
class ApresentacaoTemp extends Eloquent
{
	protected $table = 'apresentacao_temp';
	protected $primaryKey = 'id_apresentacao_temp';
	public $timestamps = false;

	protected $casts = [
		'linha' => 'int',
		'divergencia_rg' => 'int',
		'divergencia_nome' => 'int',
		'divergencia_opm' => 'int',
		'erro_dia' => 'int',
		'erro_horario' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_notacomparecimento' => 'int',
		'id_apresentacaoclassificacaosigilo' => 'int',
		'id_apresentacaosituacao' => 'int',
		'id_apresentacaotipoprocesso' => 'int',
		'autos_ano' => 'int',
		'id_apresentacaocondicao' => 'int'
	];

	protected $dates = [
		'documento_de_origem_data',
		'comparecimento_data',
		'comparecimento_hora',
		'comparecimento_dh',
		'criacao_dh'
	];

	protected $fillable = [
		'arquivo',
		'folha',
		'linha',
		'erros_txt',
		'divergencia_rg',
		'divergencia_nome',
		'divergencia_opm',
		'erro_dia',
		'erro_horario',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'id_notacomparecimento',
		'id_apresentacaoclassificacaosigilo',
		'id_apresentacaosituacao',
		'planilha_rg',
		'planilha_nome',
		'planilha_opm_sigla',
		'planilha_dia_comp',
		'planilha_horario_comp',
		'pessoa_rg',
		'pessoa_posto',
		'pessoa_quadro',
		'pessoa_nome',
		'pessoa_email',
		'pessoa_unidade_lotacao_meta4',
		'pessoa_unidade_lotacao_codigo',
		'pessoa_unidade_lotacao_sigla',
		'pessoa_unidade_lotacao_descricao',
		'pessoa_opm_meta4',
		'pessoa_opm_codigo',
		'pessoa_opm_sigla',
		'pessoa_opm_descricao',
		'documento_de_origem',
		'documento_de_origem_data',
		'documento_de_origem_file',
		'id_apresentacaotipoprocesso',
		'autos_numero',
		'autos_ano',
		'acusados',
		'id_apresentacaocondicao',
		'comparecimento_data',
		'comparecimento_hora',
		'comparecimento_dh',
		'comparecimento_local_txt',
		'observacao_txt',
		'usuario_rg',
		'criacao_dh'
	];
}
