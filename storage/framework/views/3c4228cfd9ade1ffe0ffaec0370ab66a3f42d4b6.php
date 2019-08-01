<div class="box">
    <div class="box-header">
        <h2 class="box-title">Dados Principais</h2>       
        <div class="box-tools pull-right">

            <?php switch($pm->STATUS):
                case ('Ativo'): ?>
                    <i class="fa fa-circle text-success"></i>
                    <?php break; ?>
                <?php case ('Inativo'): ?>
                    <i class="fa fa-circle text-warning"></i>
                    <?php break; ?>
                <?php case ('Reserva'): ?>
                    <i class="fa fa-circle text-info"></i>
                    <?php break; ?>   
                <?php default: ?>
            <?php endswitch; ?>

            <?php if($pm->SITUACAO != 'Normal'): ?>
                <strong class="text-danger"><?php echo e($pm->SITUACAO); ?></strong>
            <?php else: ?>
                <strong><?php echo e($pm->STATUS); ?></strong>
            <?php endif; ?>
            
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button> 
        </div>             
    </div>
    <div class="box-body">
        <table class="table table-bordered">

            <tr>
                <td rowspan="4" class="col-md-2">
                    <a href="http://10.47.1.8/sispics/fotos/<?php echo e($pm->RG); ?>.JPG"><img class="img-responsive" src="http://10.47.1.8/sispics/fotos/<?php echo e($pm->RG); ?>.JPG" max-width="190"></a>
                </td>
                <td class="col-md-5">
                    <strong>Nome:</strong><br>
                    <?php echo e($pm->CARGO); ?> <?php echo e($pm->QUADRO); ?><?php if($pm->SUBQUADRO !== 'NA'): ?>-<?php echo e($pm->SUBQUADRO); ?> <?php endif; ?> <?php echo e($pm->NOME); ?> 
                </td>
                <td class="col-md-5">
                    <strong>RG:</strong><br>
                    <?php echo e($pm->RG); ?>

                </td>
            </tr>

            <tr>
                <td>
                    <b>Comportamento atual:</b><br>
                    <?php echo e($pm->comportamento); ?> 
                </td>
                <td>
                    <?php switch($pm->STATUS):
                        case ('Ativo'): ?><b>Data de inclusão:</b><br><?php break; ?>
                        <?php case ('Inativo'): ?><b>Data Inatividade:</b><br><?php break; ?>
                        <?php case ('Reserva'): ?><b>Data Reserva:</b><br><?php break; ?>
                        <?php default: ?><b>Data de inclusão:</b><br>    
                    <?php endswitch; ?>
                    <?php echo e(data_br($pm->ADMISSAO_REAL)); ?> (<?php echo e(tempo_svc($pm->ADMISSAO_REAL)); ?>)<br>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Cidade:</b><br>
                    <?php echo e($pm->CIDADE); ?> 
                    <?php if($pm->STATUS == "Inativo"): ?>
                        - <?php echo e(special_ucwords($pm->END_BAIRRO)); ?>

                    <?php endif; ?>
                    
                </td>
                <td>
                    <b>Data de nascimento: </b><br>
                    <?php echo e(data_br($pm->NASCIMENTO)); ?> (<?php echo e($pm->IDADE); ?> Anos) 
                </td>
            </tr>

            <tr>
                <td>
                    <b>Classificacao Meta4:</b><br>
                    <?php echo e($pm->OPM_DESCRICAO); ?>

                </td>
                <td>
                    <b>Email funcional:</b><br>
                    <?php echo e($pm->EMAIL_META4); ?>

                </td>
            </tr>

            
            <?php if($adc != ""): ?>
            <tr>
                <td colspan="2">
                    <b>CPF:</b><br>
                    <?php echo e($adc->CPF); ?>

                </td>
                <td>
                    <b>Título de eleitor:</b><br>
                    <?php echo e($adc->SBR_NUM_TIT); ?>  Zona: <?php echo e($adc->SBR_ZONA); ?> Seção: <?php echo e($adc->SBR_SECAO); ?>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Nome do pai:</b><br>
                    <?php echo e(special_ucwords($adc->CBR_NAME_FATHER)); ?>

                </td>
                <td>
                    <b>Nome da mãe:</b><br>
                    <?php echo e(special_ucwords($adc->CBR_NAME_MATHER)); ?>

                </td>
            </tr>
            <?php endif; ?>
             
            <?php if($pm->STATUS == "Inativo"): ?>
            <tr>
                <td colspan="2">
                    <b>Endereço:</b><br>
                    <?php echo e(special_ucwords($pm->END_RUA)); ?>, n° <?php echo e($pm->END_NUM); ?> (<?php echo e($pm->END_COMPL); ?>) CEP: <?php echo e($pm->END_CEP); ?>   
                </td> 
                <td>
                    <b>Telefone:</b><br>
                    <?php echo e($pm->FONE); ?>  
                </td>
            </tr>
            <?php endif; ?> 
        </table>
    </div>
</div> 