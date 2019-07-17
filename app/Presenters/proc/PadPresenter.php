<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;

class PadPresenter extends Presenter {
	
    public function createdAt()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function statusPriorityColor()
    {
            $labels = [
                '4'  => 'primary',
                '3'  => 'success',
                '2'  => 'warning',
                '1'  => 'danger'
            ];

            return $labels[$this->prioridade];
    }

}