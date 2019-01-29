<div class="row"><!-- ************lista de pendências***************** -->

    <!-- Transferências -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Transferências
            
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
            <i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
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
                <?php if($transferido['opmorigem'] == $unidade || $transferido['opmdestino'] == $unidade): ?>
                <tr>
                    <td><?php echo e($transferido['rg']); ?></td>
                    <td><?php echo e(special_ucwords($transferido['nome'])); ?></td>
                    <td><?php echo e(opm($transferido['opmorigem'])); ?></td>
                    <td><?php echo e(opm($transferido['opmdestino'])); ?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Transferência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
            
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
            
        </div>

    </div>
    <!-- /Transferências -->

    <!-- Comportamento -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Comportamento</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
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
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /Comportamento -->

    <!-- FATD - PUNIÇÃO -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">FATD - PUNIÇÃO
            <?php if($tfatd_punidos > 0): ?><span class="badge bg-red"><?php echo e($tfatd_punidos); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
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
                    <td><?php echo e($fatd_punido['sjd_ref']); ?> / <?php echo e($fatd_punido['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>punição não foi cadastrada.</span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /FATD - PUNIÇÃO -->

    <!-- FATD - PRAZOS -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">FATD - PRAZOS
            <?php if($tfatd_prazos > 0): ?><span class="badge bg-red"><?php echo e($tfatd_prazos); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $fatd_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($fatd_prazo['sjd_ref']); ?> / <?php echo e($fatd_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /FATD - PRAZOS -->

    <!-- FATD - DATA DE ABERTURA -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">FATD - DATA DE ABERTURA
            <?php if($tfatd_aberturas > 0): ?><span class="badge bg-red"><?php echo e($tfatd_aberturas); ?></span><?php endif; ?>
            </h3>
            
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $fatd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fatd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($fatd_abertura['sjd_ref']); ?> / <?php echo e($fatd_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /FATD - DATA DE ABERTURA -->

    <!-- IPM - PRAZOS -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">IPM - PRAZOS
            <?php if($tipm_prazos > 0): ?><span class="badge bg-red"><?php echo e($tipm_prazos); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
           <table class="table no-margin">
                <thead>
                    <tr>
                        <th>IPM ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $ipm_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($ipm_prazo['sjd_ref']); ?> / <?php echo e($ipm_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /IPM - PRAZOS -->

    <!-- IPM - DATA DE INSTAURAÇÃO -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">IPM - DATA DE INSTAURAÇÃO
            <?php if($tipm_aberturas > 0): ?><span class="badge bg-red"><?php echo e($tipm_aberturas); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
           <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $ipm_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipm_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($ipm_abertura['sjd_ref']); ?> / <?php echo e($ipm_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /IPM - DATA DE INSTAURAÇÃO -->

    <!-- SINDICANCIA - DATA DE ABERTURA -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">SINDICÂNCIA - DATA DE ABERTURA
            <?php if($tsindicancia_aberturas > 0): ?><span class="badge bg-red"><?php echo e($tsindicancia_aberturas); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $sindicancia_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($sindicancia_abertura['sjd_ref']); ?> / <?php echo e($sindicancia_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /SINDICANCIA - DATA DE ABERTURA -->

    <!-- SINDICANCIA - PRAZOS -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">SINDICÂNCIA - PRAZOS
            <?php if($tsindicancia_prazos > 0): ?><span class="badge bg-red"><?php echo e($tsindicancia_prazos); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $sindicancia_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($sindicancia_prazo['sjd_ref']); ?> / <?php echo e($sindicancia_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /SINDICANCIA - PRAZOS -->

    <!-- CONSELHOS DE DISCIPLINA - DATA DE ABERTURA -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">CONSELHOS DE DISCIPLINA - DATA DE ABERTURA
            <?php if($tcd_aberturas > 0): ?><span class="badge bg-red"><?php echo e($tcd_aberturas); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $cd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($cd_abertura['sjd_ref']); ?> / <?php echo e($cd_abertura['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
    <!-- /CONSELHOS DE DISCIPLINA - DATA DE ABERTURA -->

    <!-- CONSELHOS DE DISCIPLINA - PRAZO -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">CONSELHOS DE DISCIPLINA - PRAZO
            <?php if($tcd_prazos > 0): ?><span class="badge bg-red"><?php echo e($tcd_prazos); ?></span><?php endif; ?>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <?php $__empty_1 = true; $__currentLoopData = $cd_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <tr>
                    <td><?php echo e($cd_prazo['sjd_ref']); ?> / <?php echo e($cd_prazo['sjd_ref_ano']); ?></td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
            <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
        </div>
        <!-- /.box-footer -->
        </div>

            
    </div>
    <!-- /CONSELHOS DE DISCIPLINA - PRAZO -->


</div><!-- *************/.lista de pendências********************* -->