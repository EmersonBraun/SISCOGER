<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Recursos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_ato_file','Reconsideração de ato (solução): ','fatd',$proc['rec_ato_file']); ?>

    </div>

    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_cmt_file','Recurso CMT OPM','fatd',$proc['rec_cmt_file']); ?>

    </div>

    
    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_crpm_file','Recurso CMT CRPM:','fatd',$proc['rec_crpm_file']); ?>

    </div>

    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_cg_file','Recurso CMT Geral:','fatd',$proc['rec_cg_file']); ?>

    </div>

    </div>
</div>
    
    