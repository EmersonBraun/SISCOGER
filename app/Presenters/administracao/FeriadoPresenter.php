<?php
namespace App\Presenters\administracao;

use Laracasts\Presenter\Presenter;

class FeriadoPresenter extends Presenter {
    
    public function dayOfWeek()
    {
        return dayOfWeek($this->data);
    }
}