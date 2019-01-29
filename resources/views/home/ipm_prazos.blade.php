<div class="col-md-6 col-xs-12">
    <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">IPM - PRAZOS
        @if($tipm_prazos > 0)<span class="badge bg-red">{{$tipm_prazos}}</span>@endif
        </h3>

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
                    <th>IPM ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($ipm_prazos as $ipm_prazo)
            
            <tr>
                <td>{{$ipm_prazo['sjd_ref']}} / {{$ipm_prazo['sjd_ref_ano']}}</td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
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