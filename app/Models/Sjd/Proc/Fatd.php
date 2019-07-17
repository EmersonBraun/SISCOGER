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
class Fatd extends Eloquent
{
    use SoftDeletes;

	protected $table = 'fatd';
	protected $primaryKey = 'id_fatd';
	public $timestamps = false;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
        'portaria_data',
        'deleted_at'
    ];
    
    public static $files = [
        'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'notapunicao_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'despacho_numero',
		'portaria_data',
		'opm_meta4',
		'publicacaonp',
		'prioridade',
		'situacao_fatd',
		'motivo_fatd',
		'motivo_outros',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'notapunicao_file',
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'fatd';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'despacho_numero',
		'portaria_data',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'opm_meta4',
		'notapunicao_file',
		'publicacaonp',
		'prioridade',
		'situacao_fatd',
		'motivo_fatd',
		'motivo_outros'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\FatdPresenter';

	//query scope - para auxir a montagem da query
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
		return $query->max('id_fatd');
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

    //mutators (para alterar na hora de salvar no banco)
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
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

    //mutators (para alterar na hora de salvar no banco)
    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }
}
