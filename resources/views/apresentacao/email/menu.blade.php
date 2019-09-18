<section class="content-header nopadding">  
    <h1>Email - {{$title}} {{$ano}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Email - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        @php 
        $ano = date('Y') + 1;
        $tam = ($ano - 2016);
        $col = floor(12 / $tam);
        @endphp
        @for ($i = 2016; $i <= date('Y'); $i++)  
            <a class="btn @if($page == $i) btn-success @else btn-default @endif col-xs-{{$col}}" href="{{route('email.index',['ano' => $i])}}">{{$i}}</a>
        @endfor
    <div>
</section>