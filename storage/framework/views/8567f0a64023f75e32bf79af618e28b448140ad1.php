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

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-rg', 'RG do presidente'); ?> <br>
        <?php echo Form::text('presidente-rg',$presidente['rg'],
        ['onblur' => "completaDados($(this).val(),'presidente-nome','presidente-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-nome', 'Nome do presidente'); ?> <br>
        <?php echo Form::text('presidente-nome',$presidente['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('presidente-posto',$presidente['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-rg', 'RG do escrivao'); ?> <br>
        <?php echo Form::text('escrivao-rg',$escrivao['rg'],
        ['onblur' => "completaDados($(this).val(),'escrivao-nome','escrivao-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-nome', 'Nome do escrivao'); ?> <br>
        <?php echo Form::text('escrivao-nome',$escrivao['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('escrivao-posto',$escrivao['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-rg', 'RG do defensor'); ?> <br>
        <?php echo Form::text('defensor-rg',$defensor['rg'],
        ['onblur' => "completaDados($(this).val(),'defensor-nome','defensor-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-nome', 'Nome do defensor'); ?> <br>
        <?php echo Form::text('defensor-nome',$defensor['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('defensor-posto',$defensor['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    </div>
</div>
    
    