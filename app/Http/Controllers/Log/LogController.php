<?php

namespace App\Http\Controllers\Log;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Sjd\Administracao\ActivityLog as Activity;
use App\Models\Sjd\Administracao\LogAcesso as LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio as LogBloqueio;
class LogController extends Controller
{
    //processos e procedimentos
    public function adl()
    {
        $logs = Activity::where('log_name' , 'adl')->get();

        return view('logs.adl',compact('logs'));
    }

    public function apfd()
    {
        $logs = Activity::where('log_name' , 'apfd')->get();

        return view('logs.apfd',compact('logs'));
    }

    public function cd()
    {
        $logs = Activity::where('log_name' , 'cd')->get();

        return view('logs.cd',compact('logs'));
    }

    public function cj()
    {
        $logs = Activity::where('log_name' , 'cj')->get();

        return view('logs.cj',compact('logs'));
    }

    public function desercao()
    {
        $logs = Activity::where('log_name' , 'desercao')->get();

        return view('logs.desercao',compact('logs'));
    }

    public function exclusao()
    {
        $logs = Activity::where('log_name' , 'exclusao')->get();

        return view('logs.exclusao',compact('logs'));
    }

    public function fatd()
    {
        $logs = Activity::where('log_name' , 'fatd')->get();

        return view('logs.fatd',compact('logs'));
    }

    public function ipm()
    {
        $logs = Activity::where('log_name' , 'ipm')->get();

        return view('logs.ipm',compact('logs'));
    }

    public function iso()
    {
        $logs = Activity::where('log_name' , 'iso')->get();

        return view('logs.iso',compact('logs'));
    }

    public function it()
    {
        $logs = Activity::where('log_name' , 'it')->get();

        return view('logs.it',compact('logs'));
    }

    public function movimento()
    {
        $logs = Activity::where('log_name' , 'movimento')->get();

        return view('logs.movimento',compact('logs'));
    }

    public function pad()
    {
        $logs = Activity::where('log_name' , 'pad')->get();

        return view('logs.pad',compact('logs'));
    }

    public function procoutros()
    {
        $logs = Activity::where('log_name' , 'procoutros')->get();

        return view('logs.procoutros',compact('logs'));
    }

    public function sindicancia()
    {
        $logs = Activity::where('log_name' , 'sindicancia')->get();

        return view('logs.sindicancia',compact('logs'));
    }

    public function recurso()
    {
        $logs = Activity::where('log_name' , 'recurso')->get();

        return view('logs.recurso',compact('logs'));
    }
    //apresentação em juizo
    public function notacoger()
    {
        $logs = Activity::where('log_name' , 'notacoger')->get();

        return view('logs.notacoger',compact('logs'));
    }

    public function apresentacao()
    {
        $logs = Activity::where('log_name' , 'apresentacao')->get();

        return view('logs.apresentacao',compact('logs'));
    }

    public function locais()
    {
        $logs = Activity::where('log_name' , 'locais')->get();

        return view('logs.locais',compact('logs'));
    }

    public function email()
    {
        $logs = Activity::where('log_name' , 'email')->get();

        return view('logs.email',compact('logs'));
    }
    //administração
    public function acessos()
    {
        //tabela acessos
        $logs = LogAcesso::all();

        return view('logs.acessos',compact('logs'));
    }

    public function bloqueios()
    {
        //tabela bloqueios
        $logs = LogBloqueio::all();

        return view('logs.bloqueios',compact('logs'));
    }

    public function apagado()
    {
        $logs = Activity::where('log_name' , 'apagado')->get();

        return view('logs.apagado',compact('logs'));
    }

    public function papeis()
    {
        $logs = Activity::where('log_name' , 'papeis')->get();

        return view('logs.papeis',compact('logs'));
    }

    public function permissoes()
    {
        $logs = Activity::where('log_name' , 'permissoes')->get();

        return view('logs.permissoes',compact('logs'));
    }

    public function feriado()
    {
        $logs = Activity::where('log_name' , 'feriado')->get();

        return view('logs.feriado',compact('logs'));
    }

    //policiais
    public function fdi()
    {
        $logs = Activity::where('log_name' , 'fdi')->get();

        return view('logs.fdi',compact('logs'));
    }

    public function cadastroopmcoger()
    {
        $logs = Activity::where('log_name' , 'cadastroopmcoger')->get();

        return view('logs.cadastroopmcoger',compact('logs'));
    }

    public function comportamentopm()
    {
        $logs = Activity::where('log_name' , 'comportamentopm')->get();

        return view('logs.comportamentopm',compact('logs'));
    }

    public function denunciacivil()
    {
        $logs = Activity::where('log_name' , 'denunciacivil')->get();

        return view('logs.denunciacivil',compact('logs'));
    }

    public function elogio()
    {
        $logs = Activity::where('log_name' , 'elogio')->get();

        return view('logs.elogio',compact('logs'));
    }

    public function reintegrado()
    {
        $logs = Activity::where('log_name' , 'reintegrado')->get();

        return view('logs.reintegrado',compact('logs'));
    }

    public function falecimento()
    {
        $logs = Activity::where('log_name' , 'falecimento')->get();

        return view('logs.falecimento',compact('logs'));
    }

    public function preso()
    {
        $logs = Activity::where('log_name' , 'preso')->get();

        return view('logs.preso',compact('logs'));
    }

    public function restricao()
    {
        $logs = Activity::where('log_name' , 'restricao')->get();

        return view('logs.restricao',compact('logs'));
    }

    public function sai()
    {
        $logs = Activity::where('log_name' , 'sai')->get();

        return view('logs.sai',compact('logs'));
    }

    public function suspenso()
    {
        $logs = Activity::where('log_name' , 'suspenso')->get();

        return view('logs.suspenso',compact('logs'));
    }

    public function tramitacaoopm()
    {
        $logs = Activity::where('log_name' , 'tramitacaoopm')->get();

        return view('logs.tramitacaoopm',compact('logs'));
    }

    public function apagados()
    {
        $logs = Activity::where('log_name' , 'apagados')->get();

        return view('logs.apagado',compact('logs'));
    }
}
