<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\User;
use Cache;


use Illuminate\Support\Facades\DB;

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
        //$users = Cache::remember($key, $expiration, function(){
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
            $user->password = bcrypt($request->rg);//atribuir senha provisória

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

}
