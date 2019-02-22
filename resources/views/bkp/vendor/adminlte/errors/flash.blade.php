@if(Session::has('flash_message'))
<div class="container">      
    <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
    </div>
</div>
@endif 

<div class="row">
<div class="col-md-8 col-md-offset-2">              
    @include ('vendor.adminlte.errors.list')
</div>
</div>