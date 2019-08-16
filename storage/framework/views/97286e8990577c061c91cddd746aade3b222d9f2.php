<?php $__env->startSection('title_postfix', '| Dasboard'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
    <?php if($nome_unidade != ''): ?>OPM/OBM: <?php echo e($nome_unidade); ?> <?php endif; ?>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content nopadding">
    
    <div class="row"><!-- Info box -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='FATD' icon='balance-scale' :value='<?php echo e($totais_proc['fatd'] ?? 0); ?>' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='IPM' icon='institution' bg='green' :value='<?php echo e($totais_proc['ipm'] ?? 0); ?>' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='Sindicância' icon='search' bg="yellow" :value='<?php echo e($totais_proc['sindicancia'] ?? 0); ?>' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='CD' icon='gavel' bg='red' :value='<?php echo e($totais_proc['cd'] ?? 0); ?>' ></v-info-box>
        </div>
    </div><!-- /Info boxes -->
    <div class="row"><!-- Info box -->
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'Transferências', 'qtd' => count($pendencias['transferidos']) ]); ?>
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

                    <?php $__empty_1 = true; $__currentLoopData = $pendencias['transferidos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transferido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(route('fdi.show',$transferido['rg'])); ?>" target="_blanck"><?php echo e($transferido['rg']); ?></a></td>
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
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'Comportamento', 'qtd' => $totais['comportamento']]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>RG</th>
                        <th>Comportamento</th>
                        <th>Tempo</th>
                        <th>OPM</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['comportamentos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comportamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo_em_anos'] >= 1 &&
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo_em_anos'] <= 2 ||
                    $comportamento['comportamento']=='Insuficiente' && $comportamento['tempo_em_anos']>= 2 &&
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo_em_anos'] <= 3 ||
                    $comportamento['comportamento']=='Bom' && $comportamento['tempo_em_anos']>= 5 &&
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo_em_anos'] <= 6 ||
                    $comportamento['comportamento']=='Ótimo' && $comportamento['tempo_em_anos']>= 4 &&
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo_em_anos'] <= 5 ): ?> 
                    <tr>
                        <td>
                            <a href="<?php echo e(route('fdi.show',$comportamento['rg'])); ?>" target="_blanck">
                                <?php echo e($comportamento['rg']); ?>

                            </a>
                        </td>
                        <td>
                            <span <?php switch($comportamento['comportamento']): case ('Mau'): ?> class='label label-error'
                                <?php break; ?> <?php case ('Insuficiente'): ?> class='label label-danger' <?php break; ?> <?php case ('Bom'): ?>
                                class='label label-default' <?php break; ?> <?php case ('Ótimo'): ?> class='label label-info' <?php break; ?>
                                <?php case ('Excepcional'): ?> class='label label-success' <?php break; ?> <?php default: ?>
                                class='label label-default' <?php endswitch; ?>><?php echo e($comportamento['comportamento']); ?>

                            </span>
                        </td>
                        <td><?php echo e($comportamento['tempo_em_anos']); ?></td>
                        <td><?php echo e($comportamento['cdopm']); ?></td>
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
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - DATA DE ABERTURA', 'qtd' => $totais['fatd_abertura']]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['fatd_aberturas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a><?php echo e($fatd_abertura['sjd_ref']); ?>/<?php echo e($fatd_abertura['sjd_ref_ano']); ?></a></td>
                        <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                        <td>
                            <span>
                                <?php if(hasPermissionTo('ver-fatd')): ?>
                                <a class="btn btn-secondary" href="<?php echo e(route('fatd.show',['ref' => $fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])); ?>" target="_black">
                                    <i class="fa fa-fw fa-eye "></i></a>
                                <?php endif; ?>
                                <?php if(hasPermissionTo('editar-fatd')): ?> 
                                <a class="btn btn-info"
                                    href="<?php echo e(route('fatd.edit',['ref' => $fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])); ?>" target="_blanck"><i
                                        class="fa fa-fw fa-edit "></i></a>
                                <?php endif; ?>
                            </span>
                        </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - PRAZOS', 'qtd' => $totais['fatd_prazo'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['fatd_prazos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><a href="<?php echo e(route('fatd.edit',['ref' =>$fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])); ?>"
                            target="_blank"><?php echo e($fatd_prazo['sjd_ref']); ?>/<?php echo e($fatd_prazo['sjd_ref_ano']); ?></a> </td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-fatd')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('fatd.show',['ref' => $fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-fatd')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('fatd.edit',['ref' => $fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'FATD - PUNIÇÃO', 'qtd' => $totais['fatd_punicao'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Posto/grad.</th>
                        <th>Nome</th>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['fatd_punidos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_punido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($fatd_punido['cargo']); ?></td>
                    <td><a href="<?php echo e(route('fdi.show',$fatd_punido['rg'])); ?>" target="_blanck"><?php echo e(special_ucwords($fatd_punido['nome'])); ?></a></td>
                    <td><?php echo e($fatd_punido['sjd_ref']); ?>/<?php echo e($fatd_punido['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>punição não foi cadastrada.</span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-fatd')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('fatd.show',['ref' => $fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-fatd')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('fatd.edit',['ref' => $fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'IPM - DATA DE INSTAURAÇÃO', 'qtd' => $totais['ipm_abertura'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>IPM ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['ipm_aberturas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($ipm_abertura['sjd_ref']); ?>/<?php echo e($ipm_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-ipm')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('ipm.show',['ref' => $ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-ipm')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('ipm.edit',['ref' => $ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'IPM - PRAZOS', 'qtd' => $totais['ipm_prazo'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>IPM ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['ipm_prazos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($ipm_prazo['sjd_ref']); ?>/<?php echo e($ipm_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-ipm')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('ipm.show',['ref' => $ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-ipm')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('ipm.edit',['ref' => $ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - DATA DE ABERTURA', 'qtd' => $totais['sindicancia_abertura'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['sindicancia_aberturas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($sindicancia_abertura['sjd_ref']); ?>/<?php echo e($sindicancia_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-sindicancia')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('sindicancia.show',['ref' => $sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-sindicancia')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('sindicancia.edit',['ref' => $sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - PRAZOS', 'qtd' => $totais['sindicancia_prazo'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['sindicancia_prazos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($sindicancia_prazo['sjd_ref']); ?>/<?php echo e($sindicancia_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-sindicancia')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('sindicancia.show',['ref' => $sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-sindicancia')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('sindicancia.edit',['ref' => $sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - DATA DE ABERTURA', 'qtd' => $totais['cd_abertura'] ]); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['cd_aberturas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($cd_abertura['sjd_ref']); ?>/<?php echo e($cd_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-cd')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('cd.show',['ref' => $cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-cd')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('cd.edit',['ref' => $cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?php $__env->startComponent('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - PRAZOS', 'qtd' => $totais['cd_prazo'], 'md' => '12', 'lg' => '12']); ?>
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $pendencias['cd_prazos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($cd_prazo['sjd_ref']); ?>/<?php echo e($cd_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            <?php if(hasPermissionTo('ver-cd')): ?>
                            <a class="btn btn-secondary" href="<?php echo e(route('cd.show',['ref' => $cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])); ?>" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            <?php endif; ?>
                            <?php if(hasPermissionTo('editar-cd')): ?> 
                            <a class="btn btn-info"
                                href="<?php echo e(route('cd.edit',['ref' => $cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])); ?>" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <?php endif; ?>
                        </span>
                    </td>
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
        <div class="col-md-6 col-xs-12">
            <efetivo-chart :efetivo="<?php echo e(json_encode($efetivo)); ?>"></efetivo-chart>
        </div>
        <div class="col-md-6 col-xs-12">
            <procedimentos-chart :procedimentos="<?php echo e(json_encode($procedimentos)); ?>"></procedimentos-chart>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>