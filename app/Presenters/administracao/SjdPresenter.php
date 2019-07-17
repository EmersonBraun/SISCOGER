<?php
namespace App\Presenters\administracao;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class SjdPresenter extends Presenter {
    
    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }
}
