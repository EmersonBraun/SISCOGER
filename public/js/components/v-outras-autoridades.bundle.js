webpackJsonp([67],{"7/Ew":function(t,s){t.exports={render:function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"col-xs-12"},[e("div",{staticClass:"box"},[t._m(0),t._v(" "),e("div",{staticClass:"box-body"},[e("div",{staticClass:"col-md-12 col-xs-12"},[e("table",{staticClass:"table table-striped"},[t.lenght?[t._m(1),t._v(" "),e("tbody",t._l(t.registros,function(s){return e("tr",{key:s.id_cadastroopmcogerautoridade},[e("td",[t._v(t._s(s.rg))]),t._v(" "),e("td",[t._v(t._s(s.funcao))]),t._v(" "),e("td",[e("span",[t.canEdit?[e("a",{staticClass:"btn btn-info",on:{click:function(e){return t.edit(s)}}},[e("i",{staticClass:"fa fa-fw fa-edit "})])]:t._e(),t._v(" "),t.canDelete?[e("a",{staticClass:"btn btn-danger",on:{click:function(e){return t.destroy(s.id_cadastroopmcogerautoridade)}}},[e("i",{staticClass:"fa fa-fw fa-trash-o "})])]:t._e()],2)])])}),0)]:[t._m(2)]],2),t._v(" "),t.canCreate?[e("a",{staticClass:"btn btn-primary btn-block",on:{click:function(s){return t.toCreate("create")}}},[e("i",{staticClass:"fa fa-plus"}),t._v("Adicionar Autoridade\n                    ")])]:t._e(),t._v(" "),e("v-modal",{attrs:{large:"",effect:"fade",width:"80%"},model:{value:t.showModal,callback:function(s){t.showModal=s},expression:"showModal"}},[e("div",{staticClass:"modal-header",attrs:{slot:"modal-header"},slot:"modal-header"},[e("h4",{staticClass:"modal-title"},[t.registro.id_cadastroopmcogerautoridade?e("b",[t._v("Editar Autoridade")]):e("b",[t._v("Inserir nova Autoridade")])])]),t._v(" "),e("div",{attrs:{slot:"modal-body"},slot:"modal-body"},[e("v-label",{attrs:{label:"rg",title:"RG"}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.rg,expression:"registro.rg"}],staticClass:"form-control",attrs:{size:"45",type:"text"},domProps:{value:t.registro.rg},on:{keyup:t.dadosPM,input:function(s){s.target.composing||t.$set(t.registro,"rg",s.target.value)}}})]),t._v(" "),e("v-label",{attrs:{label:"rg",title:"Nome"}},[e("p",[t._v(t._s(t.nome))])]),t._v(" "),e("v-label",{attrs:{label:"funcao",title:"Função"}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.registro.funcao,expression:"registro.funcao"}],staticClass:"form-control",attrs:{size:"45",type:"text"},domProps:{value:t.registro.funcao},on:{input:function(s){s.target.composing||t.$set(t.registro,"funcao",s.target.value)}}})])],1),t._v(" "),e("div",{staticClass:"modal-footer",attrs:{slot:"modal-footer"},slot:"modal-footer"},[e("div",{staticClass:"col-xs-6"},[e("a",{staticClass:"btn btn-default btn-block",on:{click:function(s){t.showModal=!1}}},[t._v("Cancelar")])]),t._v(" "),e("div",{staticClass:"col-xs-6"},[t.canCreate?[e("v-tooltip",{attrs:{effect:"scale",placement:"top",content:t.msgRequired}},[t.registro.id_cadastroopmcogerautoridade?e("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:t.requireds},on:{click:function(s){return s.preventDefault(),t.update(t.registro.id_cadastroopmcogerautoridade)}}},[t._v("Editar")]):e("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:t.requireds},on:{click:t.create}},[t._v("Inserir")])])]:t._e()],2)])])],2)])])])},staticRenderFns:[function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"box-header"},[s("h2",{staticClass:"box-title"},[this._v("Outras Autoridades")]),this._v(" "),s("div",{staticClass:"box-tools pull-right"},[s("button",{staticClass:"btn btn-box-tool",attrs:{type:"button","data-widget":"collapse"}},[s("i",{staticClass:"fa fa-plus"})])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("thead",[s("tr",[s("th",{staticClass:"col-xs-4"},[this._v("RG")]),this._v(" "),s("th",{staticClass:"col-xs-4"},[this._v("Função")]),this._v(" "),s("th",{staticClass:"col-xs-4"},[this._v("Ações")])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("tr",[s("td",[this._v("Nada encontrado")])])}]}},FkVH:function(t,s,e){var o=e("rUFT");"string"==typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);e("rjj0")("3b31e5f1",o,!0,{})},GdtW:function(t,s,e){"use strict";Object.defineProperty(s,"__esModule",{value:!0}),s.default={props:["id_cadastroopmcoger"],data:function(){return{module:"cadastroopmautoridade",registros:[],registro:{},canCreate:!1,canEdit:!1,canDelete:!1,showModal:!1,nome:""}},created:function(){this.canCreate=this.$root.hasPermission("criar-dados-unidade"),this.canEdit=this.$root.hasPermission("editar-dados-unidade"),this.canDelete=this.$root.hasPermission("apagar-dados-unidade"),this.list()},computed:{requireds:function(){return!this.registro.rg||!this.registro.funcao},lenght:function(){return this.registros?Object.keys(this.registros).length:0},msgRequired:function(){return"Para liberar este botão os campos: RG e Função deve estar preenchidos"}},methods:{list:function(){var t=this,s=this.$root.baseUrl+"api/"+this.module+"/list/"+this.id_cadastroopmcoger;this.id_cadastroopmcoger&&axios.get(s).then(function(s){console.log(s.data),t.registros=s.data[0]}).catch(function(t){return console.log(t)})},toCreate:function(){this.showModal=!0,this.registro.id_cadastroopmcoger=this.id_cadastroopmcoger,this.registro.usuario_rg=this.rg},create:function(){var t=this;if(!this.requireds){var s=this.$root.baseUrl+"api/"+this.module+"/store";axios.post(s,this.registro).then(function(s){t.transation(s.data.success,"create")}).catch(function(t){return console.log(t)}),this.showModal=!1}},edit:function(t){this.registro=t,this.showModal=!0},update:function(t){var s=this;if(!this.requireds){var e=this.$root.baseUrl+"api/"+this.module+"/update/"+t;axios.put(e,this.registro).then(function(t){s.transation(t.data.success,"edit")}).catch(function(t){return console.log(t)})}},destroy:function(t){var s=this;if(confirm("Você tem certeza?")){var e=this.$root.baseUrl+"api/"+this.module+"/destroy/"+t;axios.delete(e).then(function(t){s.transation(t.data.success,"delete")}).catch(function(t){return console.log(t)})}},transation:function(t,s){var e=this.words(s);this.showModal=!1,t?(this.$root.msg(e.success,"success"),this.registro=null,this.registro={},this.list()):this.$root.msg(e.fail,"danger")},words:function(t){return"create"==t?{success:"Inserido com sucesso",fail:"Erro ao inserir"}:"edit"==t?{success:"Editado com sucesso",fail:"Erro ao editar"}:"delete"==t?{success:"Apagado com sucesso",fail:"Erro ao apagar"}:void 0},dadosPM:function(){var t=this;if(this.registro.rg.length>3){var s=this.$root.baseUrl+"api/dados/pm/"+this.registro.rg;axios.get(s).then(function(s){var e=t.$root.formatUcwords(res.CARGO),o=res.QUADRO,a=t.$root.formatUcwords(res.NOME);t.nome=e+". "+o+" "+a}).catch(function(t){return console.log(t)})}}}}},nrfN:function(t,s,e){var o=e("VU/8")(e("GdtW"),e("7/Ew"),!1,function(t){e("FkVH")},"data-v-747c54ee",null);t.exports=o.exports},rUFT:function(t,s,e){(t.exports=e("FZ+f")(!1)).push([t.i,"td[data-v-747c54ee]{white-space:normal!important;word-wrap:break-word}table[data-v-747c54ee]{table-layout:fixed}",""])}});