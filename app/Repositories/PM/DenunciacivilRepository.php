
<?php

use Cache;
use App\Models\Sjd\Policiais\Denunciacivil;
use App\Repositories\BaseRepository;

class DenunciacivilRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Denunciacivil $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('denunciacivil')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('denunciacivil')->remember('todos_denunciacivil', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}
