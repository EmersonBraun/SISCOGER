<?php $__env->startSection('title_postfix', '| Dasboard'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
        <?php if($nome_unidade != ''): ?>OPM/OBM:  <?php echo e($nome_unidade); ?> <?php endif; ?>
    <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content nopadding">
    <div class="row"><!-- ***********Info box FATD*********** -->

        <div class="col-lg-3 col-md-3 col-xs-6">
            
            <?php $__env->startComponent('components.infobox',
            [
                'title' => 'FATD',
                'bg' => 'aqua',
                'icon' => 'balance-scale',
                'value' => $fatd_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ]); ?>   
            <?php echo $__env->renderComponent(); ?>
        </div>
        <!-- \Info box FATD -->
    
        <!-- .Info box IPM -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            <?php $__env->startComponent('components.infobox',
            [
                'title' => 'IPM',
                'bg' => 'green',
                'icon' => 'institution',
                'value' => $ipm_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ]); ?>   
            <?php echo $__env->renderComponent(); ?>
        </div>
        <!-- ./Info box IPM -->
    
        <!-- Info box IPM Sindicância -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            <?php $__env->startComponent('components.infobox',
            [
                'title' => 'Sindicância',
                'bg' => 'yellow',
                'icon' => 'search',
                'value' => $sindicancia_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ]); ?>   
            <?php echo $__env->renderComponent(); ?>
        </div>
        <!-- .Info box IPM Sindicância -->
    
        <!-- ./Info box IPM CD -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            <?php $__env->startComponent('components.infobox',
            [
                'title' => 'CD',
                'bg' => 'red',
                'icon' => 'gavel',
                'value' => $cd_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ]); ?>   
            <?php echo $__env->renderComponent(); ?>
        </div><!-- *********./Info box IPM CD******** -->
    
    </div><!-- /Info boxes -->

    <div class="row">
        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'Transferências', 'qtd' => $ttransferidos]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>OPM Origem</th>
                    <th>OPM Destino</th>
                </tr>
            </thead>
            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $transferidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transferido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
            
            <tr>
                <td><?php echo e($transferido['rg']); ?></td>
                <td><?php echo e(special_ucwords($transferido['nome'])); ?></td>
                <td><?php echo e(opm($transferido['opmorigem'])); ?></td>
                <td><?php echo e(opm($transferido['opmdestino'])); ?></td>
            </tr>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Transferência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'Comportamento', 'qtd' => '']); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Comportamento</th>
                    <th>Tempo</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $comportamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comportamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
                <?php if(
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] >= 1 &&
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] <= 2 || 
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] >= 2 &&
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] <= 3 || 
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] >= 5 &&
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] <= 6 || 
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] >= 4 &&
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] <= 5
                    ): ?>
                    <tr>
                        <td><a href="<?php echo e(route('fdi.show',$comportamento['rg'])); ?>" target="_blanck">
                            <?php echo e($comportamento['rg']); ?>

                            </a></td>
                        <td><span 
                        <?php switch($comportamento['comportamento']):
                            case ('Mau'): ?>
                                class='label label-error'
                                <?php break; ?>
                            <?php case ('Insuficiente'): ?>
                                class='label label-danger'
                                <?php break; ?>
                            <?php case ('Bom'): ?>
                                class='label label-default'
                                <?php break; ?>
                            <?php case ('Ótimo'): ?>
                                class='label label-info'
                                <?php break; ?>
                            <?php case ('Excepcional'): ?>
                                class='label label-success'
                                <?php break; ?>
                            <?php default: ?>
                                class='label label-default'
                        <?php endswitch; ?>
                        
                        ><?php echo e($comportamento['comportamento']); ?></span></td>
                        <td><span class='label label-success'><?php echo e($comportamento['tempo']); ?></span></td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - DATA DE ABERTURA', 'qtd' => $tfatd_aberturas]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $fatd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><a href="<?php echo e(route('fatd.edit',['ref' =>$fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])); ?>" target="_blank"><?php echo e($fatd_abertura['sjd_ref']); ?>/<?php echo e($fatd_abertura['sjd_ref_ano']); ?></a></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - PRAZOS', 'qtd' => $tfatd_prazos]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $fatd_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><a href="<?php echo e(route('fatd.edit',['ref' =>$fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])); ?>" target="_blank"><?php echo e($fatd_prazo['sjd_ref']); ?>/<?php echo e($fatd_prazo['sjd_ref_ano']); ?></a> </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - PUNIÇÃO', 'qtd' => $tfatd_punidos]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Posto/grad.</th>
                    <th>Nome</th>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $fatd_punidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_punido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($fatd_punido['cargo']); ?></td>
                <td><?php echo e(special_ucwords($fatd_punido['nome'])); ?></td>
                <td><a href="<?php echo e(route('fatd.edit',['ref' =>$fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])); ?>" target="_blank"><?php echo e($fatd_punido['sjd_ref']); ?>/<?php echo e($fatd_punido['sjd_ref_ano']); ?></a></td>
                <td><span class='label label-danger'>punição não foi cadastrada.</span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'IPM - DATA DE INSTAURAÇÃO', 'qtd' => $tipm_aberturas]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>IPM ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $ipm_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><a href="<?php echo e(route('ipm.edit',['ref' =>$ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])); ?>" target="_blank"><?php echo e($ipm_abertura['sjd_ref']); ?>/<?php echo e($ipm_abertura['sjd_ref_ano']); ?></a></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'IPM - PRAZOS', 'qtd' => $tipm_prazos]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>IPM ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $ipm_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><a href="<?php echo e(route('ipm.edit',['ref' =>$ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])); ?>" target="_blank">
                    <?php echo e($ipm_prazo['sjd_ref']); ?>/<?php echo e($ipm_prazo['sjd_ref_ano']); ?></a>
                </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - DATA DE ABERTURA', 'qtd' => $tsindicancia_aberturas]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $sindicancia_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td>
                    <a href="<?php echo e(route('sindicancia.edit',['ref' =>$sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])); ?>" target="_blank">
                        <?php echo e($sindicancia_abertura['sjd_ref']); ?>/<?php echo e($sindicancia_abertura['sjd_ref_ano']); ?>

                    </a>
                </td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - PRAZOS', 'qtd' => $tsindicancia_prazos]); ?>
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $sindicancia_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td>
                    <a href="<?php echo e(route('sindicancia.edit',['ref' =>$sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])); ?>" target="_blank">
                        <?php echo e($sindicancia_prazo['sjd_ref']); ?>/<?php echo e($sindicancia_prazo['sjd_ref_ano']); ?>

                    </a>
                </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - DATA DE ABERTURA', 'qtd' => $tcd_aberturas]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $cd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td>
                        <a href="<?php echo e(route('cd.edit',['ref' =>$cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])); ?>" target="_blank">
                            <?php echo e($cd_abertura['sjd_ref']); ?>/<?php echo e($cd_abertura['sjd_ref_ano']); ?>

                        </a>
                    </td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - PRAZOS', 'qtd' => $tcd_prazos]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $cd_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td>
                        <a href="<?php echo e(route('cd.edit',['ref' =>$cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])); ?>" target="_blank">
                            <?php echo e($cd_prazo['sjd_ref']); ?>/<?php echo e($cd_prazo['sjd_ref_ano']); ?>

                        </a>
                    </td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        <?php echo $__env->renderComponent(); ?>
            
    </div>
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Efetivo OPM/OBM</h3>
            </div>
            <div class="box-body" style="width:75%;">
                <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $efetivo_chartjs->render(); ?>

                <div class="d-flex flex-row">
                    <div class="p-6"><strong>Total efetivo: <?php echo e($total_efetivo->qtd); ?></strong></div>
                    <div class="p-6">Fonte: RHPARANA - data <?php echo e(date('d/m/Y')); ?></div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
    
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Quantitativo procedimetos por ano</h3>
            </div>
            <div class="box-body" style="width:75%;">
                <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $chartjs->render(); ?>

                <div class="d-flex flex-row">
                    <div class="p-6">Fonte: Banco de dados SISCOGER - data <?php echo e(date('d/m/Y')); ?></div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>