
<li >
    <div class="row " style="background-color: white">
        
    </div>
</li>
@hasanyrole('admin')
<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-balance-scale "></i>
    <span>Processos e Procedimentos</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    @hasanyrole('admin')
        @include('menu.processos')
    @endhasanyrole
    @hasanyrole('admin')
        @include('menu.procedimentos') 
    @endhasanyrole 
    </ul>
</li>
@endhasanyrole 

@hasrole('admin')
    @include('menu.apresentacao')
@endrole

@hasanyrole('admin')
    @include('menu.relatorios')
@endhasanyrole

@hasanyrole('admin')
    @include('menu.correicoes')
@endhasanyrole

@hasanyrole('admin')
    @include('menu.busca')
@endhasanyrole

@hasanyrole('admin')
    @include('menu.policiais')
@endhasanyrole

@hasrole('sai')
    @include('menu.sai')
@endhasrole

@hasrole('bi')
    @include('menu.bi')
@endhasrole

    @include('menu.ajuda')

@hasanyrole('admin')
    @include('menu.administracao')
@endhasanyrole

@include('menu.historia')

 @hasrole('admin')
    @include('menu.pendencias')
@endhasrole

@hasanyrole('admin|supervisao')
    @include('menu.logs')
@endhasanyrole

