<?php

namespace App\Providers;
//use Collective\Html\FormBuilder;
use Collective\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider
{
    public function boot()
    {
        Form::macro('sfile', function($name, $label, $proc='', $arquivo='')
        {
            if ($arquivo == '' || $arquivo == NULL) 
            {
                $file = "          
                <label for='$name'> $label </label><br>
                <input type='file' name='$name'>
                ";

            return $file;
            } 
            
            else 
            {
                $file = "
                <!-- título -->

                <label for='$name'> $label </label><br>

                <!-- adicionar arquivo -->
                <div id='add-$name' style='display: none;'>
                    <input type='file'>
                </div>

                <!-- remover arquivo -->
                <div id='remove-$name'>
                    <button name='$proc-$name-$arquivo' type='button' onclick='removerArquivo(this);'>
                        <i class='glyphicon glyphicon-trash'></i> <span>Apagar</span>
                    </button>

                    <a href=".asset("storage/public/arquivo/$proc/$arquivo")." target='_blank'>
                        <i class='fa fa-file-pdf-o'></i>$arquivo
                    </a>
                </div>


                ";

            return $file;
            }
        }); //end form
    }
}
