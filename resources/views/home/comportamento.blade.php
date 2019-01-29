<div class="col-md-6 col-xs-12">
    <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">Comportamento</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Comportamento</th>
                    <th>Tempo</th>
                </tr>
            </thead>
            @forelse($comportamentos as $comportamento)
            
                @if(
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] >= 1 &&
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] <= 2 || 
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] >= 2 &&
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] <= 3 || 
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] >= 5 &&
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] <= 6 || 
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] >= 4 &&
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] <= 5
                    )
                    <tr>
                        <td><a href="{{route('fdi.show',$comportamento['rg'])}}" target="_blanck">
                            {{$comportamento['rg']}}
                            </a></td>
                        <td><span 
                        @switch($comportamento['comportamento'])
                            @case('Mau')
                                class='label label-error'
                                @break
                            @case('Insuficiente')
                                class='label label-danger'
                                @break
                            @case('Bom')
                                class='label label-default'
                                @break
                            @case('Ótimo')
                                class='label label-info'
                                @break
                            @case('Excepcional')
                                class='label label-success'
                                @break
                            @default
                                class='label label-default'
                        @endswitch
                        
                        >{{$comportamento['comportamento']}}</span></td>
                        <td><span class='label label-success'>{{$comportamento['tempo']}}</span></td>
                    </tr>
                @endif
                @empty
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                
            @endforelse
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
        <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
    </div>
    <!-- /.box-footer -->
    </div>
</div>