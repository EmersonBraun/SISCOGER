<?php

namespace App\Models\Sjd\Correicoes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;

class Extraordinaria extends Model
{
    use SoftDeletes;

    protected $dates = [];

    protected $fillable = [];

    protected $casts = [];

    //Activitylog
	use LogsActivity;
    protected static $logName = 'extraordinaria';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

    public function getDataArquivoAttribute($value)
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

    public function setDataArquivoAttribute($value)
    {
        $this->attributes['data_arquivo'] = data_bd($value);
    }
    
}