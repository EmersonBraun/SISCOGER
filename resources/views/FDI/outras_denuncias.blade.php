<div class="tab-pane" id="outras_denuncias">
    <table class="table table-striped">
        <tbody>
            @forelse($denunciaCivil as $denunciaCivil)
            <tr>
                <td><a href="#">Deserção N°{{$denunciaCivil['id_denunciacivil']}}</a></td>
                <td>Processo crime: <b>{{$denunciaCivil['processocrime']}}</b></td>
                <td>Julgamento: <b> @if($denunciaCivil['julgamento']) {{$denunciaCivil['julgamento']}} @else Não
                        cadastrado @endif</b> </td>
                <td>Trânsito em julgado: <b> @if($denunciaCivil['transitojulgado_bl']) Sim @else Não @endif</b> </td>
            </tr>
            @empty
            <tr>
                <td>Nada encontrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(hasPermissionTo('criar-outras-denuncias'))
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Denúncia
    </button>
    @endif
</div>