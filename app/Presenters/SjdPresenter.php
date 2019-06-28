<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class SjdPresenter extends Presenter {
    
    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }
}
