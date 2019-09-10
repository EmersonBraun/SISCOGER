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
    protected $rg;
    protected $ip;
    protected $user;

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'rg';
    }

    public function getUser()
    {
        $user = User::where('rg', '=', $this->rg)->first();
        // aborta caso não tenha o usuário
        if (!$user) return abort(403);
        $this->user = $user;
    }

    public function login(Request $request)
    {
        //verificar se os campos foram preenchidos
        $this->validate($request, [
            'rg' => ['required', 'numeric', new ExistRg, new Block, new IntervaloDias],
            'password'=>'required',
        ]);

        //variáveis globais
        $credentials = $request->only('rg', 'password');
        $this->rg = $request['rg'];
        $this->ip = $_SERVER["REMOTE_ADDR"];
        
        //traz os dados do usuário
        $this->getUser();

        //salva dados usuário na sessão
        $this->session();

        if (Auth::attempt($credentials)) 
        {
            //mensagens
            toast()->success('Bem vindo '.$this->user->nome, 'Login!');
            
            //zera as tentativas
            $this->user->tentativas = 0;
            $this->user->save();
            
            $this->logAcesso();
            //verifica se o usuário concordou com os termos de uso
            if ($this->user->termos == 0) return redirect()->route('users.pass',$this->user->id); 
            else
            {
                //remove sessão antiga
                session()->forget($this->user->id_sessao);
                // atualiza o id da sessão
                $this->user->id_sessao = session()->getId();
                $this->user->save();

                return redirect()->route('home');
            }
            
        }

        else
        { 
            $this->user->tentativas = ($this->user->sessao == session('_token')) ? $this->user->tentativas + 1 : 1;
            $this->user->save();
            switch ($this->user->tentativas) 
            {
                case '1':
                    //salva o token no usuário para verificar as tentativas
                    $this->user->sessao = session('_token');
                    $this->user->save();
                   //mensagens
                    toast()->warning('Tentativas Restantes!', 2);
                    toast()->error('Dados inválidos!', 'ERRO!');
                    return redirect()->route('login');
                break;

                case '2':
                    //mensagens
                    toast()->warning('Se acabarem as tentativas, o usuário será bloquado!');
                    toast()->warning('Tentativas Restantes!', 1);
                    toast()->error('Dados inválidos!', 'ERRO!');
                    return redirect()->route('login');
                break;

                case '3':
                    //bloqueio do usuário
                    $this->user->block = 1;
                    $this->user->tentativas = 0;
                    $this->user->save();
                    //mensagens
                    toast()->warning('Favor entrar em contato com o SJD');
                    toast()->error('usuário BLOQUEADO!');
                    toast()->warning('Tentativas Restantes!', 0);
                    toast()->error('Dados inválidos!', 'ERRO!');

                    return redirect()->route('login');
                break;
            }   
        }
                   
    }

    public function session()
    {
        session()->put('rg',$this->user->rg);
        session()->put('nome', $this->user->nome);
        session()->put('email', $this->user->email);
        session()->put('cargo', $this->user->cargo);
        session()->put('quadro', $this->user->quadro);
        session()->put('subquadro', $this->user->subquadro);
        session()->put('opm_descricao', $this->user->opm_descricao);
        session()->put('cdopm', $this->user->cdopm);    
        session()->put('cdopmbase', corta_zeros($this->user->cdopm));
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = (boolean) User::permission('todas-unidades')->count();
        session()->put('ver_todas_unidades', $verTodasUnidades);
        //verifica se o usuário tem permissão para ver superior
        $verSuperior = (boolean) User::permission('ver-superior')->count();
        session()->put('ver_superior', $verSuperior);
        //verifica se o usuário é administrador
        $isAdmin = User::role('admin')->count();
        $isAdmin = ($isAdmin > 0) ? true : false;
        if($isAdmin) \Debugbar::enable();
        session()->put('is_admin', $isAdmin);
        session()->put('nivel',sistema('posto',$this->user->cargo));
        // todos papéis que o usuário possui
        session()->put('roles', $this->user->getRoleNames());
        // todas permissões que o usuário possui
        session()->put('permissions', $this->user->getAllPermissions()->pluck('name')->toArray());
    }

    public function logAcesso()
    {
        $dados = [
            'rg' => $this->user->rg,
            'nome' => $this->user->nome,
            'tipo' => 'acesso',
            'created_at' => \Carbon\Carbon::now(),
            'ip' => $this->ip,
        ];

        LogAcesso::create($dados);
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
