webpackJsonp([56],{G3V2:function(t,a,s){(t.exports=s("FZ+f")(!1)).push([t.i,"",""])},arPo:function(t,a,s){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default={props:["rg"],data:function(){return{sai:[],canCreate:!1,canEdit:!1}},mounted:function(){this.listsai(),this.canCreate=this.$root.hasPermission("criar-sai"),this.canEdit=this.$root.hasPermission("editar-sai")},computed:{urlCreate:function(){return this.$root.baseUrl+"sai/criar"},urlEdit:function(t){return this.$root.baseUrl+"sai/editar/"+t}},methods:{listsai:function(){var t=this,a=this.$root.baseUrl+"api/fdi/sai/"+this.rg;this.rg&&axios.get(a).then(function(a){t.sai=a.data}).catch(function(t){return console.log(t)})}}}},fTKW:function(t,a,s){var i=s("VU/8")(s("arPo"),s("iK0e"),!1,function(t){s("j5R/")},"data-v-48ba524b",null);t.exports=i.exports},iK0e:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("v-tab",{attrs:{header:"SAI",badge:t.sai.lenght}},[s("table",{staticClass:"table table-striped"},[s("tbody",[t.sai.lenght?[s("tr",[s("th",[t._v("N° SAI")]),t._v(" "),s("th",[t._v("Motivo abertura")]),t._v(" "),s("th",[t._v("Síntese do fato")]),t._v(" "),s("th",[t._v("Situação")]),t._v(" "),s("th",[t._v("Resultado")]),t._v(" "),s("th",[t._v("Digitaror")]),t._v(" "),s("th",[t._v("Ações")])]),t._v(" "),t._l(t.sai,function(a){return s("tr",{key:a.id_sai},[s("td",[0!==a.sjd_ref?[t._v(t._s(a.sjd_ref)+"/"+t._s(a.sjd_ref_ano))]:[t._v(t._s(a.id_sai))]],2),t._v(" "),s("td",[t._v(t._s(a.motivo_principal)+" ")]),t._v(" "),s("td",[t._v(t._s(a.sintese_txt)+" ")]),t._v(" "),s("td",[t._v(t._s(a.situacao)+" ")]),t._v(" "),s("td",[t._v(t._s(a.origem_proc)+"-"+t._s(a.origem_sjd_ref)+"/"+t._s(a.origem_sjd_ref_ano)+" ")]),t._v(" "),s("td",[t._v(t._s(a.digitador)+" ")]),t._v(" "),s("td",[s("span",[s("a",{staticClass:"btn btn-info",attrs:{href:t.urlEdit(a.id_sai)}},[s("i",{staticClass:"fa fa-fw fa-edit "})])])])])})]:[s("tr",[s("td",[t._v("Nada encontrado")])])]],2)]),t._v(" "),t.canCreate?[s("a",{staticClass:"btn btn-primary btn-block",attrs:{href:t.urlCreate}},[s("i",{staticClass:"fa fa-fw fa-plus "}),t._v("Adicionar SAI\n    ")])]:t._e()],2)},staticRenderFns:[]}},"j5R/":function(t,a,s){var i=s("G3V2");"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);s("rjj0")("4dde028e",i,!0,{})}});