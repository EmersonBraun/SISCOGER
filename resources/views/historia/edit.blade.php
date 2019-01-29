<div class="modal fade" id="m-{{$h['id_historia']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel">Editar história</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(array('url' => route('historia.update',$h['id_historia']),'method' => 'put')) }}
            <div class="form-group">
                <label for="titulo" class="col-form-label">Título:</label>
                <input type="text" class="form-control" value="{{$h['titulo']}}" name="titulo">
            </div>
            <div class="form-group">
                <label for="conteudo" class="col-form-label">Conteúdo:</label>
                <textarea class="form-control" name="conteudo">{{$h['conteudo']}}</textarea>
            </div>
            <div class="form-group">
                <label for="rodape" class="col-form-label">Rodapé:</label>
                <textarea class="form-control" name="rodape">{{$h['rodape']}}</textarea>
            </div>
            <div class="form-group">
                <label for="data" class="col-form-label">Data</label>
                <input type="text" class="form-control" value="{{data_br($h['data'])}}" name="data">
                <input type="hidden" class="form-control" value="{{$h['ano']}}" name="ano">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Editar</button>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>