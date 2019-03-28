<ul class="nav nav-tabs">
    <li class="a denuncias active"><a href="#denuncias" data-toggle="tab" aria-expanded="true" onclick="mudaTab('denuncias')">Denúncias criminais </a></li>
    <li class="a outras_denuncias"><a href="#outras_denuncias" data-toggle="tab" aria-expanded="false" onclick="mudaTab('outras_denuncias')">Outras denúncias </a></li>
    <li class="a prisoes"><a href="#prisoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('prisoes')">Prisões @if(count($prisoes) > 0) <span class="badge bg-red">{{count($prisoes)}}</span> @endif</a></li>
    <li class="a restricoes"><a href="#restricoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('restricoes')">Restrições @if(count($restricoes) > 0) <span class="badge bg-red">{{count($restricoes)}}</span> @endif</a></li>
    <li class="a sai"><a href="#sai" data-toggle="tab" aria-expanded="false" onclick="mudaTab('sai')">SAI @if(count($sai) > 0) <span class="badge bg-red">{{count($sai)}}</span> @endif</a></li>
    <li class="a fdi"><a href="#fdi" data-toggle="tab" aria-expanded="false" onclick="mudaTab('fdi')">FDI @if(count($elogios) > 0) <span class="badge bg-blue">{{count($elogios)}}</span> @endif</a></li>
    <li class="a objeto"><a href="#objeto" data-toggle="tab" aria-expanded="false" onclick="mudaTab('objeto')">Objeto @if(count($objetos) > 0) <span class="badge bg-red">{{count($objetos)}}</span> @endif</a></li>
    <li class="a membro"><a href="#membro" data-toggle="tab" aria-expanded="false" onclick="mudaTab('membro')">Membro @if(count($membros) > 0) <span class="badge bg-red">{{count($membros)}}</span> @endif</a></li>
    <li class="a apresentacoes"><a href="#apresentacoes" data-toggle="tab" aria-expanded="false" onclick="mudaTab('apresentacoes')">Apresentacões @if(count($apresentacoes) > 0) <span class="badge bg-red">{{count($apresentacoes)}}</span> @endif</a></li>
    <li class="a proc_outros"><a href="#proc_outros" data-toggle="tab" aria-expanded="false" onclick="mudaTab('proc_outros')">Proc. Outros @if(count($proc_outros) > 0) <span class="badge bg-red">{{count($proc_outros)}}</span> @endif</a></li>
    <li class="a cautelas"><a href="#cautelas" data-toggle="tab" aria-expanded="false" onclick="mudaTab('cautelas')">Cautelas</a></li>

    
    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="Os campos poderão ser suprimidos nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i></a></li>
</ul>