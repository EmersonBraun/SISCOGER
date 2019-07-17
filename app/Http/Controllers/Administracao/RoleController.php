<?php
 
namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
//Importa laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;
 
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $roles = Role::all();
        return view('administracao.papeis.index',compact('roles'));
    }
 
    public function create()
    {
        $permissions = Permission::paginate(10);//Pegar todas as permissões
        return view('administracao.papeis.create', compact('permissions'));
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            'permissions' =>'required',
            ]
        );

        $dados = $request->all();
        $create = Role::all($dados);

        if($create) {
            $this->savePermissions($request['permissions'],$request->name);

            toast()->success(''. $request->name.' adicionadas!', 'Papéis');
            return redirect()->route('roles.index');
        }

        toast()->warning('Erro ao adicionar', 'Papéis');
        return redirect()->route('roles.index');
    }


    public function edit(Role $role, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('administracao.papeis.edit', compact('role', 'permissions'));
    }
 
    public function update(Request $request, Role $role, $id)
    {
        $this->validate($request, [
            'name'=>'required|max:50|unique:roles,name,'.$id,
        ]);

        $role = Role::findOrFail($id);//Obter papel com o ID fornecido
        $input = $request->except(['permissions']);

        $update = $role->fill($input)->save();
        
        if($update) {
            $this->revokePermission($role);
            if($request['permissions']) $this->savePermissions($request['permissions'], $role->name);
            toast()->success(''. $role->name.' atualizadas!', 'Papéis');
            return redirect()->route('roles.index');
        }

        toast()->warning('Problema em atualizar!', 'Papéis');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role,$id)
    {
        $destroy = Role::findOrFail($id)->delete();

        if($destroy) {
            toast()->success('apagados!', 'Papéis');
            return redirect()->route('roles.index');
        }

        toast()->warning('Problema em apagar!', 'Papéis');
        return redirect()->route('roles.index');
    }

    public function savePermissions($permissions, $name) {
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 

            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }
    }

    public function revokePermission($role) {
        $p_all = Permission::all();//Pega todas as permissões

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remover todas as permissões associadas à função
        }
    }
}