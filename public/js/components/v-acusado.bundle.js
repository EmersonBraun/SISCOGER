webpackJsonp([10,35],{"2DLv":function(t,a,s){var e=s("VU/8")(s("n2B+"),s("8iww"),!1,function(t){s("8zM4")},"data-v-b3d69a82",null);t.exports=e.exports},"8iww":function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"col-lg-12 col-md-12 col-xs-12 card mt-4"},[s("br"),t._v(" "),s("div",{staticClass:"card-header"},[t.reu?s("div",{staticClass:"row"},[s("div",{staticClass:"col-sm-10"},[s("h4",[t._v(t._s(t.verReus?"Réus":"Acusados"))])]),t._v(" "),s("div",{staticClass:"col align-self-end"},[s("div",{staticClass:"btn-group"},[s("a",{staticClass:"btn",class:t.verReus?"btn-default":"btn-info",attrs:{type:"button",target:"_black"},on:{click:function(a){t.verReus=!1}}},[t._v("\n                        Acusados\n                    ")]),t._v(" "),s("a",{staticClass:"btn",class:t.verReus?"btn-info":"btn-default",attrs:{type:"button"},on:{click:function(a){t.verReus=!0}}},[t._v("\n                        Réus\n                    ")])])])]):[t._m(0)]],2),t._v(" "),t.only?t._e():s("div",{staticClass:"card-body",class:t.add?"bordaform":""},[t.add||t.verReus?t._e():s("div",[s("button",{staticClass:"btn btn-success btn-block",on:{click:function(a){t.add=!t.add}}},[s("i",{staticClass:"fa fa-plus"}),t._v(" Adicionar acusado")])]),t._v(" "),t.add?s("div",[s("div",{staticClass:"row"},[s("form",{attrs:{id:"formAcusado",name:"formAcusado"}},[s("input",{attrs:{type:"hidden",name:"id_"+t.dproc},domProps:{value:t.idp}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"situacao"},domProps:{value:t.situacao}}),t._v(" "),s("div",{staticClass:"col-xs-3"},[s("label",{attrs:{for:"rg"}},[t._v("RG")]),s("br"),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.rg,expression:"rg"}],staticClass:"numero form-control",attrs:{name:"rg",type:"text",maxlength:"12"},domProps:{value:t.rg},on:{keyup:t.searchPM,input:function(a){a.target.composing||(t.rg=a.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-xs-3"},[s("label",{attrs:{for:"nome"}},[t._v("Nome")]),s("br"),t._v(" "),s("input",{staticClass:"numero form-control",attrs:{type:"text",name:"nome",readonly:""},domProps:{value:t.nome}})]),t._v(" "),s("div",{class:t.reu?"col-xs-3":"col-xs-2"},[s("label",{attrs:{for:"cargo"}},[t._v("Posto/Graduação")]),s("br"),t._v(" "),s("input",{staticClass:"numero form-control",attrs:{type:"text",name:"cargo",readonly:""},domProps:{value:t.cargo}})]),t._v(" "),s("div",{class:t.reu?"col-xs-3":"col-xs-2"},[s("label",{attrs:{for:"resultado"}},[t._v("Resultado")]),s("br"),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.resultado,expression:"resultado"}],staticClass:"form-control",attrs:{name:"resultado",disabled:!t.nome,required:""},on:{change:function(a){var s=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.resultado=a.target.multiple?s:s[0]}}},[s("option",{attrs:{value:""}},[t._v("Selecione")]),t._v(" "),s("option",{attrs:{value:"Excluído"}},[t._v("Excluído")]),t._v(" "),s("option",{attrs:{value:"Punido"}},[t._v("Punido")]),t._v(" "),s("option",{attrs:{value:"Absolvido"}},[t._v("Absolvido")]),t._v(" "),s("option",{attrs:{value:"Perda objeto"}},[t._v("Perda objeto")]),t._v(" "),s("option",{attrs:{value:"Prescricao"}},[t._v("Prescricao")]),t._v(" "),s("option",{attrs:{value:"Reintegrado/Reinserido"}},[t._v("Reintegrado/Reinserido")])])]),t._v(" "),t.reu&&t.toEdit?[s("div",{staticClass:"col-lg-6 col-md-6 col-xs-6"},[s("label",{attrs:{for:"ipm_processocrime"}},[t._v("Processo crime")]),s("br"),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.pm.ipm_processocrime,expression:"pm.ipm_processocrime"}],staticClass:"form-control",attrs:{name:"ipm_processocrime"},on:{change:function(a){var s=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.pm,"ipm_processocrime",a.target.multiple?s:s[0])}}},[s("option",{attrs:{value:""}},[t._v("Selecione")]),t._v(" "),s("option",{attrs:{value:"Denunciado"}},[t._v("Denunciado")]),t._v(" "),s("option",{attrs:{value:"Arquivado"}},[t._v("Arquivado")])])]),t._v(" "),s("div",{staticClass:"col-lg-6 col-md-6 col-xs-6"},[s("label",{attrs:{for:"ipm_julgamento"}},[t._v("Julgamento")]),s("br"),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.pm.ipm_julgamento,expression:"pm.ipm_julgamento"}],staticClass:"form-control",attrs:{name:"ipm_julgamento"},on:{change:function(a){var s=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.pm,"ipm_julgamento",a.target.multiple?s:s[0])}}},[s("option",{attrs:{value:""}},[t._v("Selecione")]),t._v(" "),s("option",{attrs:{value:"Condenado"}},[t._v("Condenado")]),t._v(" "),s("option",{attrs:{value:"Absolvido"}},[t._v("Absolvido")])])]),t._v(" "),"Condenado"==t.pm.ipm_julgamento?[s("div",{staticClass:"col-lg-1 col-md-1 col-xs-1"},[s("label",[t._v("Anos")]),s("br"),t._v(" "),s("the-mask",{staticClass:"form-control",attrs:{mask:"###",type:"text",maxlength:"3",name:"ipm_pena_anos",placeholder:"Anos"},model:{value:t.pm.ipm_pena_anos,callback:function(a){t.$set(t.pm,"ipm_pena_anos",a)},expression:"pm.ipm_pena_anos"}})],1),t._v(" "),s("div",{staticClass:"col-lg-1 col-md-1 col-xs-1"},[s("label",[t._v("Meses")]),s("br"),t._v(" "),s("the-mask",{staticClass:"form-control",attrs:{mask:"###",type:"text",maxlength:"3",name:"ipm_pena_meses",placeholder:"Meses"},model:{value:t.pm.ipm_pena_meses,callback:function(a){t.$set(t.pm,"ipm_pena_meses",a)},expression:"pm.ipm_pena_meses"}})],1),t._v(" "),s("div",{staticClass:"col-lg-1 col-md-1 col-xs-1"},[s("label",[t._v("Dias")]),s("br"),t._v(" "),s("the-mask",{staticClass:"form-control",attrs:{mask:"###",type:"text",maxlength:"3",name:"ipm_pena_dias",placeholder:"Dias"},model:{value:t.pm.ipm_pena_dias,callback:function(a){t.$set(t.pm,"ipm_pena_dias",a)},expression:"pm.ipm_pena_dias"}})],1),t._v(" "),s("div",{staticClass:"col-lg-3 col-md-3 col-xs-3"},[s("label"),s("br"),t._v(" "),s("v-checkbox",{attrs:{name:"ipm_transitojulgado_bl","true-value":"S","false-value":"0",text:"Transitou em julgado?"},model:{value:t.pm.ipm_transitojulgado_bl,callback:function(a){t.$set(t.pm,"ipm_transitojulgado_bl",a)},expression:"pm.ipm_transitojulgado_bl"}})],1),t._v(" "),s("div",{staticClass:"col-lg-2 col-md-2 col-xs-2"},[s("label",{attrs:{for:"ipm_tipodapena"}},[t._v("Tipo Pena")]),s("br"),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.pm.ipm_tipodapena,expression:"pm.ipm_tipodapena"}],staticClass:"form-control",attrs:{name:"ipm_tipodapena"},on:{change:function(a){var s=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.pm,"ipm_tipodapena",a.target.multiple?s:s[0])}}},[s("option",{attrs:{value:""}},[t._v("Selecione")]),t._v(" "),s("option",{attrs:{value:"Detenção"}},[t._v("Detenção")]),t._v(" "),s("option",{attrs:{value:"Reclusão"}},[t._v("Reclusão")])])]),t._v(" "),s("div",{staticClass:"col-lg-3 col-md-3 col-xs-3"},[s("label"),s("br"),t._v(" "),s("v-checkbox",{attrs:{name:"ipm_restritiva_bl","true-value":"S","false-value":"0",text:"Restritiva de direito?"},model:{value:t.pm.ipm_restritiva_bl,callback:function(a){t.$set(t.pm,"ipm_restritiva_bl",a)},expression:"pm.ipm_restritiva_bl"}})],1)]:t._e(),t._v(" "),s("div",{staticClass:"col-lg-10 col-md-10 col-xs-10"},[s("label",{attrs:{for:"obs_txt"}},[t._v("Observações")]),s("br"),t._v(" "),s("input",{staticClass:"numero form-control",attrs:{type:"text",name:"obs_txt"},domProps:{value:t.pm.obs_txt}})])]:t._e(),t._v(" "),s("div",{staticClass:"col-lg-1 col-md-1 col-xs 1"},[s("label",[t._v("Cancelar")]),s("br"),t._v(" "),s("a",{staticClass:"btn btn-danger btn-block",on:{click:function(a){return t.clear(!1)}}},[s("i",{staticClass:"fa fa-times",staticStyle:{color:"white"}})])]),t._v(" "),s("div",{staticClass:"col-lg-1 col-md-1 col-xs 1"},[t.toEdit?[s("label",[t._v("Editar")]),s("br"),t._v(" "),s("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:!t.resultado},on:{click:t.editPM}},[s("i",{staticClass:"fa fa-plus",staticStyle:{color:"white"}})])]:[s("label",[t._v("Adicionar")]),s("br"),t._v(" "),s("a",{staticClass:"btn btn-success btn-block",attrs:{disabled:!t.resultado},on:{click:t.createPM}},[s("i",{staticClass:"fa fa-plus",staticStyle:{color:"white"}})])]],2)],2)])]):t._e()]),t._v(" "),s("div",{staticClass:"card-footer"},[t.verReus?[t.pms.length?s("div",{staticClass:"row bordaform"},[s("div",{staticClass:"col-sm-12"},[s("table",{staticClass:"table table-hover"},[s("thead",[s("tr",[s("th",{staticClass:"col-sm-1"},[t._v("#")]),t._v(" "),s("th",{staticClass:"col-sm-1"},[t._v("RG")]),t._v(" "),t.verReus?[s("th",{staticClass:"col-sm-1"},[t._v("Processo crime")]),t._v(" "),s("th",{staticClass:"col-sm-3"},[t._v("Julgamento")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Tipo pena")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Rest. direito")])]:[s("th",{staticClass:"col-sm-2"},[t._v("Nome")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Posto/Grad.")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Resultado")])],t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Ver/Editar/Apagar")])],2)]),t._v(" "),s("tbody",t._l(t.pms,function(a,e){return s("tr",{key:e},[s("td",[t._v(t._s(e+1))]),t._v(" "),s("td",[t._v(t._s(a.rg))]),t._v(" "),t.verReus?[s("td",[t._v(t._s(t._f("SN")(a.ipm_processocrime)))]),t._v(" "),a.ipm_julgamento&&"Absolvido"==a.ipm_julgamento?[s("td",[t._v(t._s(a.ipm_julgamento))]),t._v(" "),s("td",[t._v("-")]),t._v(" "),s("td",[t._v("-")])]:[s("td",[t._v(t._s(t._f("SN")(a.ipm_julgamento))+": \n                                            "+t._s(a.ipm_pena_anos)),s("b",[t._v("A")]),t._v("\n                                            "+t._s(a.ipm_pena_meses)),s("b",[t._v("M")]),t._v("\n                                            "+t._s(a.ipm_pena_dias)),s("b",[t._v("D")]),t._v(" \n                                            Transitado? "),s("b",[t._v(t._s(t._f("SN")(a.ipm_transitojulgado_bl)))])]),t._v(" "),s("td",[t._v(t._s(t._f("SN")(a.ipm_tipodapena)))]),t._v(" "),s("td",[t._v(t._s(t._f("SN")(a.ipm_restritiva_bl)))])]]:[s("td",[t._v(t._s(a.nome))]),t._v(" "),s("td",[t._v(t._s(a.cargo))]),t._v(" "),s("td",[t._v(t._s(t._f("vazio")(a.resultado)))])],t._v(" "),s("td",[s("div",{staticClass:"btn-group",attrs:{role:"group","aria-label":"First group"}},[s("a",{staticClass:"btn btn-primary",staticStyle:{color:"white"},attrs:{type:"button",target:"_blanck"},on:{click:function(s){return t.showPM(a.rg)}}},[s("i",{staticClass:"fa fa-eye"})]),t._v(" "),s("a",{staticClass:"btn btn-success",staticStyle:{color:"white"},attrs:{type:"button",target:"_blanck"},on:{click:function(s){return t.replacePM(a)}}},[s("i",{staticClass:"fa fa-edit"})]),t._v(" "),s("a",{staticClass:"btn btn-danger",staticStyle:{color:"white"},attrs:{type:"button"},on:{click:function(s){return t.removePM(a.id_envolvido)}}},[s("i",{staticClass:"fa fa-trash"})])])])],2)}),0)])])]):t._e(),t._v(" "),!t.pms.length&&t.only?s("div",[t._m(1)]):t._e()]:[t.pms.length?s("div",{staticClass:"row bordaform"},[s("div",{staticClass:"col-sm-12"},[s("table",{staticClass:"table table-hover"},[t._m(2),t._v(" "),s("tbody",t._l(t.pms,function(a,e){return s("tr",{key:e},[s("td",[t._v(t._s(e+1))]),t._v(" "),s("td",[t._v(t._s(a.rg))]),t._v(" "),s("td",[t._v(t._s(a.nome)+" "+t._s(a.ipm_tipodapena))]),t._v(" "),s("td",[t._v(t._s(a.cargo))]),t._v(" "),s("td",[t._v(t._s(t._f("vazio")(a.resultado)))]),t._v(" "),s("td",[s("div",{staticClass:"btn-group",attrs:{role:"group","aria-label":"First group"}},[s("a",{staticClass:"btn btn-primary",staticStyle:{color:"white"},attrs:{type:"button",target:"_blanck"},on:{click:function(s){return t.showPM(a.rg)}}},[s("i",{staticClass:"fa fa-eye"})]),t._v(" "),t.canEdit?s("a",{staticClass:"btn btn-success",staticStyle:{color:"white"},attrs:{type:"button",target:"_blanck"},on:{click:function(s){return t.replacePM(a)}}},[s("i",{staticClass:"fa fa-edit"})]):t._e(),t._v(" "),t.canDelete?s("a",{staticClass:"btn btn-danger",staticStyle:{color:"white"},attrs:{type:"button"},on:{click:function(s){return t.removePM(a.id_envolvido,e)}}},[s("i",{staticClass:"fa fa-trash"})]):t._e()])])])}),0)])])]):!t.pms.length&&t.only?s("div",[t._m(3)]):t._e()]],2),t._v(" "),t.confirmModal?s("v-modal",{attrs:{effect:"fade",width:"400"}},[s("div",{staticClass:"modal-header",attrs:{slot:"modal-header"},slot:"modal-header"},[s("h4",{staticClass:"modal-title"},[t._v("Você tem certeza?")])]),t._v(" "),s("div",{staticClass:"modal-footer",attrs:{slot:"modal-footer"},slot:"modal-footer"},[s("button",{staticClass:"btn btn-success",attrs:{type:"button"},on:{click:function(a){t.respModal=!0}}},[t._v("Sim")]),t._v(" "),s("button",{staticClass:"btn btn-danger",attrs:{type:"button"},on:{click:function(a){t.confirmModal=!1}}},[t._v("Não")])])]):t._e()],1)},staticRenderFns:[function(){var t=this.$createElement,a=this._self._c||t;return a("h4",[a("b",[this._v("Acusado")])])},function(){var t=this.$createElement,a=this._self._c||t;return a("h5",[a("b",[this._v("Não há registros")])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("thead",[s("tr",[s("th",{staticClass:"col-sm-2"},[t._v("#")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("RG")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Nome")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Posto/Grad.")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Resultado")]),t._v(" "),s("th",{staticClass:"col-sm-2"},[t._v("Ver/Editar/Apagar")])])])},function(){var t=this.$createElement,a=this._self._c||t;return a("h5",[a("b",[this._v("Não há registros")])])}]}},"8zM4":function(t,a,s){var e=s("YCZg");"string"==typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);s("rjj0")("135b2e84",e,!0,{})},EPUk:function(t,a,s){var e=s("YiKi");"string"==typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);s("rjj0")("1ab92fba",e,!0,{})},FfMg:function(t,a,s){var e=s("VU/8")(s("lO1W"),s("wuYg"),!1,function(t){s("EPUk")},null,null);t.exports=e.exports},YCZg:function(t,a,s){(t.exports=s("FZ+f")(!1)).push([t.i,"",""])},YiKi:function(t,a,s){(t.exports=s("FZ+f")(!1)).push([t.i,".modal{transition:all .3s ease}.modal.in{background-color:rgba(0,0,0,.5)}.modal.zoom .modal-dialog{-webkit-transform:scale(.1);-moz-transform:scale(.1);-ms-transform:scale(.1);transform:scale(.1);top:300px;opacity:0;-webkit-transition:all .3s;-moz-transition:all .3s;transition:all .3s}.modal.zoom.in .modal-dialog{-webkit-transform:scale(1);-moz-transform:scale(1);-ms-transform:scale(1);transform:scale(1);-webkit-transform:translate3d(0,-300px,0);transform:translate3d(0,-300px,0);opacity:1}",""])},lO1W:function(t,a,s){"use strict";Object.defineProperty(a,"__esModule",{value:!0});function e(){if(document.documentElement.scrollHeight<=document.documentElement.clientHeight)return 0;var t=document.createElement("p");t.style.width="100%",t.style.height="200px";var a=document.createElement("div");a.style.position="absolute",a.style.top="0px",a.style.left="0px",a.style.visibility="hidden",a.style.width="200px",a.style.height="150px",a.style.overflow="hidden",a.appendChild(t),document.body.appendChild(a);var s=t.offsetWidth;a.style.overflow="scroll";var e=t.offsetWidth;return s===e&&(e=a.clientWidth),document.body.removeChild(a),s-e}a.default={props:{backdrop:{type:Boolean,default:!0},callback:{type:Function,default:null},cancelText:{type:String,default:"Close"},effect:{type:String,default:null},large:{type:Boolean,default:!1},okText:{type:String,default:"Save changes"},small:{type:Boolean,default:!1},title:{type:String,default:""},value:{type:Boolean,required:!0},width:{default:null}},data:function(){return{transition:!1,val:null}},computed:{optionalWidth:function(){return null===this.width?null:Number.isInteger(this.width)?this.width+"px":this.width}},watch:{transition:function(t,a){if(t!==a){var s=this.$el,o=document.body;t?this.val?(s.querySelector(".modal-content").focus(),s.style.display="block",setTimeout(function(){return s.classList.add("in")},0),o.classList.add("modal-open"),0!==e()&&(o.style.paddingRight=e()+"px")):s.classList.remove("in"):(this.$emit(this.val?"opened":"closed"),this.val||(s.style.display="none",o.style.paddingRight=null,o.classList.remove("modal-open")))}},val:function(t,a){this.$emit("input",t),(null===a?!0===t:t!==a)&&(this.transition=!0)},value:function(t,a){t!==a&&(this.val=t)}},methods:{action:function(t,a){null!==t&&(t&&this.callback instanceof Function&&this.callback(),this.$emit(t?"ok":"cancel",a),this.val=t||!1)}},mounted:function(){this.val=this.value}}},"n2B+":function(t,a,s){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var e=s("s9Db"),o=s("hlPV"),i=(s.n(o),s("FfMg"));s.n(i);function n(t,a,s){return a in t?Object.defineProperty(t,a,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[a]=s,t}a.default={mixins:[e.a],components:{TheMask:o.TheMask,Modal:i.Modal},props:{unique:{type:Boolean,default:!1},situacao:{type:String,default:""},idp:{type:String,default:""},dproc:{type:String,default:""},reu:{type:Boolean,default:!1}},data:function(){var t;return n(t={add:!1,cargo:"",nome:"",resultado:"",pm:[],proc:"",pms:[],finded:!1},"resultado",!1),n(t,"counter",0),n(t,"only",!1),n(t,"toEdit",""),n(t,"verReus",!1),n(t,"confirmModal",!1),t},filters:{vazio:function(t){return t||"Não há"},SN:function(t){var a=t||"-";return a.length<2?"S"==a.toUpperCase()||"Y"==a.toUpperCase()||1==a?"Sim":"Não":a}},mounted:function(){this.verifyOnly},created:function(){this.listPM()},watch:{rg:function(){this.rg.length>5?this.searchPM():this.clear(!0)}},computed:{verifyOnly:function(){this.only=1==this.unique},canEdit:function(){return this.$root.hasPermission("editar-acusado")},canDelete:function(){return this.$root.hasPermission("apagar-acusado")}},methods:{searchPM:function(){var t=this,a=this.$root.baseUrl+"api/dados/pm/"+this.rg;console.log(a),this.rg.length>5&&axios.get(a).then(function(a){a.data.success?(t.nome=a.data.pm.NOME||a.data.pm.nome,t.cargo=a.data.pm.CARGO||a.data.pm.cargo,t.finded=!0):(t.nome="",t.cargo="",t.finded=!1)}).catch(function(t){return console.log(t)})},listPM:function(){var t=this,a=this.$root.baseUrl+"api/dados/envolvido/"+this.dproc+"/"+this.idp+"/"+this.situacao;console.log(a),this.dproc&&this.idp&&this.situacao&&axios.get(a).then(function(a){t.pms=a.data;t.dproc,t.idp}).then(this.clear(!1)).catch(function(t){return console.log(t)})},createPM:function(){var t=this,a=this.$root.baseUrl+"api/acusado/store",s=document.getElementById("formAcusado"),e=new FormData(s);axios.post(a,e).then(function(a){return t.transation(a.data.success,"create")}).catch(function(t){return console.log(t)})},showPM:function(t){var a=this.$root.baseUrl+"fdi/"+t+"/ver";window.open(a,"_blank")},replacePM:function(t){this.rg=t.rg,this.nome=t.nome,this.cargo=t.cargo,this.resultado=t.resultado,this.toEdit=t.id_envolvido,this.add=!0},editPM:function(){var t=this,a=this.$root.baseUrl+"api/acusado/edit/"+this.toEdit,s=document.getElementById("formData"),e=new FormData(s);axios.post(a,e).then(function(a){return t.transation(a.data.success,"edit")}).catch(function(t){return console.log(t)})},removePM:function(t){var a=this;if(confirm("Você tem certeza?")){var s=this.$root.baseUrl+"api/acusado/destroy/"+t;axios.delete(s).then(function(t){return a.transation(t.data.success,"delete")}).catch(function(t){return console.log(t)})}},clear:function(t){this.add=t,this.rg="",this.nome="",this.cargo="",this.resultado="",this.toEdit="",this.finded=!1},transation:function(t,a){var s=this.words(a);t?(this.listPM(),this.$root.msg(s.success,"success"),this.registro=null,this.clear(!1)):this.$root.msg(s.fail,"danger")},words:function(t){return"create"==t?{success:"Inserido com sucesso",fail:"Erro ao inserir"}:"edit"==t?{success:"Editado com sucesso",fail:"Erro ao editar"}:"delete"==t?{success:"Apagado com sucesso",fail:"Erro ao apagar"}:void 0}}}},s9Db:function(t,a,s){"use strict";a.a={data:function(){return{add:!1}},methods:{list:function(){var t=this,a=this.$root.baseUrl+"api/"+this.module+"/list/"+this.rg;this.rg&&axios.get(a).then(function(a){t.registros=a.data}).catch(function(t){return console.log(t)})},create:function(){var t=this,a=this.$root.baseUrl+"api/"+this.module+"/store";axios.post(a,this.registro).then(function(a){t.transation(a.data.success,"create")}).catch(function(t){return console.log(t)}),this.showModal=!1},edit:function(t){this.registro=t,this.showModal=!0},update:function(t){var a=this,s=this.$root.baseUrl+"api/"+this.module+"/update/"+t;axios.put(s,this.registro).then(function(t){a.transation(t.data.success,"edit")}).catch(function(t){return console.log(t)})},destroy:function(t){var a=this;if(confirm("Você tem certeza?")){var s=this.$root.baseUrl+"api/"+this.module+"/destroy/"+t;axios.delete(s).then(function(t){a.transation(t.data.success,"delete")}).catch(function(t){return console.log(t)})}},transation:function(t,a){var s=this.words(a);this.showModal=!1,t?(this.list(),this.$root.msg(s.success,"success"),this.registro=[]):this.$root.msg(s.fail,"danger")},words:function(t){return"create"==t?{success:"Inserido com sucesso",fail:"Erro ao inserir"}:"edit"==t?{success:"Editado com sucesso",fail:"Erro ao editar"}:"delete"==t?{success:"Apagado com sucesso",fail:"Erro ao apagar"}:void 0}}}},wuYg:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{class:["modal",t.effect],attrs:{role:"dialog"},on:{click:function(a){t.backdrop&&t.action(!1,1)},transitionend:function(a){t.transition=!1}}},[s("div",{class:["modal-dialog",{"modal-lg":t.large,"modal-sm":t.small}],style:{width:t.optionalWidth},attrs:{role:"document"},on:{click:function(a){return a.stopPropagation(),t.action(null)}}},[s("div",{staticClass:"modal-content"},[t._t("modal-header",[s("div",{staticClass:"modal-header"},[s("button",{staticClass:"close",attrs:{type:"button"},on:{click:function(a){return t.action(!1,2)}}},[s("span",[t._v("×")])]),t._v(" "),s("h4",{staticClass:"modal-title"},[t._t("title",[t._v(t._s(t.title))])],2)])]),t._v(" "),t._t("modal-body",[s("div",{staticClass:"modal-body"},[t._t("default")],2)]),t._v(" "),t._t("modal-footer",[s("div",{staticClass:"modal-footer"},[s("button",{staticClass:"btn btn-default",attrs:{type:"button"},on:{click:function(a){return t.action(!1,3)}}},[t._v(t._s(t.cancelText))]),t._v(" "),s("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(a){return t.action(!0,4)}}},[t._v(t._s(t.okText))])])])],2)])])},staticRenderFns:[]}}});