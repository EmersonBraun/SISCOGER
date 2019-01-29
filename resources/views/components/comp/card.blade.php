{{-- opções bg: primary, secondary, success, danger, warning, white, light, dark, transparent --}}
<div class="card text-{{$cor ?? 'white'}} bg-{{$bg ?? 'primary'}} border-{{$border ?? 'primary'}} mb-3">
    <div class="card-header">{{$titulo}}</div>
    <div class="card-body">
        <h5 class="card-title">{{$titulo2}}</h5>
        <p class="card-text">{{$text}}</p>
    </div>
    @isset($footer)
    <div class="card-footer bg-{{$bg ?? 'primary'}} border-{{$border ?? 'primary'}}">Footer</div>
    @endisset
</div>