<!-- Messagens-->
<!-- <v-messages></v-messages>
<v-notifications></v-notifications>
<v-tasks></v-tasks> -->

<li>
    <?php if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') &&
    version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<')): ?> <a
        href="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>">
        <i class="fa fa-fw fa-power-off"></i> <?php echo e(config('adminlte.log_out')); ?>

        </a>
        <?php else: ?>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-power-off"></i> <?php echo e(config('adminlte.log_out')); ?>

        </a>
        <form id="logout-form" action="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>" method="POST"
            style="display: none;">
            <?php if(config('adminlte.logout_method')): ?>
            <?php echo e(method_field(config('adminlte.logout_method'))); ?>

            <?php endif; ?>
            <?php echo e(csrf_field()); ?>

        </form>
        <?php endif; ?>
</li>