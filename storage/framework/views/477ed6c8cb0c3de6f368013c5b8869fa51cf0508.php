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