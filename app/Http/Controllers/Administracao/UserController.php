<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\User;
use Cache;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;
use App\Models\Sjd\Administracao\LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio as LogBloqueio;
use App\Models\Sjd\Administracao\Termocompromisso as Termocompromisso;
class UserController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //tempo de cahe
        $expiration = 60; 
        //chave
        $key = 'user';
        //buscar dados do cache
        $users = Cache::remember($key, $expiration, function(){
            return User::all();
        });
        
        return view('administracao.usuarios.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('administracao.usuarios.create', compact('roles'));
    }

    public function store(User $user, Request $request)
    {
       //Validação
        $this->validate($request, [
            'rg'=>'required|unique:users|min:6',
            'roles' =>'required'
        ]);
        //$pm = Policial::Where('rg',$request->rg)->first();
        $pm = DB::connection('rhparana')->table('policial')->where('rg',$request->rg)->first();
        
        //dd($pm);

        //verificar se o RG existe
        if (!$pm) 
        {
            toast()->warning('esse RG não existe no Meta4!', 'ERRO!');
            return redirect()->route('users.index');
        }
        else
        {
            $pm = (object) $pm;

            $user->rg = $request->rg;
            $user->nome = $pm->NOME;
            $user->email = $pm->EMAIL_META4;
            $user->classe = $pm->CLASSE;
            $user->cargo = $pm->CARGO; //graduação
            $user->quadro = $pm->QUADRO;
            $user->subquadro = $pm->SUBQUADRO;
            $user->opm_descricao = $pm->OPM_DESCRICAO; //nome unidade
            $user->cdopm = $pm->CDOPM; //código da unidade
            $user->password = $request->rg;//atribuir senha provisória

            $user->save();

            //Recuperando o campo de funções
            $roles = $request['roles']; 
            //Verficar se as regras foram selecionadas
            if (isset($roles)) {

                foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();  
                //Atribuindo papel ao usuário    
                $user->assignRole($role_r); 
                }
            }     
             
            //limpa o cache
            Cache::forget('user');

            //Redirecionando users.index view com mensagem
            toast()->success('adicionado com sucesso!', 'Usuário');
            return redirect()->route('users.index');
        }
    }

    public function show($id)
    {
        return redirect('users');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(); 

        return view('administracao.usuarios.edit', compact('user', 'roles')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  
        
        $this->validate($request, [
            'rg'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ]);

        $input = $request->only(['rg', 'email']); //Recupere os campos rg, email
        $roles = $request['roles']; //Recuperar todas as regras
        $user->fill($input)->save();

        //limpa o cache
        Cache::forget('user');

        if (isset($roles)) 
        {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else 
        {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        toast()->success('atualizado com sucesso!', 'Usuário');

        return redirect()->route('users.index');
    }
    //apagar usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();

        toast()->message('atualizado com sucesso!', 'Usuário');
        return redirect()->route('users.index');
    }

    //formulário para atualizar senha
    public function passedit($id)
    {
        $user = User::findOrFail($id);
        //verifica se o usuário já tem termo de compromisso
        if ($user->termos == 0) 
        {
           return view('administracao.usuarios.reset', compact('user'));
        }
        else
        {
          return view('administracao.usuarios.pass', compact('user'));  
        }

    }
    //atualizar a senha
    public function passupdate($id, Request $request)
    { 

        $this->validate($request, [
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);  
        $user->password = $request['password']; //Recuperar o campo senha
        $user->save();

        //limpa o cache
        Cache::forget('user');

        //verifica se o usuário já concordou com os termos de uso
        if ($user->termos == 0) 
        {
            return redirect()->route('users.termocriar',$user->id);
        }
        else
        {
            toast()->success('atualizado com sucesso!', 'Usuário');
            return redirect()->route('home');
        }
        
    }
    //bloquear usuário
    public function block($id, LogBloqueio $logBlock)
    {
        //bloqueio de usuário
        $user = User::findOrFail($id);
        $user->block = 1;
        $user->save();

        //limpa o cache
        Cache::forget('user');

        //pegar o RG de quem está bloqueando
        $id = Auth::id();
        $rg_block = User::where('id','=', $id)->get()->first();

        //salvar LOG
        $logBlock->acao = 'bloqueio';
        $logBlock->rg_acao = $rg_block->rg;
        $logBlock->rg_block = $user->rg;
        $logBlock->ip = $_SERVER["REMOTE_ADDR"];
        $logBlock->save();

        //mensagens
        toast()->warning('bloqueado!', 'Usuário');

        return redirect()->route('users.index');
    }
    //desbloquear usuário
    public function unblock($id, LogAcesso $logacesso, LogBloqueio $logBlock)
    {
        //desbloqueio usuário
        $user = User::findOrFail($id);
        $user->block = 0;
        $user->save();

        //limpa o cache
        Cache::forget('user');

        /*
        *insere log de acesso com ip = 'desbloqueio' 
        *para que não seja barrado na validação do tempo de inatividade
        */
        $logacesso->rg = $user->rg;
        $logacesso->nome = $user->nome;
        $logacesso->tipo = 'desbloqueio';
        $logacesso->created_at = \Carbon\Carbon::now();
        $logacesso->ip = 'desbloqueio';
        $logacesso->save();

        //pegar o RG de quem está bloqueando
        $id = Auth::id();
        $rg_block = User::where('id','=', $id)->get()->first();

        //salvar LOG
        $logBlock->acao = 'desbloqueio';
        $logBlock->rg_acao = $rg_block->rg;
        $logBlock->rg_block = $user->rg;
        $logBlock->ip = $_SERVER["REMOTE_ADDR"];
        $logBlock->save();

        //mensagens
        toast()->success('desbloqueado!', 'Usuário');

        return redirect()->route('users.index');
    }

    public function termocriar($id)
    {
        $user = User::findOrFail($id);

        return view('administracao.usuarios.termocriar', compact('user'));
    }

    public function termosalvar($id, Request $request)
    {
        //Validação
        $this->validate($request, [
            'termos' =>'required'
        ]);
        $user = User::findOrFail($id);
        $user->termos = $request->termos;
        $user->save();

        return redirect()->route('home');
    }

    public function manual()
    {
        return 'manual do usuario';
    }
}
