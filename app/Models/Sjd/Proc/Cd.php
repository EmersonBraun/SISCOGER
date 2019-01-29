<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Cd
 * 
 * @property int $id_cd
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $id_motivoconselho
 * @property int $id_decorrenciaconselho
 * @property int $id_situacaoconselho
 * @property string $outromotivo
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
 * @property string $cdopm
 * @property string $ac_desempenho_bl
 * @property string $ac_conduta_bl
 * @property string $ac_honra_bl
 * @property string $tjpr_file
 * @property string $stj_file
 * @property int $prioridade
 *
 * @package App\Models
 */
class Cd extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'cd';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
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
		'cdopm',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'tjpr_file',
		'stj_file',
		'prioridade'
	];
	
	protected $table = 'cd';
	protected $primaryKey = 'id_cd';
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

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
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
		'cdopm',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'tjpr_file',
		'stj_file',
		'prioridade'
	];

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
		return $query->max('id_cd');
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
        $this->attributes['Fato_data'] = data_bd($value);
    }

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

    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    public function getPortariaDataAttribute($value)
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

    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }

    public function getPrescricaoDataAttribute($value)
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

    public function setPrescricaoDataAttribute($value)
    {
        $this->attributes['prescricao_data'] = data_bd($value);
    }

}
