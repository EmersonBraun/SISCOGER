@extends('adminlte::page')

@section('title_postfix', '| LOG Reintegrados')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fa fa-bug"> LOG Reintegrados</i></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">LOG Reintegrados</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div class="col-lg-12 ">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RG</th>
                    <th>Descrição</th>
                    <th>Propriedades</th>
                    <th>Data/hora</th>
                </tr>
            </thead>
            <tbody>
               @forelse ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->log_name }}</td>
                    <td>{{ $log->description }}</td>
                    <td>
                    @foreach(json_decode($log->properties, true) as $key => $value)
                        {{ $key }} - {{ $value }}, 
                    @endforeach    
                    </td>              
                    <td>{{date( 'd/m/Y-h:i:s' , strtotime($log->created_at))}}</td>                                     
                </tr>
                @empty
                <tr>
                  <td>Não há registros ainda</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
              <tr>
                  <th>#</th>
                  <th>RG</th>
                  <th>Descrição</th>
                  <th>Propriedades</th>
                  <th>Data/hora</th>
              </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  @include('vendor.adminlte.includes.tabelas')
@stop