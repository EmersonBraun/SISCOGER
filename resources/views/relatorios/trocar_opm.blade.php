@extends('adminlte::page')

@section('title', 'fatd - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Mudar OPM - Dashboard</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Mudar OPM - Dashboard</li>
  </ol>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <!-- /.box-header -->

                <div class='col-md-12 col-xs-12'>
                        <h1>Vue Select - Ajax</h1>
                        <v-select2 label="name" :filterable="false" :options="options" @search="onSearch">
                        </v-select2>
 
                {{-- {!! Form::label('cdopm', 'OPM')!!} 
                {!! Form::select() !!}<br>
                <select class="select2" name="opm">
                <option value=''>Todas as OPM</option>
                @foreach($opms as $opm)

                    @if (trim($opm['CODIGOBASE'])=="") {{$opm['CODIGOBASE']="0"}} @endif

                    @if ($opm['TITULO']=="COMANDO" || $opm['TITULO']=="COMANDO GERAL") 

                        @if ($firstGroup == "false")

                            {{"</optgroup>"}}

                    @endif

                            {{$firstGroup = "true"}}
                            <optgroup LABEL='{{$opm['ABREVIATURA']}}'>
                            <option value='{{$opm['CODIGOBASE']}}' >{{$opm['ABREVIATURA']}} (sede)</option>
                    
                    @endif

                        @if ((isset($cdopm_selected)) && ($opm['CODIGOBASE']==$cdopm_selected)) {{$selected="selected"}}

                        @else {{$selected=""}}

                            <option {{$selected}} value='{{corta_zeros($opm['CODIGO'])}}' >{{$opm['ABREVIATURA']}}</option>

                        @endif

                @endforeach  
                </select> --}}
                </div>

              
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  {{-- route('home.opm',corta_zeros($opm['CODIGO'])) --}}
<script>
$(document).ready( function() {
    $('opm').on('click',function () {
        var codigo = $(this).val();
        console.log(codigo);
        
        //$(location).attr("href", url);
    });
});
</script>
@stop

