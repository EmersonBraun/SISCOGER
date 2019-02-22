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
                {!! Form::label('cdopm', 'OPM')!!} <br>
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

                            <option {{$selected}} value='{{corta_zeros($opm['CODIGO'])}}' onclick="javascript:location.href='{{route('home.opm',corta_zeros($opm['CODIGO']))}}'">{{$opm['ABREVIATURA']}}</option>

                        @endif

                @endforeach  
                </select>
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
  
<script>
;(function($)
{
    'use strict';
    $(document).ready(function()
    {
    var $fileupload     = $('#fileupload'),
        $upload_success = $('#upload-success');
    $fileupload.fileupload({
        url: '/upload',
        formData: {_token: $fileupload.data('token'), userId: $fileupload.data('userId')},
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        done: function (e, data) {
            $upload_success.removeClass('hide').hide().slideDown('fast');
            setTimeout(function(){
                location.reload();
            }, 2000);
        }
    });
    });
})(window.jQuery);
</script>
@stop

