<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use Illuminate\Support\Facades\Route;

class TransationService 
{

	public function __construct()
    {

    }

    public function transation($repository, $data, $type)
    {
        //dd($data);
        if(Route::prefix('api')) $this->transationApi($repository, $data);
        $msg = $this->words($type);
        if($data){
            $repository->cleanCache();
            toast()->success($msg['success']);  
        } 
        toast()->warning($msg['fail']);
    }

    public function transationApi($repository, $data) {
        if($data) {
            $repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,200]);
    }

    public function words($type) {
        if($type == 'create') return ['success' => 'Inserido com sucesso', 'fail' => 'Erro ao inserir'];
        if($type == 'edit') return ['success' => 'Editado com sucesso', 'fail' => 'Erro ao editar'];
        if($type == 'delete') return ['success' => 'Apagado com sucesso', 'fail' => 'Erro ao apagar'];
        if($type == 'restore') return ['success' => 'Restaurado com sucesso', 'fail' => 'Erro ao Restaurar'];
        if($type == 'destroy') return ['success' => 'Apagado DEFINITIVO com sucesso', 'fail' => 'Erro ao apagar DEFINITIVO'];
    }
  
}

