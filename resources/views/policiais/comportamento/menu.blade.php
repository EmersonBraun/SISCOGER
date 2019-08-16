<section class="content-header nopadding">  
    <h1>Comportamento - {{$title}} @if($page == 'SD1C') {{$parte}}ªParte @endif</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Comportamento - {{$title}} @if($page == 'SD1C') {{$parte}}ªParte @endif</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-12 col-xs-12 nopadding">
            <a class="btn @if($page == 'SD2C') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','SD2C')}}">SD2C</a>
            <a class="btn @if($page == 'SD1C' && $parte == '1') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index',['posto' => 'SD1C','parte' =>'1'])}}">SD1C pt.1</a>
            <a class="btn @if($page == 'SD1C' && $parte == '2') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index',['posto' => 'SD1C','parte' =>'2'])}}">SD1C pt.2</a>
            <a class="btn @if($page == 'SD1C' && $parte == '3') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index',['posto' => 'SD1C','parte' =>'3'])}}">SD1C pt.3</a>
            <a class="btn @if($page == 'SD1C' && $parte == '4') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index',['posto' => 'SD1C','parte' =>'4'])}}">SD1C pt.4</a>
            <a class="btn @if($page == 'CABO') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','CABO')}}">CABO</a>
            <a class="btn @if($page == '3SGT') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','3SGT')}}">3SGT</a>
            <a class="btn @if($page == '2SGT') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','2SGT')}}">2SGT</a>
            <a class="btn @if($page == '1SGT') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','1SGT')}}">1SGT</a>
            <a class="btn @if($page == 'SUBTEN') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','SUBTEN')}}">SUBTEN</a>
            <a class="btn @if($page == 'ALUNO') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','ALUNO')}}">ALUNO (1,2,3A)</a>
            <a class="btn @if($page == 'ASPOF') btn-success @else btn-default @endif col-xs-1 " href="{{route('comportamento.index','ASPOF')}}">ASPOF</a>
        </div>
    <div>
</section>