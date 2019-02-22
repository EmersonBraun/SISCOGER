<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Oct 2018 15:24:28 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sindicancium
 * 
 * @property int $id_sindicancia
 * @property int $id_andamentocoger
 * @property int $id_andamento
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $cdopm
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $doc_origem_txt
 * @property string $portaria_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $sol_cmt_file
 * @property \Carbon\Carbon $sol_cmt_data
 * @property string $sol_cmtgeral_file
 * @property \Carbon\Carbon $sol_cmtgeral_data
 * @property string $opm_meta4
 * @property string $relatorio_file
 * @property \Carbon\Carbon $relatorio_data
 * @property int $prioridade
 *
 * @package App\Models
 */
class Sindicancia extends Eloquent
{
	protected $primaryKey = 'id_sindicancia';
	protected $table = 'sindicancia';
	public $timestamps = false;

	protected $casts = [
		'id_andamentocoger' => 'int',
		'id_andamento' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'portaria_data',
		'sol_cmt_data',
		'sol_cmtgeral_data',
		'relatorio_data'
    ];
    
    public static $files = [
        'sol_cmt_file',
        'sol_cmtgeral_file',
        'relatorio_file',
    ];

	protected $fillable = [
		'id_andamentocoger',
		'id_andamento',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'portaria_numero',
		'portaria_data',
		'sol_cmt_file',
		'sol_cmt_data',
		'sol_cmtgeral_file',
		'sol_cmtgeral_data',
		'opm_meta4',
		'relatorio_file',
		'relatorio_data',
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
		return $query->max('id_sindicancia');
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
    public function getSolCmtDataAttribute($value)
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
    public function setSolCmtDataAttribute($value)
    {
        $this->attributes['SolCmt_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getSolCmtgeralDataAttribute($value)
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
    public function setSolCmtgeralDataAttribute($value)
    {
        $this->attributes['sol_cmtgeral_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorioDataAttribute($value)
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
    public function setRelatorioDataAttribute($value)
    {
        $this->attributes['relatorio_data'] = data_bd($value);
    }

}
