<?php

namespace App\Http\Controllers\Acl;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//usar flash messaging
use Session;
use Illuminate\Support\Facades\DB;

use App\Models\rhparana\Policial;

class UserController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('vendor.administracao.usuarios.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('vendor.administracao.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //Validação
        $this->validate($request, [
            'rg'=>'required|min:6',
            'roles' =>'required'
        ]);
        //pegar o email do policial
        $email = Policial::where('rg',$request->rg)->value('EMAIL_META4');
        $request['email'] = $email;
        //atribuir senha provisória
        $request['password'] = $request->rg;
        //dd($request);

        $user = User::create($request->only('email', 'rg', 'password')); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();
            //dd($role_r);            
            $user->assignRole($role_r); //Assigning role to user
            }
        }        
    //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message',
             'Usuário adicionado com sucesso!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(); 

        return view('vendor.administracao.usuarios.edit', compact('user', 'roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);   
        $this->validate($request, [
            'rg'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);

        $input = $request->only(['rg', 'email', 'password']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with('flash_message',
             'Usuário atualizado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')->with('flash_message',
             'User apagado com sucesso!');
    }
}
