<?php

namespace App\Http\Controllers;

use File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Sjd\Arquivo\ArquivosApagado;

class UploadController extends Controller
{
    public function upload()
    {
        dd(\Request::all());
        //return view('home');
    }

    public function remover(Request $request)
    {

        //pegar dados
        $proced = $request->proced;
        $id = $request->id;
        $nome = $request->nome;
        $ext = $request->ext;

        //arquivo
        $nomeFile = $proced.$id."_".$nome.".".$ext;
        //diretório arquivo
        $origem = config('sistema.diretorio')."/".$proced;
        //diretório novo
        $destino = config('sistema.diretorio')."/".$proced."/".$id;
        
        if(!is_dir($destino))
        {
            File::makeDirectory($destino, 0777, true, true);
        }
        
        //data completa (para não ter nome igual)
        $data = date("YmdHis");
        //novo nome
        $novoNome = $proced.$id."_".$nome."#$data.".$ext;

        $arquivo_origem = $origem."/".$nomeFile;
        $arquivo_destino = $origem."/".$id."/".$novoNome;

        /*//copia e renomeia
        copy($arquivo_origem, $arquivo_destino);

        //apagar arquivo original
        unlink($arquivo_origem);

        // Pegar procedimento e remover o nome
        $procedimento = DB::connection('sjd')
            ->table($proced)
            ->where('id_'.$proced,'=', $id)
            ->update([$nome => '']);
        
        // salvar arquivo apagado*/
        $data = [
            'procedimento' => $proced,
            'id_procedimento' => $id,
            'objeto' => $novoNome,
            'rg' => session()->get('rg'),
            'nome' => session()->get('nome')
            ];
        //dd($data);
        ArquivosApagado::create($data);

        return "tudo certo";
    }
}
