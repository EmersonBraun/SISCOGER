<div class="tab-pane" id="restricoes">
    <table class="table table-striped">
        <tbody> 
        @forelse($restricoes as $rest)
            <tr>
            @if ($rest["arma_bl"])<td><b>Restricao de porte de arma de fogo.</b></td>@endif
            @if ($rest["fardamento_bl"])<td><b>Restricao de uso de fardamento.</b></td>@endif
            <td> <b>Inicio</b>: {{data_br($rest["inicio_data"])}} / 
            <b>Fim</b>:
            @if ($rest["retirada_data"]=="0000-00-00" && $rest["fim_data"]=="0000-00-00")
            <b>Vigente</b></td>
            @else
            {{data_br($rest["retirada_data"])}}</td>
            @endif
            @if (!($rest["retirada_data"]!="0000-00-00" and $rest["retirada_data"]!="")) 
            <td><button type="button" class="btn btn-default pull-right">
                    <i class="fa fa-minus"></i>Retirar restricao
                </button></td>
            @endif
            </tr>
        @empty
            <tr>
                <td> Não há registros.</td>
            </tr> 
        @endforelse
        <tr>
            <td>
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar Restrição
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>