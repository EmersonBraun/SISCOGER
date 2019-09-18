<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\CadastroOPMAutoridadeRepository;
use App\Repositories\apresentacao\CadastroOPMRepository;

class DadosOmController extends Controller
{
    protected $comando;
    protected $outras;
    public function __construct(
        CadastroOPMRepository $comando,
        CadastroOPMAutoridadeRepository $outras
    )
	{
        $this->comando = $comando;
        $this->outras = $outras;
    }

    public function comando()
    {
        $registros = $this->comando->all();
        return view('apresentacao.dados_opm.comando', compact('registros'));
    }

    public function outras()
    {
        $registros = $this->outras->all();
        return view('apresentacao.dados_opm.outras', compact('registros'));
    }

    public function form()
    {
        return view('apresentacao.dados_opm.form');
    }

}
