<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-question-circle "></i>
    <span>Ajuda</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        <li class="">
            <a href="{{route('users.manual')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Manual do usuário</span>
            </a>
        </li>
        <li class="">
            <a href="{{route('users.pass',Auth::id())}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Modificar senha</span>
            </a>
        </li>
        <li class="">
            <a href="{{route('it.documentacao')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Documentação para IT</span>
            </a>
        </li>
    </ul>
</li>