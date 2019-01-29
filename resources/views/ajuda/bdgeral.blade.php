@extends('adminlte::page')

@section('title', 'BD')

@section('content_header')
<section class="content-header">   
  <h1>BD - Lista</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">BD - Lista</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <div class='btn-group col-md-4 col-xs-12 ' style='padding-left: 0px'>  
 
        <select name="meta4">
            @foreach ($meta4 as $m)
                <option onclick="javascript:location.href='{{route('bd',['conn' => 'meta4','nome' => $m, 'limite' => 10])}}'"> {{ $m }} </option>
            @endforeach
        </select>

        <select name="rhparana">
            @foreach ($rhparana as $r)
                <option onclick="javascript:location.href='{{route('bd',['conn' => 'rhparana','nome' => $r, 'limite' => 10])}}'"> {{ $r }} </option>
            @endforeach
        </select>

        <select name="pass">
            @foreach ($pass as $p)
                <option onclick="javascript:location.href='{{route('bd',['conn' => 'pass','nome' => $p, 'limite' => 10])}}'"> {{ $p }} </option>
            @endforeach
        </select>
    </div>
  </div>
  <!-- /.content-wrapper -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 
@stop