<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
 */

namespace App\Models\Sjd\Apresentacao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
/**
 * Class Apresentacao
 * 
 * @property int $id_apresentacao
 * @property string $chave_de_acesso
 * @property int $id_notacomparecimento
 * @property int $id_apresentacaoclassificacaosigilo
 * @property int $id_apresentacaosituacao
 * @property int $id_apresentacaonotificacao
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
 * @property int $id_localdeapresentacao
 * @property string $observacao_txt
 * @property string $usuario_rg
 * @property \Carbon\Carbon $criacao_dh
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $cdopm
 * @property string $memorando_pdf
 *
 * @package App\Models
 */
class Apresentacao extends Eloquent
{
    use SoftDeletes;
	//Activitylog
	use LogsActivity;

    protected static $logName = 'apresentacao';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

	protected $table = 'apresentacao';
	protected $primaryKey = 'id_apresentacao';

	protected $casts = [
		'id_notacomparecimento' => 'int',
		'id_apresentacaoclassificacaosigilo' => 'int',
		'id_apresentacaosituacao' => 'int',
		'id_apresentacaonotificacao' => 'int',
		'id_apresentacaotipoprocesso' => 'int',
		'autos_ano' => 'int',
		'id_apresentacaocondicao' => 'int',
		'id_localdeapresentacao' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	// protected $dates = [
	// 	'documento_de_origem_data',
	// 	'comparecimento_data',
	// 	'comparecimento_dh',
	// 	'criacao_dh'
	// ];

	protected $fillable = [
		'chave_de_acesso',
		'id_notacomparecimento',
		'id_apresentacaoclassificacaosigilo',
		'id_apresentacaosituacao',
		'id_apresentacaonotificacao',
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
		'id_localdeapresentacao',
		'observacao_txt',
		'usuario_rg',
		'criacao_dh',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'memorando_pdf'
    ];
       
    use PresentableTrait;
    protected $presenter = 'App\Presenters\apresentacao\ApresentacaoPresenter';

    //mutators (para alterar na hora da exibição)
	public function getDocumentoDeOrigemDataAttribute($value)
	{
        return data_br($value);
	}

	public function setDocumentoDeOrigemDataAttribute($value)
	{
        $data_bd = date( 'Y-m-d' , strtotime($value));
		$this->attributes['documento_de_origem_data'] = $data_bd;
    }
    
    public function getComparecimentoDataAttribute($value)
	{
        return data_br($value);
	}

	public function setComparecimentoDataAttribute($value)
	{
		$this->attributes['comparecimento_data'] = data_bd($value);
    }
    
    public function getComparecimentoDhAttribute($value)
	{
        if($value == '0000-00-00 00:00:00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
	}

	public function setComparecimentoDhAttribute($value)
	{
        $data_bd = date( 'Y-m-d H:i:s' , strtotime($value));
		$this->attributes['comparecimento_dh'] = $data_bd;
    }
    
    public function getCriacaoDhAttribute($value)
	{
        if($value == '0000-00-00 00:00:00' || !$value) return '';
        return date( 'd/m/Y H:i:s' , strtotime($value));
	}

	public function setCriacaoDhAttribute($value)
	{
        $data_bd = date( 'Y-m-d H:i:s' , strtotime($value));
		$this->attributes['criacao_dh'] = $data_bd;
	}
}
