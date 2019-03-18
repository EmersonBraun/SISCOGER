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
 * Class ProcOutro
 * 
 * @property int $id_proc_outros
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $rg_cadastro
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $cdopm_apuracao
 * @property \Carbon\Carbon $abertura_data
 * @property \Carbon\Carbon $data
 * @property string $bou_ano
 * @property string $bou_numero
 * @property int $id_municipio
 * @property string $doc_origem
 * @property string $num_doc_origem
 * @property string $motivo_abertura
 * @property string $sintese_txt
 * @property string $relatorio1
 * @property string $relatorio1_file
 * @property \Carbon\Carbon $relatorio1_data
 * @property string $relatorio2
 * @property string $relatorio2_file
 * @property \Carbon\Carbon $relatorio2_data
 * @property string $relatorio3
 * @property string $relatorio3_file
 * @property \Carbon\Carbon $relatorio3_data
 * @property string $desc_outros
 * @property string $andamento
 * @property string $andamentocoger
 * @property string $vtr1_placa
 * @property string $vtr1_prefixo
 * @property string $vtr2_placa
 * @property string $vtr2_prefixo
 * @property string $digitador
 * @property string $num_pid
 * @property \Carbon\Carbon $limite_data
 *
 * @package App\Models
 */
class ProcOutro extends Eloquent
{
	protected $primaryKey = 'id_proc_outros';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_municipio' => 'int'
	];

	protected $dates = [
		'abertura_data',
		'data',
		'relatorio1_data',
		'relatorio2_data',
		'relatorio3_data',
		'limite_data'
    ];
    
    public static $files = [
        'relatorio1_file',
        'relatorio2_file',
        'relatorio3_file',
    ];

	protected $fillable = [
		'sjd_ref',
		'sjd_ref_ano',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura',
		'cdopm_apuracao',
		'abertura_data',
		'data',
		'bou_ano',
		'bou_numero',
		'id_municipio',
		'doc_origem',
		'num_doc_origem',
		'motivo_abertura',
		'sintese_txt',
		'relatorio1',
		'relatorio1_file',
		'relatorio1_data',
		'relatorio2',
		'relatorio2_file',
		'relatorio2_data',
		'relatorio3',
		'relatorio3_file',
		'relatorio3_data',
		'desc_outros',
		'andamento',
		'andamentocoger',
		'vtr1_placa',
		'vtr1_prefixo',
		'vtr2_placa',
		'vtr2_prefixo',
		'digitador',
		'num_pid',
		'limite_data'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'procoutro';
    protected static $logAttributes = [
		'sjd_ref',
		'sjd_ref_ano',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura',
		'cdopm_apuracao',
		'abertura_data',
		'data',
		'bou_ano',
		'bou_numero',
		'id_municipio',
		'doc_origem',
		'num_doc_origem',
		'motivo_abertura',
		'sintese_txt',
		'relatorio1',
		'relatorio1_file',
		'relatorio1_data',
		'relatorio2',
		'relatorio2_file',
		'relatorio2_data',
		'relatorio3',
		'relatorio3_file',
		'relatorio3_data',
		'desc_outros',
		'andamento',
		'andamentocoger',
		'vtr1_placa',
		'vtr1_prefixo',
		'vtr2_placa',
		'vtr2_prefixo',
		'digitador',
		'num_pid',
		'limite_data'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\ProcOutroPresenter';

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
		return $query->max('id_proc_outros');
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
    public function getDataAttribute($value)
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
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio1DataAttribute($value)
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
    public function setRelatorio1DataAttribute($value)
    {
        $this->attributes['relatorio1_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio2DataAttribute($value)
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
    public function setRelatorio2DataAttribute($value)
    {
        $this->attributes['relatorio2_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio3DataAttribute($value)
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
    public function setRelatorio3DataAttribute($value)
    {
        $this->attributes['relatorio3_data'] = data_bd($value);
    }

     //mutators (para alterar na hora da exibição)
     public function getLimiteDataAttribute($value)
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
     public function setLimiteDataAttribute($value)
     {
         $this->attributes['limite_data'] = data_bd($value);
     }

}
