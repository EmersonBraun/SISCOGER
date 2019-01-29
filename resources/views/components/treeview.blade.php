<h1>{{ $title }}</h1>
<ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>

  @forelse ($opts as $o)
    <li class="{{ $o['type'] ?? '' }}">
        <a href="{{route($o['route'])}}">
            {{$o['name']}}
        </a>
    </li>
  @empty
    <li class="active">{{$title}}</li>
  @endforelse

</ol>
<br>