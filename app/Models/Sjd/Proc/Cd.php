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
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
class Cd extends Eloquent
{
    use SoftDeletes;

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
        'prescricao_data',
        'deleted_at'
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
		'cdopm',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'prioridade',
		'libelo_file',
		'parecer_file',
		'decisao_file',
		'rec_ato_file',
		'rec_gov_file',
		'tjpr_file',
		'stj_file'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\CdPresenter';

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
        if($value == '0000-00-00' || $value == null)
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
        if($value == '0000-00-00' || $value == null)
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

    public function setPrescricaoDataAttribute($value)
    {
        $this->attributes['prescricao_data'] = data_bd($value);
    }

}
