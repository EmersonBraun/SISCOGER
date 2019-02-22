<div class="tab-pane active" id="denuncias">
    <table class="table table-striped">
        <tbody>      
            @forelse($subJudice as $subJudice)
                @if ($subJudice['id_ipm'] != 0) 
                    <tr>
                        <td>
                        <a href="{{route('ipm.show',['ref' => proc_id('ipm',$subJudice['id_ipm'],'ref'),'ano' => proc_id('ipm',$subJudice['id_ipm'],'ano')])}}">
                        IPM N°{{proc_id('ipm',$subJudice['id_ipm'],'ref')}}/{{proc_id('ipm',$subJudice['id_ipm'],'ano')}}</a>
                        </td>
                @elseif ($subJudice['id_apfd'] != 0)
                    <tr>
                        <td>
                        <a href="{{route('apfd.show',['ref' => proc_id('apfd',$subJudice['id_apfd'],'ref'),'ano' => proc_id('apfd',$subJudice['id_apfd'],'ano')])}}">
                        APFD N°{{proc_id('apfd',$subJudice['id_apfd'],'ref')}}/{{proc_id('apfd',$subJudice['id_apfd'],'ano')}}
                        </a>
                        </td>
                @elseif ($subJudice['id_desercao'] != 0) 
                    <tr>
                        <td>
                        <a href="{{route('desercao.show',['ref' => proc_id('desercao',$subJudice['id_desercao'],'ref'),'ano' => proc_id('desercao',$subJudice['id_desercao'],'ano')])}}">
                        Deserção N°{{proc_id('desercao',$subJudice['id_desercao'],'ref')}}/{{proc_id('desercao',$subJudice['id_desercao'],'ano')}}
                        </a>
                        </td>
                @endif     
                        <td>Processo crime: <b>{{$subJudice['ipm_processocrime']}}</b></td>
                        <td>Julgamento:  <b> @if($subJudice['ipm_julgamento']) {{$subJudice['ipm_processocrime']}} @else Não cadastrado @endif</b> </td>
                        <td>Trânsito em julgado:  <b> @if($subJudice['ipm_julgamento'] == "Condenado") Sim @else Não @endif</b>  </td>
                    </tr>                 
            @empty
            <tr>
                <td>Nada encontrado</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>