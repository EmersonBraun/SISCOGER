<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Storage;
use File;
use Response;
use DB;
use Illuminate\Support\Facades\Schema;
Use App\Models\Sjd\Arquivo\FileUpload;

class FileUploadController extends Controller
{
    public function index($proc, $id, $arquivo)
    {
        $list = FileUpload::where('id_proc','=',$id)
            ->where('proc','=',$proc)
            ->where('campo','=',$arquivo)
            ->get();

        $apagados = FileUpload::onlyTrashed()
            ->where('id_proc','=',$id)
            ->where('proc','=',$proc)
            ->where('campo','=',$arquivo)
            ->get();

        if($list){
            return response()->json([
                'list' => $list,
                'apagados' => $apagados,
                'success' => true
            ]);
        }
        
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function show($proc, $procid, $arquivo, $hash)
    {
        // validações
        if(!$proc) return response()->json(['erro' => 'Falta Proc','success' => false], 500);
        if(!$procid) return response()->json(['erro' => 'Falta ID Proc','success' => false], 500);
        if(!$arquivo) return response()->json(['erro' => 'Falta arquivo','success' => false], 500);
        if(!$hash) return response()->json(['erro' => 'Falta HASH','success' => false], 500);

        $search = FileUpload::where('hash',$hash)->withTrashed()->first();
        if(!$search) abort(404);

        $config = config('app.uploads');
        $path = storage_path($search->path);
        if (!File::exists($path)) {

            $fileAntigo = DB::table($dados['proc'])
                ->where('id_'.$dados['proc'], $dados['id_proc'])
                ->value();
            
            if(!$fileAntigo) abort(404);

            $path = $config.'/'.$filename;
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function store(Request $request)
    {
        // dados requisição
        $dados = $request->all();
        //arquivo
        $file = $request->file('file');

        // nome do arquivo
        if($dados['nome_original']) 
        {
            $filename = $file->getClientOriginalName();
        }
        else
        { 
            $filename = $dados['proc'].$dados['id_proc'].'_'.$dados['name'].'.'.$dados['ext'];
        }

        //data_arquivo
        $data_arquivo = (!$dados['data_arquivo']) ? date('Y-m-d'): $dados['data_arquivo'];
        // consulta
        $query = DB::table($dados['proc'])->where('id_'.$dados['proc'], $dados['id_proc']);
        // nome
        if(Schema::hasColumn($dados['proc'], $dados['name'])) $query->update([$dados['name'] => $filename]);
        // data do arquivo
        if(Schema::hasColumn($dados['proc'], $dados['name'].'_data')) $query->update([$dados['name'].'_data' => $data_arquivo]);

        //pegar procedimento
        $proc = $query->first();
        // $filename = $file->getClientOriginalName();
        $folder = hash( 'sha256', time());
        $config = (!is_null(config('app.uploads'))) ? config('app.uploads') : '' ;
        $path = $config.'/'.$folder.'/'.$filename;

        if(Storage::disk('uploads')->putFileAs($folder,  $file, $filename)) {
            $fileUpload = new FileUpload();
            $fileUpload->hash = md5($filename);
            $fileUpload->name = $filename;
            $fileUpload->campo = $dados['name'];
            $fileUpload->mime = $file->getClientMimeType();
            $fileUpload->path = $path;
            $fileUpload->size = $file->getClientSize();
            $fileUpload->sjd_ref = $proc['sjd_ref'];
            $fileUpload->sjd_ref_ano = $proc['sjd_ref_ano'];
            $fileUpload->rg = $dados['rg'];
            $fileUpload->proc = $dados['proc'];
            $fileUpload->id_proc = $dados['id_proc'];
            $fileUpload->data_arquivo = $data_arquivo;
            $fileUpload->save();

            return response()->json([
                'success' => true,
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 500);

    }

    public function delete($id)
    {
        $delete = FileUpload::where('id',$id)->delete();
        if ($delete) {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);

    }

    public function destroy($id)
    {
        $search =  FileUpload::where('id',$id)->withTrashed()->first();
        FileUpload::where('id',$id)->forceDelete();
        $config = config('app.uploads');
        $path = storage_path($search->path);
        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);

    }
}
