webpackJsonp([57],{"1koh":function(t,e,a){var o=a("qPCt");"string"==typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);a("rjj0")("74c9ece0",o,!0,{})},VO38:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["pm"],data:function(){return{module:"punicao",registros:[],registro:{},canCreate:!1,canEdit:!1,canDelete:!1,showModal:!1,isCoger:!1}},mounted:function(){this.list(),this.canCreate=this.$root.hasPermission("criar-tramite-coger"),this.canEdit=this.$root.hasPermission("editar-tramite-coger"),this.canDelete=this.$root.hasPermission("apagar-tramite-coger"),this.isCoger=this.$root.hasPermission("COGER")},computed:{requireds:function(){return!this.registro.punicao_data||!this.registro.descricao_txt},lenght:function(){return this.registros?Object.keys(this.registros).length:0},msgRequired:function(){return"Para liberar este botão os campos: DATA DA PUNIÇÃO e DESCRIÇÃO deve estar preenchidos"},hasDias:function(){return!(2!=this.registro.id_gradacao&&4!=this.registro.id_gradacao&&5!=this.registro.id_gradacao&&!this.registro.dias)}},methods:{list:function(){var t=this,e=this.$root.baseUrl+"api/"+this.module+"/list/"+this.pm.RG;this.pm.RG&&axios.get(e).then(function(e){t.registros=e.data}).catch(function(t){return console.log(t)})},toCreate:function(t){this.showModal=!0,"create"==t&&(this.registro.id_punicao=null),this.registro.rg=this.pm.RG,this.registro.cargo=this.pm.CARGO,this.registro.nome=this.pm.NOME,this.registro.rg_cadastro=this.$root.dadoSession("rg"),this.registro.opm_abreviatura=this.$root.dadoSession("opm_abreviatura"),this.registro.digitador=this.$root.dadoSession("nome")},create:function(){var t=this;if(!this.requireds){var e=this.$root.baseUrl+"api/"+this.module+"/store";axios.post(e,this.registro).then(function(e){t.transation(e.data.success,"create")}).catch(function(t){return console.log(t)}),this.showModal=!1}},edit:function(t){this.registro=t,this.toCreate("edit")},update:function(t){var e=this;if(!this.requireds){var a=this.$root.baseUrl+"api/"+this.module+"/update/"+t;axios.put(a,this.registro).then(function(t){e.transation(t.data.success,"edit")}).catch(function(t){return console.log(t)})}},destroy:function(t){var e=this;if(confirm("Você tem certeza?")){var a=this.$root.baseUrl+"api/"+this.module+"/destroy/"+t;axios.delete(a).then(function(t){e.transation(t.data.success,"delete")}).catch(function(t){return console.log(t)})}},transation:function(t,e){var a=this.words(e);this.showModal=!1,t?(this.list(),this.$root.msg(a.success,"success"),this.registro=null,this.registro={}):this.$root.msg(a.fail,"danger")},words:function(t){return"create"==t?{success:"Inserido com sucesso",fail:"Erro ao inserir"}:"edit"==t?{success:"Editado com sucesso",fail:"Erro ao editar"}:"delete"==t?{success:"Apagado com sucesso",fail:"Erro ao apagar"}:void 0}}}},ed2X:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-tab",{attrs:{header:"Histórico Funcional",badge:t.lenght}},[a("table",{staticClass:"table table-striped"},[t.lenght?[a("thead",[a("tr",[a("th",{staticClass:"col-xs-1"},[t._v("Data")]),t._v(" "),a("th",{staticClass:"col-xs-1"},[t._v("Classificação")]),t._v(" "),a("th",{staticClass:"col-xs-1"},[t._v("Gradação")]),t._v(" "),a("th",{staticClass:"col-xs-5"},[t._v("Descrição")]),t._v(" "),a("th",{staticClass:"col-xs-2"},[t._v("OPM")]),t._v(" "),a("th",{staticClass:"col-xs-2"},[t._v("Ações")])])]),t._v(" "),a("tbody",t._l(t.registros,function(e){return a("tr",{key:e.id_punicao},[a("td",[t._v(t._s(e.data))]),t._v(" "),a("td",[t._v(t._s(e.classpunicao||"Não cadastrado"))]),t._v(" "),a("td",[t._v(t._s(e.gradacao||"Não cadastrado"))]),t._v(" "),a("td",[t._v(t._s(e.descricao_txt))]),t._v(" "),a("td",[t._v(t._s(e.opm_abreviatura))]),t._v(" "),a("td",[a("span",[t.canEdit?[a("a",{staticClass:"btn btn-info",on:{click:function(a){return t.edit(e)}}},[a("i",{staticClass:"fa fa-fw fa-edit "})])]:t._e(),t._v(" "),t.canDelete?[a("a",{staticClass:"btn btn-danger",on:{click:function(a){return t.destroy(e.id_punicao)}}},[a("i",{staticClass:"fa fa-fw fa-trash-o "})])]:t._e()],2)])])}),0)]:[a("tr",[a("td",[t._v("Nada encontrado")])])]],2),t._v(" "),t.canCreate?[a("a",{staticClass:"btn btn-primary btn-block",on:{click:function(e){return t.toCreate("create")}}},[a("i",{staticClass:"fa fa-plus"}),t._v("Adicionar Punição\n        ")])]:t._e(),t._v(" "),a("v-modal",{attrs:{large:"",effect:"fade",width:"80%"},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("div",{staticClass:"modal-header",attrs:{slot:"modal-header"},slot:"modal-header"},[a("h4",{staticClass:"modal-title"},[t.registro.id_punicao?a("b",[t._v("Editar Punição")]):a("b",[t._v("Inserir nova Punição")])])]),t._v(" "),a("div",{attrs:{slot:"modal-body"},slot:"modal-body"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.rg_cadastro,expression:"registro.rg_cadastro"}],attrs:{type:"hidden"},domProps:{value:t.registro.rg_cadastro},on:{input:function(e){e.target.composing||t.$set(t.registro,"rg_cadastro",e.target.value)}}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.opm_abreviatura,expression:"registro.opm_abreviatura"}],attrs:{type:"hidden"},domProps:{value:t.registro.opm_abreviatura},on:{input:function(e){e.target.composing||t.$set(t.registro,"opm_abreviatura",e.target.value)}}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.digitador,expression:"registro.digitador"}],attrs:{type:"hidden"},domProps:{value:t.registro.digitador},on:{input:function(e){e.target.composing||t.$set(t.registro,"digitador",e.target.value)}}}),t._v(" "),a("v-label",{attrs:{label:"rg",title:"RG"}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.rg,expression:"registro.rg"}],staticClass:"form-control",attrs:{type:"text",size:"12",maxlength:"25",readonly:""},domProps:{value:t.registro.rg},on:{input:function(e){e.target.composing||t.$set(t.registro,"rg",e.target.value)}}})]),t._v(" "),a("v-label",{attrs:{label:"cargo",title:"Posto/Grad."}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.cargo,expression:"registro.cargo"}],staticClass:"form-control",attrs:{type:"text",size:"6",maxlength:"10",readonly:""},domProps:{value:t.registro.cargo},on:{input:function(e){e.target.composing||t.$set(t.registro,"cargo",e.target.value)}}})]),t._v(" "),a("v-label",{attrs:{label:"nome",title:"Nome"}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.nome,expression:"registro.nome"}],staticClass:"form-control",attrs:{type:"text",size:"40",readonly:""},domProps:{value:t.registro.nome},on:{input:function(e){e.target.composing||t.$set(t.registro,"nome",e.target.value)}}})]),t._v(" "),a("v-label",{attrs:{label:"cdopm",title:"OPM da Punicao"}},[a("v-opm",{attrs:{name:"cdopm",cdopm:"registro.cdopm"},model:{value:t.registro.cdopm,callback:function(e){t.$set(t.registro,"cdopm",e)},expression:"registro.cdopm"}})],1),t._v(" "),a("v-label",{attrs:{label:"procedimento",title:"Procedimento"}},[t.registro.id_punicao&&t.registro.procedimento?a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.procedimento,expression:"registro.procedimento"}],staticClass:"form-control",attrs:{type:"text",size:"6",maxlength:"10",readonly:""},domProps:{value:t.registro.procedimento},on:{input:function(e){e.target.composing||t.$set(t.registro,"procedimento",e.target.value)}}}):a("select",{directives:[{name:"model",rawName:"v-model",value:t.registro.procedimento,expression:"registro.procedimento"}],staticClass:"form-control",on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.registro,"procedimento",e.target.multiple?a:a[0])}}},[a("option",{attrs:{value:"NA"}},[t._v("FATD S/N COGER")]),t._v(" "),a("option",{attrs:{value:"fatd"}},[t._v("FATD")]),t._v(" "),t.isCoger?[a("option",{attrs:{value:"cd"}},[t._v("CD")]),t._v(" "),a("option",{attrs:{value:"cj"}},[t._v("CJ")]),t._v(" "),a("option",{attrs:{value:"adl"}},[t._v("ADL")])]:t._e()],2)]),t._v(" "),a("v-label",{attrs:{label:"sjd_ref",title:"Nº Referência"}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.sjd_ref,expression:"registro.sjd_ref"}],staticClass:"form-control",attrs:{type:"text",size:"6",maxlength:"10",readonly:t.registro.id_punicao&&t.registro.sjd_ref},domProps:{value:t.registro.sjd_ref},on:{input:function(e){e.target.composing||t.$set(t.registro,"sjd_ref",e.target.value)}}})]),t._v(" "),a("v-label",{attrs:{label:"sjd_ref_ano",title:"Ano"}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.sjd_ref_ano,expression:"registro.sjd_ref_ano"}],staticClass:"form-control",attrs:{type:"text",size:"6",maxlength:"10",readonly:t.registro.id_punicao&&t.registro.sjd_ref_ano},domProps:{value:t.registro.sjd_ref_ano},on:{input:function(e){e.target.composing||t.$set(t.registro,"sjd_ref_ano",e.target.value)}}})]),t._v(" "),a("v-label",{attrs:{label:"punicao_data",title:"Data da punição",icon:"fa fa-calendar"}},[a("v-datepicker",{attrs:{name:"punicao_data",placeholder:t.registro.punicao_data,"clear-button":""},model:{value:t.registro.punicao_data,callback:function(e){t.$set(t.registro,"punicao_data",e)},expression:"registro.punicao_data"}})],1),t._v(" "),a("v-label",{attrs:{label:"ultimodia_data",title:"Ultimo dia de cumprimento da punição",tooltip:"Art. 63 RDE",icon:"fa fa-calendar"}},[a("v-datepicker",{attrs:{name:"ultimodia_data",placeholder:t.registro.ultimodia_data,"clear-button":""},model:{value:t.registro.ultimodia_data,callback:function(e){t.$set(t.registro,"ultimodia_data",e)},expression:"registro.ultimodia_data"}})],1),t._v(" "),a("v-label",{attrs:{label:"id_classpunicao",title:"Classificação da punição"}},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.registro.id_classpunicao,expression:"registro.id_classpunicao"}],staticClass:"form-control",on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.registro,"id_classpunicao",e.target.multiple?a:a[0])}}},[a("option",{attrs:{value:"1"}},[t._v("Leve")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("Média")]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v("Grave")])])]),t._v(" "),t.registro.id_classpunicao||t.registro.id_gradacao?a("v-label",{attrs:{label:"id_gradacao",title:"Gradação da punição"}},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.registro.id_gradacao,expression:"registro.id_gradacao"}],staticClass:"form-control",attrs:{name:"id_gradacao"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.registro,"id_gradacao",e.target.multiple?a:a[0])}}},[1==t.registro.id_classpunicao?[a("option",{attrs:{value:"1"}},[t._v("Advertência")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("Impedimento Disciplinar")])]:t._e(),t._v(" "),2==t.registro.id_classpunicao?[a("option",{attrs:{value:"3"}},[t._v("Repreensão")]),t._v(" "),a("option",{attrs:{value:"4"}},[t._v("Detenção")])]:t._e(),t._v(" "),3==t.registro.id_classpunicao?[a("option",{attrs:{value:"5"}},[t._v("Prisão")])]:t._e()],2)]):t._e(),t._v(" "),t.hasDias?[a("v-label",{attrs:{label:"dias",title:"Quantidade de dias"}},[a("the-mask",{staticClass:"form-control",attrs:{mask:"####",type:"text",maxlength:"4",name:"dias",placeholder:"Dias"},model:{value:t.registro.dias,callback:function(e){t.$set(t.registro,"dias",e)},expression:"registro.dias"}})],1)]:t._e(),t._v(" "),a("v-label",{attrs:{label:"descricao_txt",title:"Descrição",lg:"12",md:"12"}},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.registro.descricao_txt,expression:"registro.descricao_txt"}],attrs:{id:"foco",rows:"6",cols:"105",width:"100%"},domProps:{value:t.registro.descricao_txt},on:{input:function(e){e.target.composing||t.$set(t.registro,"descricao_txt",e.target.value)}}})])],2),t._v(" "),a("div",{staticClass:"modal-footer",attrs:{slot:"modal-footer"},slot:"modal-footer"},[a("div",{staticClass:"col-xs-6"},[a("a",{staticClass:"btn btn-default btn-block",on:{click:function(e){t.showModal=!1}}},[t._v("Cancelar")])]),t._v(" "),a("div",{staticClass:"col-xs-6"},[a("v-tooltip",{attrs:{effect:"scale",placement:"top",content:t.msgRequired}},[t.registro.id_punicao?a("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:t.requireds},on:{click:function(e){return e.preventDefault(),t.update(t.registro.id_punicao)}}},[t._v("Editar")]):a("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:t.requireds},on:{click:t.create}},[t._v("Inserir")])])],1)])])],2)},staticRenderFns:[]}},qPCt:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"td[data-v-1d2aab8e]{white-space:normal!important;word-wrap:break-word}table[data-v-1d2aab8e]{table-layout:fixed}",""])},v2up:function(t,e,a){var o=a("VU/8")(a("VO38"),a("ed2X"),!1,function(t){a("1koh")},"data-v-1d2aab8e",null);t.exports=o.exports}});