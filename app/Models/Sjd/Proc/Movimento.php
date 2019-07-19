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
 * Class Movimento
 * 
 * @property int $id_movimento
 * @property int $id_ipm
 * @property int $id_cj
 * @property int $id_cd
 * @property \Carbon\Carbon $data
 * @property string $descricao
 * @property string $rg
 * @property string $opm
 * @property int $id_adl
 * @property int $id_sindicancia
 * @property int $id_fatd
 * @property int $id_desercao
 * @property int $id_iso
 * @property int $id_apfd
 * @property int $id_it
 * @property int $id_pad
 * @property int $id_sai
 * @property int $id_proc_outros
 *
 * @package App\Models
 */
class Movimento extends Eloquent
{
	protected $table = 'movimento';
	protected $primaryKey = 'id_movimento';
	public $timestamps = false;

	protected $casts = [
		'id_ipm' => 'int',
		'id_cj' => 'int',
		'id_cd' => 'int',
		'id_adl' => 'int',
		'id_sindicancia' => 'int',
		'id_fatd' => 'int',
		'id_desercao' => 'int',
		'id_iso' => 'int',
		'id_apfd' => 'int',
		'id_it' => 'int',
		'id_pad' => 'int',
		'id_sai' => 'int',
		'id_proc_outros' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_ipm',
		'id_cj',
		'id_cd',
		'data',
		'descricao',
		'rg',
		'opm',
		'id_adl',
		'id_sindicancia',
		'id_fatd',
		'id_desercao',
		'id_iso',
		'id_apfd',
		'id_it',
		'id_pad',
		'id_sai',
		'id_proc_outros'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'movimento';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\MovimentoPresenter';
 
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
    
    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
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
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }
}
