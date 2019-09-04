webpackJsonp([64],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['rg'],
    data: function data() {
        return {
            apresentacoes: [],
            canCreate: false,
            apCondicao: [{ id: 1, name: "Testemunha" }, { id: 2, name: "Juiz Militar - Conselho Permanente" }, { id: 3, name: "Juiz Militar - Conselho Especial" }, { id: 4, name: "Réu" }, { id: 5, name: "Testemunha de Defesa" }, { id: 6, name: "Testemunha da Denúncia" }, { id: 7, name: "Testemunha de Acusação" }, { id: 8, name: "Testemunha do Juízo" }, { id: 9, name: "Outro" }, { id: 10, name: "Não informado" }],
            apSituacao: [{ id: 1, name: "Prevista" }, { id: 2, name: "Compareceu/Realizada" }, { id: 3, name: "Compareceu/Cancelada" }, { id: 4, name: "Compareceu/Redesignada" }, { id: 5, name: "Não compareceu" }, { id: 6, name: "Não compareceu/Justificado" }, { id: 7, name: "Redesignada" }, { id: 8, name: "Substituído (Cons. VAJME)" }, { id: 9, name: "Ag. Publicação" }, { id: 10, name: "Apagada" }],

            apTipoProcesso: [{ id: 1, name: "Ação Penal" }, { id: 2, name: "Ação Civil" }, { id: 3, name: "Não informado" }, { id: 4, name: "Não se aplica" }, { id: 5, name: "PM-IPM" }, { id: 6, name: "PM-Sindicância" }, { id: 7, name: "PM-FATD" }, { id: 8, name: "PM-Inquérito Técnico" }, { id: 9, name: "PM-CJ" }, { id: 10, name: "PM-CD" }, { id: 11, name: "PM-ADL" }, { id: 12, name: "PM-ISO" }, { id: 13, name: "PM-PAD" }, { id: 14, name: "PM-Outro " }, { id: 15, name: "Poder Judiciário " }, { id: 16, name: "Inquérito Policial" }, { id: 17, name: "VAJME" }]
        };
    },
    mounted: function mounted() {
        this.listApresentacoes();
        this.canCreate = this.$root.hasPermission('criar-apresentacao');
    },

    methods: {
        listApresentacoes: function listApresentacoes() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + "api/fdi/apresentacoes/" + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.apresentacoes = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        tipoProcesso: function tipoProcesso(id) {
            var search = this.apTipoProcesso[id + 1];
            return search.name;
        },
        condicao: function condicao(id) {
            var search = this.apCondicao[id + 1];
            return search.name;
        },
        situacao: function situacao(id) {
            var search = this.apSituacao[id + 1];
            return search.name;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-029684d4\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "Apresentações", badge: _vm.apresentacoes.lenght } },
    [
      _c("table", { staticClass: "table table-striped" }, [
        _c(
          "tbody",
          [
            _vm.apresentacoes.lenght
              ? [
                  _c("tr", [
                    _c("th", [_vm._v("N° Apres.")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("OPM")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("N° OF")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Pessoa")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Tipo")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Autos")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Condição")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Local")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Data/hora")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Situação")])
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.apresentacoes, function(apresentacao, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [
                        _vm._v(
                          _vm._s(apresentacao.sjd_ref) +
                            "/" +
                            _vm._s(apresentacao.sjd_ref_ano)
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "td",
                        [
                          apresentacao.opmsigla
                            ? [_vm._v(_vm._s(apresentacao.opmsigla))]
                            : [
                                _vm._v(
                                  _vm._s(
                                    apresentacao.pessoa_unidade_lotacao_sigla
                                  )
                                )
                              ]
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(apresentacao.documento_de_origem))
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(apresentacao.pessoa_posto) +
                            " " +
                            _vm._s(apresentacao.pessoa_quadro) +
                            " " +
                            _vm._s(apresentacao.pessoa_nome)
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(
                            _vm.tipoProcesso(
                              apresentacao.id_apresentacaotipoprocesso
                            )
                          )
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(apresentacao.autos_numero))]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(
                            _vm.condicao(apresentacao.id_apresentacaocondicao)
                          )
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(apresentacao.comparecimento_local_txt))
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(
                            _vm._f("date_br_hr")(apresentacao.comparecimento_dh)
                          )
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(
                            _vm.situacao(apresentacao.id_apresentacaosituacao)
                          )
                        )
                      ])
                    ])
                  })
                ]
              : [_c("tr", [_c("td", [_vm._v(" Não há registros.")])])]
          ],
          2
        )
      ]),
      _vm._v(" "),
      _vm.canCreate
        ? [
            _c(
              "button",
              {
                staticClass: "btn btn-primary btn-block",
                attrs: { type: "button" }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v("Adicionar Apresentação\n        ")
              ]
            )
          ]
        : _vm._e()
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-029684d4", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("5de33098", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Apresentacoes.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Apresentacoes.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Apresentacoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-029684d4\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-029684d4\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Apresentacoes.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-029684d4"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/FDI/Apresentacoes.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-029684d4", Component.options)
  } else {
    hotAPI.reload("data-v-029684d4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});