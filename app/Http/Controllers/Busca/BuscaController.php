<?php

namespace App\Http\Controllers\Busca;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\rhparana\Policial as Policial;
use App\Models\Sjd\Busca\Ofendido as Ofendido;
use App\Models\Sjd\Busca\Envolvido as Envolvido;
use App\Models\Sjd\Busca\Tramitacaoopm as Tramitacao;
use Illuminate\Support\Facades\DB;
class BuscaController extends Controller
{
    private $totalPorPagina = 10;
    /***************** PM *************************/
    public function pm()
    {
        return view('busca.pm');
    }

    public function fdi(Request $request)
    {
        $rg = $request->rg;
        //dd($rg);
        return redirect()->route('fdi.show',$rg);
    }

    public function opcoesnome(Request $request)
    {
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        
        $busca = $request->phrase;

        if ($verTodasUnidades) 
        {

        $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('nome','like', "%".$busca."%")
            ->limit(10)
            ->get();

        } 
        else 
        {
            $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('nome','like', "%".$busca."%")
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->limit(10)
            ->get();           
        }

        return response()->json($pm);
        
    }

    public function opcoesrg(Request $request)
    {
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        
        $busca = $request->phrase;

        if ($verTodasUnidades) 
        {

        $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','like', "%".$busca."%")
            ->limit(10)
            ->get();

        } 
        else 
        {
            $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','like', "%".$busca."%")
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->limit(10)
            ->get();           
        }

        return response()->json($pm);
        
    }

    public function completadados(Request $request)
    {
        //dd(\Request::all());
        //$rg = $request->rg;

        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','=', $request->rg)
        ->first();

        //verificar se teve resultado
        $pm = (!$pm || is_null($pm)) ? '' : $pm;

        return $pm;

    }

    public function completarg($nome, Request $request)
    {

        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('nome','like', '%'.$nome.'%')
        ->first();

        $pm = (object) $pm;

        return Response($pm->RG);

    }
    
    public function completanome($rg, Request $request)
    {

        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','like', '%'.$rg.'%')
        ->first();

        $pm = (object) $pm;

        return $pm;

    }

    public function getpmrg($rg, Request $request)
    {
        //cria a saída
        $output="";
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        
        if ($verTodasUnidades) 
        {

           $pms = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','like', $rg.'%')
            ->paginate($this->totalPorPagina);

        } 
        else 
        {
             $pms = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','like', $rg.'%')
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->paginate($this->totalPorPagina);           
        }
        
        if($pms)
         
        {

            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr><th>Nome</th><th>RG</th><th>OPM</th><th>Ações</th></tr></thead>';   
            $output.='<tbody>'; 
        
            foreach ($pms as $pm) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($pm['NOME']).'</td>'.
                    '<td>'.$pm['RG'].'</td>'.
                    '<td>'.$pm['OPM_DESCRICAO'].'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$pm['RG'].'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
             
            }

            $output.='</tbody></table>';

            return Response($output);
        }
        else
        {
            $output=" ";
            return Response($output);   
        }
    }

    public function getpmnome($nome, Request $request)
    {
        $output="";
        
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        
        if ($verTodasUnidades) 
        {

           $pms = DB::connection('rhparana')
            ->table('policial')
            ->where('nome','like', '%'.$nome.'%')
            ->paginate($this->totalPorPagina);

        } 
        else 
        {
             $pms = DB::connection('rhparana')
            ->table('policial')
            ->where('nome','like', '%'.$nome.'%')
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->paginate($this->totalPorPagina);           
        }
         
        if($pms)
         
        {

            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr><th>Nome</th><th>RG</th><th>OPM</th><th>Ações</th></tr></thead>';   
            $output.='<tbody>'; 

            foreach ($pms as $pm) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($pm->NOME).'</td>'.
                    '<td>'.$pm['RG'].'</td>'.
                    '<td>'.$pm['OPM_DESCRICAO'].'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$pm['RG'].'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
             
            }

            $output.='</tbody></table>';

            return Response($output);
        }
        else
        {
            $output=" ";   
        }

       
    }
    /***************** PM *************************/
    public function ofendido()
    {

        return view('busca.ofendido');
    }

     public function getofrg($rg, Request $request)
    {
        //cria a saída
        $output="";
        
             $ofs = Ofendido::where('rg','like', $rg.'%')->paginate($this->totalPorPagina);           


            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Situação</th>
                    <th>Resultado</th>
                    <th>Sexo</th>
                    <th>Idade</th>
                    </tr></thead>';   
            $output.='<tbody>'; 
        
            foreach ($ofs as $of) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($of->nome).'</td>'.
                    '<td>'.$of->rg.'</td>'.
                    '<td>'.$of->situacao.'</td>'.
                    '<td>'.$of->resultado.'</td>'.
                    '<td>'.$of->sexo.'</td>'.
                    '<td>'.$of->idade.'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$of->RG.'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
            }
            $output.='</tbody></table>';

            return Response($output);

    }

    public function getofnome($nome, Request $request)
    {
        $output="";

           $ofs = Ofendido::where('nome','like', '%'.$nome.'%')->paginate($this->totalPorPagina);
         
            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Situação</th>
                    <th>Resultado</th>
                    <th>Sexo</th>
                    <th>Idade</th>
                    </tr></thead>';   
            $output.='<tbody>'; 

            foreach ($ofs as $of) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($of->nome).'</td>'.
                    '<td>'.$of->rg.'</td>'.
                    '<td>'.$of->situacao.'</td>'.
                    '<td>'.$of->resultado.'</td>'.
                    '<td>'.$of->sexo.'</td>'.
                    '<td>'.$of->idade.'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$of->RG.'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
             
            }

            $output.='</tbody></table>';

            return Response($output);

       
    }
    /***************** Envolvido  *************************/
    public function envolvido()
    {

        return view('busca.envolvido');

    }

     public function getenrg($rg, Request $request)
    {
        //cria a saída
        $output="";

           $ens = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','like', $rg.'%')
            ->paginate($this->totalPorPagina);

            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr><th>Nome</th><th>RG</th><th>Oen</th><th>Ações</th></tr></thead>';   
            $output.='<tbody>'; 
        
            foreach ($ens as $en) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($en->NOME).'</td>'.
                    '<td>'.$en->RG.'</td>'.
                    '<td>'.$en->Oen_DESCRICAO.'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$en->RG.'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
             
            }

            $output.='</tbody></table>';

            return Response($output);

    }

    public function getennome($nome, Request $request)
    {
        $output="";

           $ens = DB::connection('rhparana')
            ->table('policial')
            ->where('nome','like', '%'.$nome.'%')
            ->paginate($this->totalPorPagina);
         
            $output.='<h6><b>Primeiros '.$this->totalPorPagina.' resultados</b></h6>';
            $output.='<table id="example1" class="table table-bordered table-striped table-hover">';
            $output.='<thead><tr><th>Nome</th><th>RG</th><th>Oen</th><th>Ações</th></tr></thead>';   
            $output.='<tbody>'; 

            foreach ($ens as $en) 
            {
             
            $output.=
                '<tr>'.
                    '<td>'.special_ucwords($en->NOME).'</td>'.
                    '<td>'.$en->RG.'</td>'.
                    '<td>'.$en->Oen_DESCRICAO.'</td>'.
                    '<td>
                       <a class="btn btn-default" href="/siscoger/fdi/'.$en->RG.'/ver"><i class="fa fa-fw fa-eye "></i></a>
                    </td>'.
                '</tr>';
             
            }

            $output.='</tbody></table>';

            return Response($output);
       
    }

    /***************** Outros *************************/
    public function tramitacao()
    {
        $tramitacao = Tramitacao::all();

        return view('busca.tramitacao',compact('tramitacao'));
    }

        public function documentacao()
    {
        return view('busca.documentacao');
    }

    public function pdf()
    {
        return view('busca.pdf');
    }

}
