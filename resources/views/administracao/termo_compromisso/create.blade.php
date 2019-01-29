@extends('adminlte::master')

@section('title_postfix', '| Termo de compromisso')

@include('administracao.termo_compromisso.termo')

{{ Form::open(array('route' => array('terms.store'), 'method' => 'POST')) }}

<div class="form-group">
<div class='col-md-3'>
    <br>
   {{ Form::checkbox('termos',  '1' ) }} 
   {{ Form::label('termos', 'Concordo com os termos') }}
</div>
<div class='col-md-9'>
    <br>
    {{ Form::submit('Inserir', array('class' => ' form-control btn btn-primary')) }}
</div> 

</div>   

{{ Form::close() }}

@section('css')
@stop

@section('js')
<script type="text/javascript">
$('body').scrollspy({ target: '#list-example' })
    $('[data-spy="scroll"]').each(function () {
  var $spy = $(this).scrollspy('refresh')
})
</script>
@stop