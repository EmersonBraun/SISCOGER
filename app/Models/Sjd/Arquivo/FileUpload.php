<?php

namespace App\Models\Sjd\Arquivo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
class FileUpload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at','data_arquivo'];

    protected $fillable = ['name', 'mime', 'path', 'size','id_proc','proc','obs'];

    protected $casts = [
		'id_proc' => 'int'
    ];

    //Activitylog
	use LogsActivity;
    protected static $logName = 'fileupload';
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