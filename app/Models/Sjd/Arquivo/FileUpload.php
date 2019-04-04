<?php

namespace App\Models\Sjd\Arquivo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'mime', 'path', 'size','id_proc','proc'];

    protected $casts = [
		'id_proc' => 'int'
    ];
    
}