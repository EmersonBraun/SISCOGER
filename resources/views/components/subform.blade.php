<div class="col-lg-12 col-md-12 col-xs-12 form-group">
    <h5><b>{{$title}}</b></h5>

    @if(!$unico)
        <a name="doc_origem" class="noprint btn btn-success btn-block" onclick="addObjectForm('{{$arquivo}}','{{$proc}}',{{$unico}});"><i class="fa fa-plus"></i>{{$btn}}</a>
    @endif
    <div class="col-md-{{$tam ?? '12'}} bordaform" id="{{$arquivo}}Form">
        @if (!is_null($relacao))
            @foreach ($relacao as $relacao)
                @include('subform.'.$arquivo)   
            @endforeach
        @endif      
    </div>
</div>