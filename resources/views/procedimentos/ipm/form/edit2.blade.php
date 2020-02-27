@extends('adminlte::page')

@section('title', 'IPM - Editar')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('ipm.lista',['ano' => date('Y')])}}">IPM - Lista</a></li>
  <li class="active">IPM - Editar</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<div class="">
<section>
    <div class="nav-tabs-custom">
            <create-ipm></create-ipm>
              
                {{-- <file-upload 
                title="PDF - Conclusão do encarregado:"
                name="relato_enc_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc_data"></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc"></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm"></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral"></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    dproc="ipm" idp="{{$proc['id_ipm']}}"
                    :ext="['pdf']" 

                    >
                </file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data"></v-item-unique> --}}

                {{-- <v-membro dproc="ipm" idp="{{$proc['id_ipm']}}"></v-membro> --}}

                {{-- <v-movimento dproc="ipm" idp="{{$proc['id_ipm']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" ></v-movimento> --}}

                {{-- <v-sobrestamento dproc="ipm" idp="{{$proc['id_ipm']}}" ></v-sobrestamento> --}}

                

                {{-- <v-item-unique title="Referência da Vajme (Nº do processo, vara)" dproc="ipm" idp="{{$proc['id_ipm']}}" name="vajme_ref"></v-item-unique> --}}
                {{-- <v-item-unique title="Referência da Justiça Comum (Nº do processo, vara)" dproc="ipm" idp="{{$proc['id_ipm']}}" name="justicacomum_ref"></v-item-unique> --}}

                {{-- <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="ipm" idp="{{$proc['id_ipm']}}" ></v-arquivo> --}}
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

