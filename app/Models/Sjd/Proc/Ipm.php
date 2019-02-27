<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
/**
 * Class Ipm
 * 
 * @property int $id_ipm
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $id_municipio
 * @property int $id_situacao
 * @property string $cdopm
 * @property string $opm_sigla
 * @property int $opm_ref
 * @property int $opm_ref_ano
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $abertura_data
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $autuacao_data
 * @property string $crime
 * @property string $tentado
 * @property string $crime_especificar
 * @property string $sintese_txt
 * @property string $relato_enc
 * @property \Carbon\Carbon $relato_enc_data
 * @property string $relato_cmtopm
 * @property \Carbon\Carbon $relato_cmtopm_data
 * @property string $relato_cmtgeral
 * @property \Carbon\Carbon $relato_cmtgeral_data
 * @property string $vajme_ref
 * @property string $justicacomum_ref
 * @property string $vitima
 * @property string $confronto_armado_bl
 * @property int $vitima_qtdd
 * @property string $julgamento
 * @property string $portaria_numero
 * @property string $exclusao_txt
 * @property string $relato_enc_file
 * @property string $relato_cmtopm_file
 * @property string $relato_cmtgeral_file
 * @property string $defensor_oab
 * @property string $defensor_nome
 * @property string $relcomplementar_file
 * @property \Carbon\Carbon $relcomplementar_data
 * @property string $opm_meta4
 * @property int $bou_ano
 * @property int $bou_numero
 * @property int $prioridade
 *
 * @package App\Models
 */
class Ipm extends Eloquent
{
	protected $table = 'ipm';
	protected $primaryKey = 'id_ipm';
	public $timestamps = false;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'id_municipio' => 'int',
		'id_situacao' => 'int',
		'opm_ref' => 'int',
		'opm_ref_ano' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'vitima_qtdd' => 'int',
		'bou_ano' => 'int',
		'bou_numero' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'abertura_data',
		'fato_data',
		'autuacao_data',
		'relato_enc_data',
		'relato_cmtopm_data',
		'relato_cmtgeral_data',
		'relcomplementar_data'
    ];
    
    public static $files = [
        'relato_enc_file',
		'relato_cmtopm_file',
		'relato_cmtgeral_file',
		'relcomplementar_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'id_municipio',
		'id_situacao',
		'cdopm',
		'opm_sigla',
		'opm_ref',
		'opm_ref_ano',
		'sjd_ref',
		'sjd_ref_ano',
		'abertura_data',
		'fato_data',
		'autuacao_data',
		'crime',
		'tentado',
		'crime_especificar',
		'sintese_txt',
		'relato_enc',
		'relato_enc_data',
		'relato_cmtopm',
		'relato_cmtopm_data',
		'relato_cmtgeral',
		'relato_cmtgeral_data',
		'vajme_ref',
		'justicacomum_ref',
		'vitima',
		'confronto_armado_bl',
		'vitima_qtdd',
		'julgamento',
		'portaria_numero',
		'exclusao_txt',
		'relato_enc_file',
		'relato_cmtopm_file',
		'relato_cmtgeral_file',
		'relcomplementar_file',
		'defensor_oab',
		'defensor_nome',
		'relcomplementar_data',
		'opm_meta4',
		'bou_ano',
		'bou_numero',
		'prioridade'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'ipm';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'id_municipio',
		'id_situacao',
		'cdopm',
		'opm_sigla',
		'opm_ref',
		'opm_ref_ano',
		'sjd_ref',
		'sjd_ref_ano',
		'abertura_data',
		'fato_data',
		'autuacao_data',
		'crime',
		'tentado',
		'crime_especificar',
		'sintese_txt',
		'relato_enc',
		'relato_enc_data',
		'relato_cmtopm',
		'relato_cmtopm_data',
		'relato_cmtgeral',
		'relato_cmtgeral_data',
		'vajme_ref',
		'justicacomum_ref',
		'vitima',
		'confronto_armado_bl',
		'vitima_qtdd',
		'julgamento',
		'portaria_numero',
		'exclusao_txt',
		'relato_enc_file',
		'relato_cmtopm_file',
		'relato_cmtgeral_file',
		'defensor_oab',
		'defensor_nome',
		'relcomplementar_file',
		'relcomplementar_data',
		'opm_meta4',
		'bou_ano',
		'bou_numero',
		'prioridade'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\IpmPresenter';

	public function scopeRef_ano($query, $ref, $ano)
	{
		return $query->where('sjd_ref','=',$ref)
				->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno($query, $ano)
	{
		return $query->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno_unidade($query, $ano, $unidade)
	{
		return $query->where('sjd_ref_ano','=',$ano)
					->where('cdopm', 'like', $unidade.'%');
	}

	public function scopeUltimo_id($query)
	{
		return $query->max('id_ipm');
    }
    
   
    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getFatoDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setFatoDataAttribute($value)
    {
        $this->attributes['fato_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAutuacaoDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setAutuacaoDataAttribute($value)
    {
        $this->attributes['autuacao_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatoEncDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelatoEncDataAttribute($value)
    {
        $this->attributes['relato_enc_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatoCmtopmDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelatoCmtopmDataAttribute($value)
    {
        $this->attributes['relato_cmt_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatoCmtopmDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelatoCmtopmDataAttribute($value)
    {
        $this->attributes['relato_cmtopm_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatoCmtgeralDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelatoCmtgeralDataAttribute($value)
    {
        $this->attributes['relato_cmtgeral_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelcomplementarDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelcomplementarDataAttribute($value)
    {
        $this->attributes['relcomplementar_data'] = data_bd($value);
    }

}
