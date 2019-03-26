<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Busca;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Envolvido
 * 
 * @property int $id_envolvido
 * @property string $rg_substituto
 * @property string $nome
 * @property string $rg
 * @property string $situacao
 * @property string $cargo
 * @property string $resultado
 * @property int $inclusao_ano
 * @property int $id_ipm
 * @property int $id_cj
 * @property int $id_cd
 * @property int $id_adl
 * @property int $id_sindicancia
 * @property int $id_fatd
 * @property int $id_desercao
 * @property int $id_apfd
 * @property int $id_iso
 * @property int $id_it
 * @property int $id_pad
 * @property int $id_sai
 * @property string $ipm_julgamento
 * @property string $ipm_processocrime
 * @property int $ipm_pena_anos
 * @property int $ipm_pena_meses
 * @property int $ipm_pena_dias
 * @property string $ipm_tipodapena
 * @property string $ipm_transitojulgado_bl
 * @property string $ipm_restritiva_bl
 * @property string $obs_txt
 * @property \Carbon\Carbon $exclusaoportaria_data
 * @property string $exclusaoportaria_numero
 * @property string $exclusaoboletim
 * @property int $exclusaobg_numero
 * @property int $exclusaobg_ano
 * @property \Carbon\Carbon $exclusaobg_data
 * @property string $exclusaoopm
 * @property int $id_punicao
 * @property int $id_proc_outros
 *
 * @package App\Models
 */
class Envolvido extends Eloquent
{
	protected $table = 'envolvido';
	protected $primaryKey = 'id_envolvido';
	public $timestamps = false;

	protected $casts = [
		'inclusao_ano' => 'int',
		'id_ipm' => 'int',
		'id_cj' => 'int',
		'id_cd' => 'int',
		'id_adl' => 'int',
		'id_sindicancia' => 'int',
		'id_fatd' => 'int',
		'id_desercao' => 'int',
		'id_apfd' => 'int',
		'id_iso' => 'int',
		'id_it' => 'int',
		'id_pad' => 'int',
		'id_sai' => 'int',
		'ipm_pena_anos' => 'int',
		'ipm_pena_meses' => 'int',
		'ipm_pena_dias' => 'int',
		'exclusaobg_numero' => 'int',
		'exclusaobg_ano' => 'int',
		'id_punicao' => 'int',
		'id_proc_outros' => 'int'
	];

	protected $dates = [
		'exclusaoportaria_data',
		'exclusaobg_data'
	];

	protected $fillable = [
		'rg_substituto',
		'nome',
		'rg',
		'situacao',
		'cargo',
		'resultado',
		'inclusao_ano',
		'id_ipm',
		'id_cj',
		'id_cd',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_apfd',
		'id_iso',
		'id_it',
		'id_pad',
		'id_sai',
		'ipm_julgamento',
		'ipm_processocrime',
		'ipm_pena_anos',
		'ipm_pena_meses',
		'ipm_pena_dias',
		'ipm_tipodapena',
		'ipm_transitojulgado_bl',
		'ipm_restritiva_bl',
		'obs_txt',
		'exclusaoportaria_data',
		'exclusaoportaria_numero',
		'exclusaoboletim',
		'exclusaobg_numero',
		'exclusaobg_ano',
		'exclusaobg_data',
		'exclusaoopm',
		'id_punicao',
		'id_proc_outros'
	];

	public function scopeSituacao($query, $situacao)
	{
		return $query->where('situacao','=',$situacao);
	}

	public function scopeAcusado($query)
	{
		return $query->where('situacao','=','Acusado');
	}

	public function scopeOfendido($query)
	{
		return $query->where('situacao','=','Ofendido');
	}

	public function scopeEncarregado($query)
	{
		return $query->where('rg_substituto', '=','')
				->where('situacao','=','Encarregado');
	}

	public function scopeAcusador($query)
	{
		return $query->where('rg_substituto', '=','')
				->where('situacao','=','Acusador');
	}

	public function scopeDefensor($query)
	{
		return $query->where('rg_substituto', '=','')
				->where('situacao','=','Defensor');
	}

	public function scopePresidente($query)
	{
		return $query->where('rg_substituto', '=','')
				->where('situacao','=','Presidente');
	}

	public function scopeEscrivao($query)
	{
		return $query->where('rg_substituto', '=','')
				->where('situacao','=','Escrivao');
	}
}
