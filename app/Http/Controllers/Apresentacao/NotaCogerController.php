<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\NotaCogerRepository;
use App\Model\Apresentacao\Notacomparecimento;

class NotaCogerController extends Controller
{
    public function index(NotaCogerRepository $repository, $ano=date('Y'))
    {
        $registros = $repository->ano($ano);
        return view('apresentacao.notacoger.index', compact('registros','ano'));
    }


    public function create()
    {
        return view('apresentacao.notacoger.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_andamento' => 'required',
            'sintese_txt' => 'required',
        ]);

        //dados do formulário
        $dados = $this->datesToCreate($request); 

        $create = Notacomparecimento::create($dados);

        if($create)
        {
            NotaCogerRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Nota COGER Inserido');
            return redirect()->route('notacoger.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function show($ref,$ano)
    {
        $proc = Notacomparecimento::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        return view('apresentacao.notacoger.form.show', compact('proc'));
    }

    public function edit($ref,$ano)
    {
        $proc = Notacomparecimento::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        return view('apresentacao.notacoger.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_andamento' => 'required',
            'sintese_txt' => 'required',
        ]);

        $dados = $request->all();
        //busca procedimento e atualiza
        $update = Notacomparecimento::findOrFail($id)->update($dados);
        
        if($update)
        {
            NotaCogerRepository::cleanCache();
            toast()->success('Nota COGER atualizada!');
            return redirect()->route('notacoger.lista');
        }

        toast()->warning('Nota COGER NÃO atualizada!');
        return redirect()->route('notacoger.lista');
    }

    public function destroy($id)
    {
        $destroy = Notacomparecimento::findOrFail($id)->delete();

        if($destroy) {
            NotaCogerRepository::cleanCache();
            toast()->success('Nota COGER Apagada');
            return redirect()->route('notacoger.lista');
        }

        toast()->warning('erro ao apagar Nota COGER');
        return redirect()->route('notacoger.lista');
    }

    public function download($id)
    {
        $search = FileUpload::find($id);
        $path = storage_path($search->nota_file);
        $path = str_replace('//','/',$path);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $headers = array('Content-Type: application/pdf',);

        return Response::download($path, $search->nota_file, $headers);
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Notacomparecimento::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }
}
