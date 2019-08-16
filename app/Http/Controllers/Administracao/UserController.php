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

class UserController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //buscar dados do cache
        //$users = Cache::remember('user', 60, function(){
            $users =  User::all();
        //});
        
        return view('administracao.usuarios.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('administracao.usuarios.create', compact('roles'));
    }

    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'rg'=>'required|unique:users|min:6',
            'roles' =>'required'
        ]);
        
        $pm = DB::connection('rhparana')->table('policial')->where('rg',$request->rg)->first();
        
        if (!$pm) 
        {
            toast()->warning('esse RG não existe no Meta4!', 'ERRO!');
            return redirect()->route('user.index');
        }
        
        $create = $this->createUser($pm, $request);
        
        if($create) {
            if (isset($request['roles'])) $this->assignRole($request['roles'],$user); 
                
            Cache::forget('user');
    
            toast()->success('adicionado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }
        
        toast()->warning('problema ao adicionar!', 'Usuário');
        return redirect()->route('user.index');
    }

    public function createUser($pm, $request)
    {
        $user = [
            'rg' => $request->rg,
            'nome' => $pm->NOME,
            'email' => $pm->EMAIL_META4,
            'classe' => $pm->CLASSE,
            'cargo' => $pm->CARGO, //graduação
            'quadro' => $pm->QUADRO,
            'subquadro' => $pm->SUBQUADRO,
            'opm_descricao' => $pm->OPM_DESCRICAO, //nome unidade
            'cdopm' => $pm->CDOPM, //código da unidade
            'password' => bcrypt($request->rg)//atribuir senha provisória
        ];

        $create = User::create($user);
        if($create) return $create;
        return false;
    }

    public function assignRole($roles, $user) 
    {
        foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();  
            //Atribuindo papel ao usuário    
            $user->assignRole($role_r); 
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(); 

        return view('administracao.usuarios.edit', compact('user', 'roles')); 
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        
        $user = User::findOrFail($id);
        $input = $request->only(['rg', 'email']); //Recupere os campos rg, email
        $update = $user->fill($input)->save();
        
        if($update) {
            Cache::forget('user');
            if (isset($request['roles'])) $user->roles()->sync($request['roles']);  //If one or more role is selected associate user to roles                 
            else  $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
    
            toast()->success('atualizado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }

        toast()->warning('Erro ao atualizar','Usuário');
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $destroy = User::findOrFail($id)->delete();
        if($destroy) {
            toast()->success('apagado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }

        toast()->warning('não apagado', 'Usuário');
        return redirect()->route('user.index');

    }

    //formulário para atualizar senha
    public function passedit($id)
    {
        $user = User::findOrFail($id);
        if ($user->termos == 0) return view('administracao.usuarios.reset', compact('user'));
        return view('administracao.usuarios.pass', compact('user'));  


    }
    //atualizar a senha
    public function passupdate($id, Request $request)
    { 
        $this->validate($request, [
            'password'=>'required|min:6|confirmed'
        ]);
        
        $user = User::findOrFail($id);
        $data = ['password' => bcrypt($request['password'])];
        $passupdate = $user->update($data);  
        if($passupdate) {
            Cache::forget('user');
            toast()->success('atualizado com sucesso!', 'Usuário');
            $this->hasTerm($user);
            return redirect()->route('home');
        }

        //verifica se o usuário já concordou com os termos de uso
        toast()->warning('atualizado com sucesso!', 'Usuário');
        $this->hasTerm($user);
        return redirect()->route('home');
        
    }
    //bloquear usuário
    public function block($id)
    {
        $user = User::findOrFail($id);

        if(!$user->hasRole('admin')) 
        {
            $block = $user->update(['block' => 0]);
            if($block) {
                Cache::forget('user');
                $this->logBlock($user);

                toast()->success('bloqueado!', 'Usuário');
                return redirect()->back();
            }

            toast()->warning('Não bloqueado!', 'Usuário');
            return redirect()->back();
        }

        toast()->warning('Não pode ser bloqueado!', 'Usuário Administrador');
        return redirect()->back();
    }

    public function unblock($id, LogBloqueio $logBlock)
    {
        //desbloqueio usuário
        $user = User::findOrFail($id);
        $unblock = $user->update(['block' => 0]);

        if(unblock) {
            Cache::forget('user');
            $this->logAcesso($user);
            $this->logBlock($user);
            toast()->success('desbloqueado!', 'Usuário');
            return redirect()->back();
        }
        //mensagens
        toast()->warning('não desbloqueado!', 'Usuário');
        return redirect()->back();
    }

    public function logAcesso($user) {
        /*insere log de acesso com ip = 'desbloqueio' para que não seja barrado na validação do tempo de inatividade*/
        $logacesso = [
            'rg' => $user->rg,
            'nome' => $user->nome,
            'tipo' => 'desbloqueio',
            'created_at' => \Carbon\Carbon::now(),
            'ip' => 'desbloqueio' 
        ];
        $create = LogAcesso::create($logacesso); 
        if($create) return true;
        return false;
    }

    public function logBlock($user) {
        //pegar o RG de quem está bloqueando
        $rg_block = User::where('id','=', Auth::id())->get()->first();
        /*insere log de acesso com ip = 'desbloqueio' para que não seja barrado na validação do tempo de inatividade*/
        $logBlock = [
            'acao' => 'desbloqueio',
            'rg_acao' => $rg_block->rg,
            'rg_block' => $user->rg,
            'ip' => $_SERVER["REMOTE_ADDR"],
        ];
        $create = LogBloqueio::create($logBlock); 
        if($create) return true;
        return false;
    }

    public function hasTerm($user) 
    {
        if ($user->termos == 0) return redirect()->route('termo.create',$user->id);
        return true;
    }

    public function termocriar($id)
    {
        $user = User::findOrFail($id);
        return view('administracao.termo.criar', compact('user'));
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
