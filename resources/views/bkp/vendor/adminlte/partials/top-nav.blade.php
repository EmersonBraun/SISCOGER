parte1
@if(config('adminlte.layout') == 'top-nav')
<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              
            </ul>
        </div>
        <!-- /.navbar-collapse -->
@else

parte2
@if(config('adminlte.layout') == 'top-nav')
</div>
@endif
@endif
parte3
@if(config('adminlte.layout') == 'top-nav')
<div class="container">
@endif

parte4
@if(config('adminlte.layout') == 'top-nav')
</div>
<!-- /.container -->
@endif