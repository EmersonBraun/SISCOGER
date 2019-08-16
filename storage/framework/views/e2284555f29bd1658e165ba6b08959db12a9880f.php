<?php if(hasAnyPermission([
    'ver-denuncias',
    'ver-outras-denuncias',
    'ver-prisoes',
    'ver-restricoes',
    'ver-sai',
    'ver-mudanca-comportamento',
    'ver-elogios',
    'ver-objeto',
    'ver-membro',
    'ver-apresentacoes',
    'ver-proc-outros',
    'ver-cautelas'
])): ?>
<ul class="nav nav-tabs">
    <?php if(hasPermissionTo('ver-denuncias')): ?>
    <li class="a denuncias "><a href="#denuncias" data-toggle="tab" aria-expanded="true" onclick="mudaTab('denuncias')">Denúncias criminais </a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-outras-denuncias')): ?>
    <li class="a outras_denuncias"><a href="#outras_denuncias" data-toggle="tab" aria-expanded="false" onclick="mudaTab('outras_denuncias')">Outras denúncias </a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-prisoes')): ?>
    <li class="a prisoes"><a href="#prisoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('prisoes')">Prisões <?php if(count($prisoes) > 0): ?> <span class="badge bg-red"><?php echo e(count($prisoes)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-restricoes')): ?>
    <li class="a restricoes"><a href="#restricoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('restricoes')">Restrições <?php if(count($restricoes) > 0): ?> <span class="badge bg-red"><?php echo e(count($restricoes)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-sai')): ?>
    <li class="a sai"><a href="#sai" data-toggle="tab" aria-expanded="false" onclick="mudaTab('sai')">SAI <?php if(count($sai) > 0): ?> <span class="badge bg-red"><?php echo e(count($sai)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasAnyPermission(['ver-mudanca-comportamento','ver-elogios'])): ?>
    <li class="a fdi"><a href="#fdi" data-toggle="tab" aria-expanded="false" onclick="mudaTab('fdi')">FDI <?php if(count($elogios) > 0): ?> <span class="badge bg-blue"><?php echo e(count($elogios)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-objeto')): ?>
    <li class="a objeto"><a href="#objeto" data-toggle="tab" aria-expanded="false" onclick="mudaTab('objeto')">Objeto <?php if(count($objetos) > 0): ?> <span class="badge bg-red"><?php echo e(count($objetos)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-membro')): ?>
    <li class="a membro"><a href="#membro" data-toggle="tab" aria-expanded="false" onclick="mudaTab('membro')">Membro <?php if(count($membros) > 0): ?> <span class="badge bg-red"><?php echo e(count($membros)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-apresentacoes')): ?>
    <li class="a apresentacoes"><a href="#apresentacoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('apresentacoes')">Apresentacões <?php if(count($apresentacoes) > 0): ?> <span class="badge bg-red"><?php echo e(count($apresentacoes)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-proc-outros')): ?>
    <li class="a proc_outros"><a href="#proc_outros" data-toggle="tab" aria-expanded="false" onclick="mudaTab('proc_outros')">Proc. Outros <?php if(count($proc_outros) > 0): ?> <span class="badge bg-red"><?php echo e(count($proc_outros)); ?></span> <?php endif; ?></a></li>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-cautelas')): ?>
    <li class="a cautelas"><a href="#cautelas" data-toggle="tab" aria-expanded="false" onclick="mudaTab('cautelas')">Cautelas</a></li>
    <?php endif; ?>
    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="Os campos poderão ser suprimidos nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i></a></li>
</ul>
<?php endif; ?>