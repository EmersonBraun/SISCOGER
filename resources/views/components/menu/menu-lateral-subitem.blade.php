<li class="treeview">
    <a href="#">
    <i class="fa {{$titulo[1] ?? 'fa-circle-o text-green'}}"></i>
    <span>{{$titulo[0]}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>

    <ul class="treeview-menu">
    @foreach ($subitem as $item)
        <li class="">
            <a href="{{route($item[1])}}">
            <i class="fa fa-fw {{$item[2] ?? 'fa-circle-o'}}"></i>
            <span>{{$item[0]}}</span>
            </a>
        </li>
    @endforeach
    </ul>
</li>