<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-folder "></i>
    <span>Correições</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        @hasrole('listar-correicao-ordinaria')
        <li class="">
            <a href="{{route('correicao.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Ordinária</span>
            </a>
        </li>
        @endrole
        @hasrole('listar-correicao-extraordinaria')
        <li class="">
            <a href="{{route('correicao.extra.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Extraordinária</span>
            </a>
        </li>
        @endrole
    </ul>
</li>