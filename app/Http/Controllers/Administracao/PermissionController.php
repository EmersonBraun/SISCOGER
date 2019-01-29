<?php
 
namespace App\Http\Controllers\Administracao;
use App\Http\Controllers\Controller;
use Auth;

//Importa laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

use Illuminate\Http\Request;
 
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('administracao.permissoes.index',compact('permissions'));
    }
 
    public function create()
    {
        $roles = Role::get()->paginate(10); //pega todos os papeis
        return view('administracao.permissoes.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //Se uma ou mais funções forem selecionadas
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Corresponder função de entrada ao registro db

                $permission = Permission::where('name', '=', $name)->first(); //Combinar entrada //permissão para registro de db
                $r->givePermissionTo($permission);
            }
        }
        toast()->success(''.$permission->name.' adicionadas!', 'Permissões');
        return redirect()->route('permissions.index');
        //return redirect()->route('permissions.create');
    }

    public function show(Permission $permission)
    {
        return redirect('permissions');
    }
 
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('administracao.permissoes.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name'=>'required',
        ]);

        $input = $request->all();
        $permission->fill($input)->save();

        toast()->success(''. $permission->name.' atualizada!', 'Permissões');
        return redirect()->route('permissions.index');
        //return redirect()->route('permissions.create');
    }
 
    public function destroy(Permission $permission, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        
        toast()->success('apagadas com sucesso!', 'Permissões');
        return redirect()->route('permissions.index');
    }
}