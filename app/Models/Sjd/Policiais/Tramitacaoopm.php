<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Tramitacaoopm
 * 
 * @property int $id_tramitacaoopm
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $rg_cadastro
 * @property \Carbon\Carbon $data
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $descricao_txt
 * @property string $digitador
 *
 * @package App\Models
 */
class Tramitacaoopm extends Eloquent
{
    use SoftDeletes;
	
	protected $table = 'tramitacaoopm';
	protected $primaryKey = 'id_tramitacaoopm';
	public $timestamps = false;

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'rg_cadastro',
		'data',
		'cdopm',
		'opm_abreviatura',
		'descricao_txt',
		'digitador'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'tramitacaoopm';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\TramitacaoopmPresenter';

    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }
}
