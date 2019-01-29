<div class="box">
    @if ($title != false)
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>  
    @endif
    
    <div class="box-body">
        {{$slot}}
    </div>

    @isset($footer)
    <div class="box-body">
        {{$footer}}
    </div>  
    @endisset   
</div>