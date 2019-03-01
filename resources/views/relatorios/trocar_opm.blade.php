@extends('adminlte::page')

@section('title', 'Mudar OPM')

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
                    <div class="col-lg-12 col-md-12 col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
                        {!! Form::label('opm', 'OPM') !!}
                        {{ Form::select('opm', $opms, session('cdopm'), ['class'=>'form-control select2 ', 'id' => 'opm']) }}                
                        @if ($errors->has('opm'))
                            <span class="help-block">
                                <strong>{{ $errors->first('opm') }}</strong>
                            </span>
                        @endif
                    </div>
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
@include('vendor.adminlte.includes.select2')
  {{-- 'onclick' => 'javascript:location.href={{route('home',['opm' => 'opm'])}}'   --}}
<script>
$(document).ready( function() {
    $('#opm').on('change',function () {
        var codigo = $(this).val();
        // console.log(corta_zeros(codigo));
        $(location).attr("href", '/siscoger/home/' + codigo);
    });
});
</script>
@stop

