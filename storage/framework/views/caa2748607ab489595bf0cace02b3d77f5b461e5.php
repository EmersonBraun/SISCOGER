<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Acusado</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    <div class='col-md-3 col-xs-12'>
        <?php echo Form::label('acusado-rg', 'RG do acusado'); ?> <br>
        <?php echo Form::text('acusado-rg',$envolvido['rg'],['onblur' => "completaDados($(this).val(),'acusado-nome','acusado-posto')"]); ?>

    </div>

    <div class='col-md-3 col-xs-12'>
        <?php echo Form::label('acusado-nome', 'Nome do acusado'); ?> <br>
        <?php echo Form::text('acusado-nome',$envolvido['nome'],['readonly']); ?>

    </div>

    <div class='col-md-3 col-xs-12'>
        <?php echo Form::label('acusado-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('acusado-posto',$envolvido['cargo'],['readonly']); ?>

    </div>

    <div class='col-md-3 col-xs-12'>
        <?php echo Form::label('acusado-resultado', 'Situação'); ?> <br>
        <?php echo Form::select('acusado-resultado',[
            'Selecione' => 'Selecione',
            'Punido' => 'Punido', 
            'Absolvido' => 'Absolvido', 
            'Outra Medida' => 'Outra Medida',
            'Anulado' => 'Anulado'
    ],$proc['acusado-resultado']); ?>

    </div>

    </div>
</div>



    
    