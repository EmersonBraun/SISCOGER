<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Aug 2019 15:11:32 +0000.
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
 * Class Medalha
 * 
 * @property int $id_medalha
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cargo
 * @property string $nome
 * @property string $nome_medalha
 * @property string $bi_num
 * @property \Carbon\Carbon $bi_data
 * @property string $obs_txt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Medalha extends Eloquent
{
	use SoftDeletes;
	protected $table = 'medalha';
	protected $primaryKey = 'id_medalha';

	protected $dates = [
		'bi_data'
	];

	protected $fillable = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'nome_medalha',
		'bi_num',
		'bi_data',
		'obs_txt'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'medalha';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    //mutators (para alterar na hora da exibição)
    public function getBiDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setBiDataAttribute($value)
    {
        $this->attributes['bi_data'] = data_bd($value);
    }
}
