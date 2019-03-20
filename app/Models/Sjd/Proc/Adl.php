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
 * Class Adl
 * 
 * @property int $id_adl
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $id_motivoconselho
 * @property int $id_decorrenciaconselho
 * @property int $id_situacaoconselho
 * @property string $outromotivo
 * @property string $cdopm
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $libelo_file
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $portaria_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $parecer_file
 * @property string $decisao_file
 * @property string $doc_prorrogacao
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $prescricao_data
 * @property string $parecer_comissao
 * @property string $parecer_cmtgeral
 * @property string $exclusao_txt
 * @property string $rec_ato_file
 * @property string $rec_gov_file
 * @property string $ac_desempenho_bl
 * @property string $ac_conduta_bl
 * @property string $ac_honra_bl
 * @property string $tjpr_file
 * @property string $stj_file
 * @property int $prioridade
 *
 * @package App\Models
 */
class Adl extends Eloquent
{
	protected $table = 'adl';
	protected $primaryKey = 'id_adl';
	public $timestamps = false;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'id_motivoconselho' => 'int',
		'id_decorrenciaconselho' => 'int',
		'id_situacaoconselho' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'portaria_data',
		'prescricao_data'
    ];
    
    public static $files = [
        'libelo_file',
		'parecer_file',
		'decisao_file',
		'rec_ato_file',
		'rec_gov_file',
		'tjpr_file',
		'stj_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'doc_prorrogacao',
		'sjd_ref',
		'sjd_ref_ano',
		'prescricao_data',
		'parecer_comissao',
		'parecer_cmtgeral',
		'exclusao_txt',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'libelo_file',
		'parecer_file',
		'decisao_file',
		'rec_ato_file',
		'rec_gov_file',
		'tjpr_file',
		'stj_file',
		'prioridade'
    ];

    //Activitylog
	use LogsActivity;

    protected static $logName = 'adl';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'libelo_file',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'parecer_file',
		'decisao_file',
		'doc_prorrogacao',
		'sjd_ref',
		'sjd_ref_ano',
		'prescricao_data',
		'parecer_comissao',
		'parecer_cmtgeral',
		'exclusao_txt',
		'rec_ato_file',
		'rec_gov_file',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'tjpr_file',
		'stj_file',
		'prioridade'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\AdlPresenter';

    // query scope
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
		return $query->max('id_adl');
    }
      
    public function getFatoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    public function setFatoDataAttribute($value)
    {
        $this->attributes['fato_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutator para alterar na hora de salvar no bd
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    public function getPortariaDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }

    public function getPrescricaoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    public function setPresecricaoDataAttribute($value)
    {
        $this->attributes['Prescricao_data'] = data_bd($value);
    }

}
