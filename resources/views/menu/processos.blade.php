<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-file-text-o "></i>
        <span>Processos</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">     
        @hasrole('admin')
        <li class="">
            <a href="{{route('adl.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>ADL</span>
            </a>
        </li>
        @endrole
        @hasrole('admin')
        @hasrole('admin')
        <li class="">
            <a href="{{route('cd.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>CD</span>
            </a>
        </li>
        @endrole
        @hasrole('admin')
        <li class="">
            <a href="{{route('cj.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>CJ</span>
            </a>
        </li>
        @endrole
        <li class="">
            <a href="{{route('fatd.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>FATD</span>
            </a>
        </li>
        @endrole
        @hasrole('admin')
        <li class="">
            <a href="{{route('pad.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>PAD</span>
            </a>
        </li>
        @endrole
    </ul>
</li>