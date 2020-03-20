@extends('adminlte::page')

@section('title', 'CD - Visualizar')

@section('content_header')
<section class="content-header">   
  <h1>CD - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('cd.lista',['ano' => date('Y')])}}">CD - Lista</a></li>
  <li class="active">CD - Visualizar</li>
  </ol>
</section>
@stop

@section('content')
<section>
    <div class="box">
        <div class="box-body">
        <h4>N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }}</h4>
        <v-tabs nav-style="tabs" justified>
            <v-tab header="Principal">
                <v-label label="id_andamento" title="Andamento">
                    <v-show dado="{{sistema('andamento',$proc['id_andamento'])}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="id_motivoconselho" title="Motivo CD (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                    <v-show dado="{{sistema('motivoConselho',$proc['id_motivoconselho'])}}"></v-show>
                </v-label>
                <v-label label="id_situacaoconselho" title="Situação">
                    <v-show dado="{{sistema('situacaoConselho',$proc['id_situacaoconselho'])}}"></v-show>
                </v-label>
                <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                    <v-show dado="{{sistema('decorrenciaConselho',$proc['id_decorrenciaconselho'])}}"></v-show>
                </v-label>
                <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                    <v-show dado="{{$proc['outromotivo']}}"></v-show>
                </v-label>
                <v-label label="portaria_numero" title="N° Portaria do CG">
                    <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                </v-label>
                <v-label label="portaria_data" title="Data da Portaria do CG" icon="fa fa-calendar">
                    <v-show dado="{{$proc['portaria_data']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <v-show dado="{{$proc['doc_tipo']}}"></v-show>
                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    <v-show dado="{{$proc['doc_numero']}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-show dado="{{$proc['abertura_data']}}"></v-show>
                </v-label>
                <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                    <v-show dado="{{$proc['prescricao_data']}}"></v-show>
                </v-label>
                <v-label label="doc_prorrogacao" title="Documento da prorrogação de prazo">
                    <v-show dado="{{$proc['doc_prorrogacao']}}"></v-show>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" >
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab>
            <v-tab header="Envolvidos">
                <v-proced-origem dproc="cd" idp="{{$proc['id_cd']}}" show></v-proced-origem><br>           
                <v-acusado dproc="cd" idp="{{$proc['id_cd']}}" situacao="{{sistema('procSituacao','cd')}}" show ></v-acusado><br>
                <v-vitima dproc="cd" idp="{{$proc['id_cd']}}" show ></v-vitima><br>
            </v-tab>
            <v-tab header="Acórdãos">
                <file-upload 
                    title="TJ-PR:"
                    name="tjpr_file"
                    dproc="cd" idp="{{$proc['id_cd']}}"
                    :ext="['pdf']"
                    show 
                    ></file-upload>

                <file-upload 
                    title="STJ/STF:"
                    name="stj_file"
                    dproc="cd" idp="{{$proc['id_cd']}}"
                    :ext="['pdf']" 
                    show
                    ></file-upload>
            </v-tab>
            <v-tab header="Documentos" idp="documentos">
                <file-upload 
                        title="Documento Juntado:"
                        name="relato_enc_file"
                        dproc="cd" idp="{{$proc['id_cd']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>
                        <v-item-unique title="Data" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_enc_data" show></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_enc" show></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                dproc="cd" idp="{{$proc['id_cd']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_cmtopm_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_cmtopm" show></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                dproc="cd" idp="{{$proc['id_cd']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_cmtgeral_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="cd" dproc="cd" idp="{{$proc['id_cd']}}" name="relato_cmtgeral" show></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    dproc="cd" idp="{{$proc['id_cd']}}"
                    :ext="['pdf']"
                    show 

                    >
                </file-upload>
            </v-tab>
            <v-tab header="Recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="cd" idp="{{$proc['id_cd']}}"
                    :ext="['pdf']" 
                    show
                    >
                </file-upload>

                <file-upload 
                    title="Recurso ao Governador (solução):"
                    name="rec_gov_file"
                    dproc="cd" idp="{{$proc['id_cd']}}"
                    :ext="['pdf']"
                    show 
                    >
                </file-upload>
            </v-tab>
            <v-tab header="Membros">
                <v-membro dproc="cd" idp="{{$proc['id_cd']}}" show></v-membro>
            </v-tab>
            <v-tab header="Movimentos">
                <v-movimento dproc="cd" idp="{{$proc['id_cd']}}" show></v-movimento>
            </v-tab>
            <v-tab header="Sobrestamentos">
                <v-sobrestamento dproc="cd" idp="{{$proc['id_cd']}}" show ></v-sobrestamento>
            </v-tab>
            <v-tab header="Encaminhamentos">
                Encaminhamentos
            </v-tab>
            <v-tab header="Arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="cd" idp="{{$proc['id_cd']}}" show></v-arquivo>
            </v-tab>
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop