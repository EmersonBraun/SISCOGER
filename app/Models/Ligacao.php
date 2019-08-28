<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 28 Aug 2019 14:49:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ligacao
 * 
 * @property int $id_ligacao
 * @property string $origem_opm
 * @property int $origem_sjd_ref
 * @property int $origem_sjd_ref_ano
 * @property string $origem_proc
 * @property int $destino_sjd_ref
 * @property int $destino_sjd_ref_ano
 * @property string $destino_proc
 * @property int $id_adl
 * @property int $id_apfd
 * @property int $id_cd
 * @property int $id_cj
 * @property int $id_desercao
 * @property int $id_fatd
 * @property int $id_ipm
 * @property int $id_iso
 * @property int $id_it
 * @property int $id_sindicancia
 * @property int $id_preso
 * @property int $id_falecimento
 * @property int $id_sai
 * @property int $id_proc_outros
 *
 * @package App\Models
 */
class Ligacao extends Eloquent
{
	protected $table = 'ligacao';
	protected $primaryKey = 'id_ligacao';
	public $timestamps = false;

	protected $casts = [
		'origem_sjd_ref' => 'int',
		'origem_sjd_ref_ano' => 'int',
		'destino_sjd_ref' => 'int',
		'destino_sjd_ref_ano' => 'int',
		'id_adl' => 'int',
		'id_apfd' => 'int',
		'id_cd' => 'int',
		'id_cj' => 'int',
		'id_desercao' => 'int',
		'id_fatd' => 'int',
		'id_ipm' => 'int',
		'id_iso' => 'int',
		'id_it' => 'int',
		'id_sindicancia' => 'int',
		'id_preso' => 'int',
		'id_falecimento' => 'int',
		'id_sai' => 'int',
		'id_proc_outros' => 'int'
	];

	protected $fillable = [
		'origem_opm',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_proc',
		'destino_sjd_ref',
		'destino_sjd_ref_ano',
		'destino_proc',
		'id_adl',
		'id_apfd',
		'id_cd',
		'id_cj',
		'id_desercao',
		'id_fatd',
		'id_ipm',
		'id_iso',
		'id_it',
		'id_sindicancia',
		'id_preso',
		'id_falecimento',
		'id_sai',
		'id_proc_outros'
	];
}
