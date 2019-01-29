<button type="button" class="btn btn-secondary" data-container="body" 
data-toggle="popover" data-placement="{{$dir ?? 'bottom'}}" @isset($title) title="{{$title}}" @endisset data-content="{{$text}}">
  {{$btn}}
</button>