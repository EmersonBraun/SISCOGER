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
 * Class Iso
 * 
 * @property int $id_iso
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $cdopm
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $tipo_penal
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $portaria_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $exclusao_txt
 * @property string $opm_meta4
 * @property string $relatoriomedico_file
 * @property \Carbon\Carbon $relatoriomedico_data
 * @property string $solucaoautoridade_file
 * @property \Carbon\Carbon $solucaoautoridade_data
 * @property int $prioridade
 *
 * @package App\Models
 */
class Iso extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'iso';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'tipo_penal',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'exclusao_txt',
		'opm_meta4',
		'relatoriomedico_file',
		'solucaoautoridade_file',
		'relatoriomedico_data',
		'solucaoautoridade_data',
		'prioridade'
	];
	
	protected $table = 'iso';
	protected $primaryKey = 'id_iso';
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
		'relatoriomedico_data',
		'solucaoautoridade_data'
    ];
    
    public static $files = [
        'relatoriomedico_file',
		'solucaoautoridade_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'tipo_penal',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'exclusao_txt',
		'opm_meta4',
		'relatoriomedico_file',
		'solucaoautoridade_file',
		'relatoriomedico_data',
		'solucaoautoridade_data',
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
		return $query->max('id_iso');
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

    //mutators (para alterar na hora de salvar no banco)
    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatoriomedicoDataAttribute($value)
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
    public function setRelatoriomedicoDataAttribute($value)
    {
        $this->attributes['Relatoriomedico_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getSolucaoautoridadeDataAttribute($value)
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
    public function setSolucaoautoridadeDataAttribute($value)
    {
        $this->attributes['solucaoautoridade_data'] = data_bd($value);
    }

}
