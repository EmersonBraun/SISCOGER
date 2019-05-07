<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
use App\Models\Sjd\Administracao\LogAcesso;
//para verificar se está bloqueado
use App\Rules\Block;
//para verificar se está com muito tempo de inatividade
use App\Rules\IntervaloDias;
//para verificar se tem o RG cadastrado
use App\Rules\ExistRg;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'rg';
    }

    public function login(Request $request, LogAcesso $logacesso)
    {
        //verificar se os campos foram preenchidos
        $this->validate($request, [
            'rg' => ['required', 'numeric', new ExistRg, new Block, new IntervaloDias],
            'password'=>'required',
        ]);

        //variáveis globais
        $credentials = $request->only('rg', 'password');
        $ip = $_SERVER["REMOTE_ADDR"];
        $rg = $request['rg'];
        
        //traz os dados do usuário
        $user = User::where('rg', '=', $rg)->first();
        // aborta caso não tenha o usuário
        if (!$user) return abort(403);
        
        //salva dados usuário na sessão
        session()->put('rg',$user->rg);
        session()->put('nome', $user->nome);
        session()->put('email', $user->email);
        session()->put('cargo', $user->cargo);
        session()->put('quadro', $user->quadro);
        session()->put('subquadro', $user->subquadro);
        session()->put('opm_descricao', $user->opm_descricao);
        session()->put('cdopm', $user->cdopm);    
        session()->put('cdopmbase', corta_zeros($user->cdopm));
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = (boolean) User::permission('todas-unidades')->count();
        session()->put('ver_todas_unidades', $verTodasUnidades);
        //verifica se o usuário é administrador
        $isAdmin = User::role('admin')->count();
        $isAdmin = ($isAdmin > 0) ? true : false;
        session()->put('is_admin', $isAdmin);
        session()->put('nivel',sistema('posto',$user->cargo));

        if (Auth::attempt($credentials)) 
        {
            //mensagens
            toast()->success('Bem vindo '.$user->nome, 'Login!');
            
            //zera as tentativas
            $user->tentativas = 0;
            $user->save();
            
            //salva dados de log
            $logacesso->rg = $user->rg;
            $logacesso->nome = $user->nome;
            $logacesso->tipo = 'acesso';
            $logacesso->created_at = \Carbon\Carbon::now();
            $logacesso->ip = $ip;
            $logacesso->save();
            //verifica se o usuário concordou com os termos de uso
            if ($user->termos == 0) 
            {
               return redirect()->route('users.pass',$user->id); 
            }
            else
            {
                //remove sessão antiga
                session()->forget($user->id_sessao);
                // atualiza o id da sessão
                $user->id_sessao = session()->getId();
                $user->save();

                return redirect()->route('home');
            }
            
        }

        else
        {
            
            $user->tentativas = ($user->sessao == session()->get('_token')) ? $user->tentativas + 1 : 1;
            $user->save();
            switch ($user->tentativas) 
            {
                case '1':
                    //salva o token no usuário para verificar as tentativas
                    $user->sessao = session()->get('_token');
                    $user->save();
                   //mensagens
                    toast()->warning('Tentativas Restantes!', 2);
                    toast()->error('Dados inválidos!', 'ERRO!');
                    return redirect()->back();
                break;

                case '2':
                    //mensagens
                    toast()->warning('Se acabarem as tentativas, o usuário será bloquado!');
                    toast()->warning('Tentativas Restantes!', 1);
                    toast()->error('Dados inválidos!', 'ERRO!');
                    return redirect()->back();
                break;

                case '3':
                    //bloqueio do usuário
                    $user->block = 1;
                    $user->tentativas = 0;
                    $user->save();
                    //mensagens
                    toast()->warning('Favor entrar em contato com o SJD');
                    toast()->error('usuário BLOQUEADO!');
                    toast()->warning('Tentativas Restantes!', 0);
                    toast()->error('Dados inválidos!', 'ERRO!');

                    return redirect()->back();
                break;
            }
            
            
        }
                   
    }

    public function logout(User $user)
    {
        Auth::logout();
        return redirect()->intended('login');
    }

    // public function home()
    // {
    //     return view('vendor.adminlte.page'); 
    // }

}
