<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Sep 2018 13:05:06 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class It
 * 
 * @property int $id_it
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property string $cdopm
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $vtr_placa
 * @property string $vtr_prefixo
 * @property string $vtr_propriedade
 * @property string $portaria_numero
 * @property string $boletiminterno_numero
 * @property \Carbon\Carbon $boletiminterno_data
 * @property string $tipo_acidente
 * @property string $avarias
 * @property string $situacao_objeto
 * @property string $sintese_txt
 * @property string $br_numero
 * @property string $situacaoviatura
 * @property string $acordoamigavel
 * @property int $id_causa_acidente
 * @property int $id_resp_civil
 * @property string $arquivo_numero
 * @property string $protocolo_numero
 * @property string $acaojudicial
 * @property string $danoestimado_rs
 * @property string $danoreal_rs
 * @property string $opm_meta4
 * @property string $objetoprocedimento
 * @property string $identificacao_arma
 * @property string $identificacao_municao
 * @property string $identificacao_semovente
 * @property string $outros
 * @property string $relatorio_file
 * @property \Carbon\Carbon $relatorio_data
 * @property string $solucao_unidade_file
 * @property \Carbon\Carbon $solucao_unidade_data
 * @property string $solucao_complementar_file
 * @property \Carbon\Carbon $solucao_complementar_data
 * @property int $prioridade
 *
 * @package App\Models
 */
class It extends Eloquent
{
	protected $table = 'it';
	protected $primaryKey = 'id_it';
	public $timestamps = false;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_causa_acidente' => 'int',
		'id_resp_civil' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'boletiminterno_data',
		'relatorio_data',
		'solucao_unidade_data',
		'solucao_complementar_data'
    ];
    
    public static $files = [
        'relatorio_file',
		'solucao_unidade_file',
		'solucao_complementar_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'cdopm',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'vtr_placa',
		'vtr_prefixo',
		'vtr_propriedade',
		'portaria_numero',
		'boletiminterno_numero',
		'boletiminterno_data',
		'tipo_acidente',
		'avarias',
		'situacao_objeto',
		'sintese_txt',
		'br_numero',
		'situacaoviatura',
		'acordoamigavel',
		'id_causa_acidente',
		'id_resp_civil',
		'arquivo_numero',
		'protocolo_numero',
		'acaojudicial',
		'danoestimado_rs',
		'danoreal_rs',
		'opm_meta4',
		'objetoprocedimento',
		'identificacao_arma',
		'identificacao_municao',
		'identificacao_semovente',
		'outros',
		'relatorio_data',
		'solucao_unidade_data',
		'solucao_complementar_data',
		'relatorio_file',
		'solucao_unidade_file',
		'solucao_complementar_file',
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
		return $query->max('id_it');
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
    public function getBoletiminternoDataAttribute($value)
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
    public function setBoletiminternoDataAttribute($value)
    {
        $this->attributes['Boletiminterno_data'] = data_bd($value);
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

    //mutators (para alterar na hora da exibição)
    public function getSolucaoUnidadeDataAttribute($value)
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
    public function setSolucaoUnidadeDataAttribute($value)
    {
        $this->attributes['solucao_unidade_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getSolucaoComplementarDataAttribute($value)
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
    public function setSolucaoComplementarDataAttribute($value)
    {
        $this->attributes['solucao_complementar_data'] = data_bd($value);
    }

}
