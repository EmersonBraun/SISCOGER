<section class="content-header nopadding">  
    <h1><i class="fa fa-key"></i> Gerenciamento de permissões - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permissões - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-10 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('permission.index')}}">Listar Permissões</a>
            <a class="btn @if($page == 'treeview') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('permission.treeview')}}">Árvore Permissões</a>
            @if(hasPermissionTo('listar-usuarios'))
            <a class="btn btn-default col-md-3 col-xs-3" href="{{route('user.index')}}">Listar Usuários</a>
            @endif
            @if(hasPermissionTo('listar-papeis'))
            <a class="btn btn-default col-md-3 col-xs-3" href="{{route('role.index')}}">Listar Papéis</a>
            @endif
        </div>
        @if(hasPermissionTo('criar-permissoes'))
        <div class='col-md-2 col-xs-12 litlepadding'>
            <a href="{{ route('permission.create') }}" class="btn btn-success btn-block">
                <i class="fa fa-plus "></i> Adicionar Permissões</a>
        </div>
        @endif
    <div>
</section>
