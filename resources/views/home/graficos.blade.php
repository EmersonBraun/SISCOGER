<div class="row"><!-- *************.Gráficos********************* -->
    <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Efetivo OPM/OBM</h3>
        </div>
        <div class="box-body" style="width:75%;">
            @include('vendor.adminlte.includes.graficos')
            {!! $efetivo_chartjs->render() !!}
            <div class="d-flex flex-row">
                <div class="p-6"><strong>Total efetivo: {{$total_efetivo->qtd}}</strong></div>
                <div class="p-6">Fonte: RHPARANA - data {{date('d/m/Y')}}</div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row"><!-- *************.Gráficos********************* -->
    <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Quantitativo procedimetos por ano</h3>
        </div>
        <div class="box-body" style="width:75%;">
            @include('vendor.adminlte.includes.graficos')
            {!! $chartjs->render() !!}
            <div class="d-flex flex-row">
                <div class="p-6">Fonte: Banco de dados SISCOGER - data {{date('d/m/Y')}}</div>       
            <div>         
        </div>
    </div>
</div>
</div>