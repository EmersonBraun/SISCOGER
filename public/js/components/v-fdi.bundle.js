webpackJsonp([60],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/FDI.vue":
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
            comportamentos: [],
            elogios: [],
            canSeeComportamentos: false,
            canCreateComportamento: false,
            canSeeElogios: false,
            canCreateElogio: false
        };
    },
    mounted: function mounted() {
        this.listComportamentos();
        this.listElogios();
        this.canSeeComportamentos = this.$root.hasPermission('ver-mudanca-comportamento');
        this.canCreateComportamento = this.$root.hasPermission('criar-mudanca-comportamento');
        this.canSeeElogios = this.$root.hasPermission('ver-elogios');
        this.canCreateElogio = this.$root.hasPermission('criar-elogio');
    },

    computed: {
        elogiosLenght: function elogiosLenght() {
            return Object.keys(this.elogios).length;
        },
        comportamentosLenght: function comportamentosLenght() {
            return Object.keys(this.comportamentos).length;
        }
    },
    methods: {
        listComportamentos: function listComportamentos() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/comportamentos/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.comportamentos = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        listElogios: function listElogios() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/elogios/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this2.elogios = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/FDI.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7e269180\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/FDI.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "FDI", badge: _vm.elogiosLenght } },
    [
      _vm.canSeeComportamentos
        ? [
            _c("table", { staticClass: "table table-striped" }, [
              _c("h4", { staticClass: "text-center text-bold" }, [
                _vm._v("Mudanças de Comportamento")
              ]),
              _vm._v(" "),
              _c(
                "tbody",
                [
                  _vm.comportamentosLenght
                    ? [
                        _c("tr", [
                          _c("th", [_c("b", [_vm._v("Data:")])]),
                          _vm._v(" "),
                          _c("th", [_c("b", [_vm._v("Novo comportamento:")])]),
                          _vm._v(" "),
                          _c("th", [_c("b", [_vm._v("Sintese:")])]),
                          _vm._v(" "),
                          _c("th", [_c("b", [_vm._v("Publicacao:")])])
                        ]),
                        _vm._v(" "),
                        _vm._l(_vm.comportamentos, function(
                          comportamento,
                          index
                        ) {
                          return _c("tr", { key: index }, [
                            _c("td", [
                              _vm._v(
                                _vm._s(_vm._f("date_br")(comportamento.data))
                              )
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(_vm._s(comportamento.comportamento))
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(_vm._s(comportamento.motivo_txt))
                            ]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(comportamento.publicacao))])
                          ])
                        })
                      ]
                    : [
                        _c("tr", [
                          _c("td", [
                            _vm._v("Não há mudanças de comportamento.")
                          ])
                        ])
                      ]
                ],
                2
              )
            ]),
            _vm._v(" "),
            _vm.canCreateComportamento
              ? [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary btn-block",
                      attrs: { type: "button" }
                    },
                    [
                      _c("i", { staticClass: "fa fa-plus" }),
                      _vm._v("Adicionar mudança de comportamento\n            ")
                    ]
                  )
                ]
              : _vm._e()
          ]
        : _vm._e(),
      _vm._v(" "),
      _vm.canSeeElogios
        ? [
            _c("table", { staticClass: "table table-striped" }, [
              _c("h4", { staticClass: "text-center text-bold" }, [
                _vm._v("Elogios")
              ]),
              _vm._v(" "),
              _c(
                "tbody",
                [
                  _vm.elogiosLenght
                    ? [
                        _c("tr", [
                          _c("th", [_c("b", [_vm._v("Data:")])]),
                          _vm._v(" "),
                          _c("th", [_c("b", [_vm._v("OPM:")])]),
                          _vm._v(" "),
                          _c("th", [_c("b", [_vm._v("Sintese:")])])
                        ]),
                        _vm._v(" "),
                        _vm._l(_vm.elogios, function(elogio, index) {
                          return _c("tr", { key: index }, [
                            _c("td", [
                              _vm._v(
                                _vm._s(_vm._f("date_br")(elogio.elogio_data))
                              )
                            ]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(elogio.opm_abreviatura))]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(elogio.descricao_txt))])
                          ])
                        })
                      ]
                    : [_c("tr", [_c("td", [_vm._v("Não há Elogios.")])])]
                ],
                2
              )
            ]),
            _vm._v(" "),
            _vm.canCreateElogio
              ? [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary btn-block",
                      attrs: { type: "button" }
                    },
                    [
                      _c("i", { staticClass: "fa fa-plus" }),
                      _vm._v("Adicionar Elogio\n            ")
                    ]
                  )
                ]
              : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-7e269180", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/FDI.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/FDI.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("f69541e2", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FDI.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FDI.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/FDI.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e269180\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/FDI.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/FDI.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7e269180\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/FDI.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7e269180"
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
Component.options.__file = "resources/assets/js/components/FDI/FDI.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7e269180", Component.options)
  } else {
    hotAPI.reload("data-v-7e269180", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});