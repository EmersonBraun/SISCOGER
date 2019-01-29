<li class="treeview">
     <a href="#">
    <i class="fa fa-fw fa-legal "></i>
    <span>Apresentação em Juízo</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        <li class="">
            <a href="<?php echo e(route('mail.sent')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Emails Agendados</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('notacoger.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Notas COGER</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('apresentacao.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Lista apresentações</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('apresentacao.buscar')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Buscar Apresentação</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('locais.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Locais</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('excel.create')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>inserir via Excel</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('memorando.create')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Gerar Memorando</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo e(route('unidades.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Dados Unidade</span>
            </a>
        </li>
    </ul>
</li>