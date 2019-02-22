<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Novo Sobrestamento</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

                <div class="col-md-12 col-xs-12">
                    {!! Form::open(['url' => route('sobrestamento.inserir',['id' => $proc['id_'.$name]] ) ]) !!}
                
                    <input type="hidden" name="proc" value="{{strtoupper($name)}}">
                    <input type="hidden" name="rg" value="{{session('rg')}}">

                <div class='divmotivo col-md-12 col-xs-12 form-group @if ($errors->has('motivo')) has-error @endif'>
                    {!! Form::label('motivo', 'Motivo: ')!!}
                    {!! Form::select('motivo', config('sistema.motivoSobrestamento'),null, ['class' => 'form-control  inputmotivo','required','onchange' => 'outrosMotivos()']) !!}
                    @if ($errors->has('motivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('motivo') }}</strong>
                        </span>
                    @endif 
                </div>
                <div class='divoutros col-md-6 col-xs-12 form-group' style="display:none">
                    {!! Form::label('motivo_outros', 'Descrição: ')!!}
                    {!! Form::text('motivo_outros','' ,['class' => 'form-control inputoutros']) !!}
                </div>
                
                <div class='col-md-4 col-xs-12 form-group @if ($errors->has('inicio_data')) has-error @endif'>
                    <i class="fa fa-calendar"></i> {!! Form::label('inicio_data', 'Data de início: ')!!}
                    {!! Form::text('inicio_data','' ,['class' => 'form-control datepicker']) !!}
                    @if ($errors->has('inicio_data'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inicio_data') }}</strong>
                        </span>
                    @endif 
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    {!! Form::label('publicacao_inicio', 'Publicação de início: ')!!}
                    {!! Form::text('publicacao_inicio','' ,['class' => 'form-control']) !!}
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    {!! Form::label('doc_controle_inicio', 'N° Documento: ')!!}
                    {!! Form::text('doc_controle_inicio','' ,['class' => 'form-control']) !!}
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <i class="fa fa-calendar"></i> {!! Form::label('termino_data', 'Data de término: ')!!}
                    {!! Form::text('termino_data','' ,['class' => 'form-control datepicker']) !!}
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    {!! Form::label('publicacao_termino', 'Publicação de término: ')!!}
                    {!! Form::text('publicacao_termino','' ,['class' => 'form-control']) !!}
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    {!! Form::label('doc_controle_termino', 'N° Documento: ')!!}
                    {!! Form::text('doc_controle_termino','' ,['class' => 'form-control']) !!}
                </div>
        
                {!! Form::submit('Inserir Sobrestamento',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
                </div>
  
            </div>
        </div>
    </div>
</div>
