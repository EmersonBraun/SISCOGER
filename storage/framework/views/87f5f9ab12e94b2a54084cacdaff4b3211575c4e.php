

<!-- Messagens-->
<li class="dropdown messages-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-envelope-o"></i>
  <span class="label label-success">1</span>
</a>
<ul class="dropdown-menu">
  <li class="header">Você tem 1 mensagens</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
      <li><!-- start message -->
        <a href="#">
          <h4>
            Suporte
            <small><i class="fa fa-clock-o"></i> 5 mins</small>
          </h4>
          <p>teste</p>
        </a>
      </li>
      <!-- end message -->
    </ul>
  </li>
  <li class="footer"><a href="#">Ver todas mensagens</a></li>
</ul>
</li>

<!-- Notificações -->
<li class="dropdown notifications-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-bell-o"></i>
  <span class="label label-warning">1</span>
</a>
<ul class="dropdown-menu">
  <li class="header">Você tem 1 notificação</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
      <li>
        <a href="#">
          <i class="fa fa-warning text-yellow"></i> 2 Novos movimentos
        </a>
      </li>
    </ul>
  </li>
  <li class="footer"><a href="#">Ver tudo</a></li>
</ul>
</li>

<!-- Tasks: style can be found in dropdown.less -->
<li class="dropdown tasks-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-flag-o"></i>
  <span class="label label-danger">9</span>
</a>
<ul class="dropdown-menu">
    <li class="header">Você tem 9 processos/procedimentos</li>
      <li>
        <!-- inner menu: contains the actual data -->
        <ul class="menu">
          <li><!-- Task item -->
            <a href="#">
              <h3>
                IT - 15/2019
                <small class="pull-right">20%</small>
              </h3>
              <div class="progress xs">
                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">20% do prazo</span>
                </div>
              </div>
            </a>
          </li>
          <!-- end task item -->
          <li><!-- Task item -->
            <a href="#">
              <h3>
                ADL - 42/2019
                <small class="pull-right">40%</small>
              </h3>
              <div class="progress xs">
                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">40% do prazo</span>
                </div>
              </div>
            </a>
          </li>
          <!-- end task item -->
          <li><!-- Task item -->
            <a href="#">
              <h3>
                FATD - 14/2019
                <small class="pull-right">80%</small>
              </h3>
              <div class="progress xs">
                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">80% do prazo</span>
                </div>
              </div>
            </a>
          </li>
          <!-- end task item -->
        </ul>
      </li>
      <li class="footer">
        <a href="#">Visualizar tudo</a>
    </li>
</ul>
    </li>
    
    <li>
    <?php if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<')): ?>
        <a href="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>">
            <i class="fa fa-fw fa-power-off"></i> <?php echo e(config('adminlte.log_out')); ?>

        </a>
    <?php else: ?>
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            <i class="fa fa-fw fa-power-off"></i> <?php echo e(config('adminlte.log_out')); ?>

        </a>
        <form id="logout-form" action="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>" method="POST" style="display: none;">
            <?php if(config('adminlte.logout_method')): ?>
                <?php echo e(method_field(config('adminlte.logout_method'))); ?>

            <?php endif; ?>
            <?php echo e(csrf_field()); ?>

        </form>
    <?php endif; ?>  
    </li>
   
           


