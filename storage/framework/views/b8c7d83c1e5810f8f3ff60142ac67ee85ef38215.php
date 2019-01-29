<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Membros</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('encarregado-rg', 'RG do encarregado'); ?> <br>
        <?php echo Form::text('encarregado-rg',$encarregado['rg'],
        ['onblur' => "completaDados($(this).val(),'encarregado-nome','encarregado-posto')"]); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('encarregado-nome', 'Nome do encarregado'); ?> <br>
        <?php echo Form::text('encarregado-nome',$encarregado['nome'],['readonly']); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('encarregado-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('encarregado-posto',$encarregado['cargo'],['readonly']); ?>

    </div>

    
    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('acusador-rg', 'RG do acusador'); ?> <br>
        <?php echo Form::text('acusador-rg',$acusador['rg'],
        ['onblur' => "completaDados($(this).val(),'acusador-nome','acusador-posto')"]); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('acusador-nome', 'Nome do acusador'); ?> <br>
        <?php echo Form::text('acusador-nome',$acusador['nome'],['readonly']); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('acusador-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('acusador-posto',$acusador['cargo'],['readonly']); ?>

    </div>

    
    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('defensor-rg', 'RG do defensor'); ?> <br>
        <?php echo Form::text('defensor-rg',$defensor['rg'],
        ['onblur' => "completaDados($(this).val(),'defensor-nome','defensor-posto')"]); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('defensor-nome', 'Nome do defensor'); ?> <br>
        <?php echo Form::text('defensor-nome',$defensor['nome'],['readonly']); ?>

    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('defensor-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('defensor-posto',$defensor['cargo'],['readonly']); ?>

    </div>

    </div>
</div>
    
    