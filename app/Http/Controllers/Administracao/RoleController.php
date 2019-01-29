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

        $role = new Role();
        $role->name = $request->name;
        $permissions = $request['permissions'];
        $role->save();

        //Looping através de permissões selecionadas
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Busca a função recém-criada e atribua a permissão
            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }

        toast()->success(''. $role->name.' adicionadas!', 'Papéis');
        return redirect()->route('roles.index');
    }
 
    public function show($id) {
        return redirect('roles');
    }

    public function edit(Role $role, $id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::all();

        return view('administracao.papeis.edit', compact('role', 'permissions'));
    }
 
    public function update(Request $request, Role $role, $id)
    {
        //dd(\Request::all());
        $role = Role::findOrFail($id);//Obter papel com o ID fornecido
        // Validar nome e campos de permissão
        $this->validate($request, [
            'name'=>'required|max:50|unique:roles,name,'.$id,
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();//Pega todas as permissões

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remover todas as permissões associadas à função
        }
        if($permissions)
        {
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Obter o formulário correspondente // permission in db
                $role->givePermissionTo($p);  //Atribuir permissão para função
            }
        }
        
        toast()->success(''. $role->name.' atualizadas!', 'Papéis');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role,$id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        toast()->success('apagados!', 'Papéis');

        return redirect()->route('roles.index');
    }
}