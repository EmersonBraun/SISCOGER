webpackJsonp([63],{"0MxJ":function(e,n,t){var s=t("TeVg");"string"==typeof s&&(s=[[e.i,s,""]]),s.locals&&(e.exports=s.locals);t("rjj0")("40baed66",s,!0,{})},C5TU:function(e,n,t){var s=t("VU/8")(t("tDLa"),t("L1Jk"),!1,function(e){t("0MxJ")},"data-v-15891614",null);e.exports=s.exports},L1Jk:function(e,n){e.exports={render:function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-tab",{attrs:{header:"Denúncias",badge:e.denuncias.lenght}},[t("table",{staticClass:"table table-striped"},[t("tbody",[e.denuncias.lenght?e._l(e.denuncias,function(n,s){return t("tr",{key:s},[0!==n.id_ipm?[t("td",[t("a",{attrs:{href:"urlProc('ipm', denuncia.sjd_ref, denuncia.sjd_ref_ano)"}},[e._v("\n                        IPM N°"+e._s(n.sjd_ref)+"/"+e._s(n.sjd_ref_ano))])])]:e._e(),e._v(" "),0!==n.id_apfd?[t("td",[t("a",{attrs:{href:"urlProc('apfd', denuncia.sjd_ref, denuncia.sjd_ref_ano)"}},[e._v("\n                        APFD N°"+e._s(n.sjd_ref)+"/"+e._s(n.sjd_ref_ano))])])]:e._e(),e._v(" "),0!==n.id_desercao?[t("td",[t("a",{attrs:{href:"urlProc('desercao', denuncia.sjd_ref, denuncia.sjd_ref_ano)"}},[e._v("\n                        Desercao N°"+e._s(n.sjd_ref)+"/"+e._s(n.sjd_ref_ano))])])]:e._e(),e._v(" "),t("td",[e._v("Processo crime: "),t("b",[e._v(e._s(n.ipm_processocrime))])]),e._v(" "),t("td",[e._v("Julgamento:  \n                        "),n.ipm_julgamento?t("b",[e._v(" "+e._s(n.ipm_processocrime))]):t("b",[e._v(" Não cadastrado ")])]),e._v(" "),t("td",[e._v("Trânsito em julgado:  \n                        "),"Condenado"==n.ipm_julgamento?t("b",[e._v(" Sim")]):t("b",[e._v(" Não ")])])],2)}):[t("tr",[t("td",[e._v("Nada encontrado")])])]],2)])])},staticRenderFns:[]}},TeVg:function(e,n,t){(e.exports=t("FZ+f")(!1)).push([e.i,"",""])},tDLa:function(e,n,t){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default={props:["rg"],data:function(){return{denuncias:[]}},mounted:function(){this.listDenuncias()},methods:{listDenuncias:function(){var e=this,n=this.$root.baseUrl+"api/fdi/subJudice/"+this.rg;this.rg&&axios.get(n).then(function(n){e.denuncias=n.data}).catch(function(e){return console.log(e)})},urlProc:function(e,n,t){return""+this.$root.baseUrl+e+"/show/"+id+"/"+t}}}}});