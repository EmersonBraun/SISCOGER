<div class='col-md-3 col-xs-12'>
    <h4 class="box-title">{{$tipo ?? 'Acusado'}}</h4>
    <table>
        <thead>
            <tr>
                <td style="display: none">Índice</td>
                <td>RG</td>
                <td>Nome</td>
                <td>Posto/Graduação</td>
                <td>Situação</td>
            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <td class="{{$indice}}">{!! Form::text('rg','',['onblur' => "completaDados($(this).val(),'nome','posto','#',$(this).parent().attr('class'))"]) !!}</td>
                <td class="{{$indice}}">{!! Form::text('nome','',['readonly','id' => 'nome']) !!}</td>
                <td class="{{$indice}}">{!! Form::text('posto','',['readonly','id' => 'posto']) !!}</td>
                <td class="{{$indice}}"> {!! Form::select('resultado',$opts,'') !!}</td>
                <td class="{{$indice}}">
                    <div class="btn-group">  
                        <a class="btn btn-danger" 
                        href="#"
                        onclick="$(this).closest('tr').remove()">
                            <i class="fa fa-fw fa-trash "></i>
                        </a>
                    </div>
                    <br>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <button><i class="fa fa-plus">Adicionar</i></button>
        </tfoot>
    </table> 

</div>
    