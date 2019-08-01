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

    public function treeview()
    {
        $relateds = Permission::distinct()->orderBy('related')->get(['related']);
        $permissions = [];
        foreach ($relateds as $r) {
            $permissions[$r->related] = Permission::where('related',$r->related)->get(['id','name'])->toArray();
        }
        return view('administracao.permissoes.treeview',compact('permissions'));
    }
 
    public function create()
    {
        $roles = Role::all(); //pega todos os papeis
        return view('administracao.permissoes.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        
        $permission = new Permission();
        $permission->name = $request['name'];

        $create = $permission->save();
        
        if($create) {
            if (!empty($request['roles'])) { //Se uma ou mais funções forem selecionadas
                $this->givePermission($request['roles'], $request['name']);
            }
            toast()->success(''.$permission->name.' adicionadas!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao adicionar!', 'Permissões');
        return redirect()->route('permission.index');
    }
 
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('administracao.permissoes.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
            
        $permission = Permission::findOrFail($id);
        $input = $request->all();
        $update = $permission->fill($input)->save();

        if($update) {
            toast()->success(''. $permission->name.' atualizada!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao atualizar!', 'Permissões');
        return redirect()->route('permission.index');
    }
 
    public function destroy(Permission $permission, $id)
    {
        $destroy = Permission::findOrFail($id)->delete();
        
        if($destroy) {
            toast()->success('apagadas com sucesso!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao apagar!', 'Permissões');
        return redirect()->route('permission.index');
    }

    public function givePermission($roles, $name) 
    {
        foreach ($roles as $role) {
            $r = Role::where('id', '=', $role)->firstOrFail(); //Corresponder função de entrada ao registro db

            $permission = Permission::where('name', '=', $name)->first(); //Combinar entrada //permissão para registro de db
            $r->givePermissionTo($permission);
        }
    }
}