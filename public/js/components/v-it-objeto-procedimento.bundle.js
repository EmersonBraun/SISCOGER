webpackJsonp([56],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue":
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
    data: function data() {
        return {
            op: 'viatura'
        };
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5a1608d6\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "v-label",
        {
          attrs: {
            label: "id_objetoprocedimento",
            title: "Objeto do procedimento"
          }
        },
        [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.op,
                  expression: "op"
                }
              ],
              staticClass: "form-control",
              attrs: {
                id: "id_objetoprocedimento",
                name: "objetoprocedimento",
                required: "true"
              },
              on: {
                change: function($event) {
                  var $$selectedVal = Array.prototype.filter
                    .call($event.target.options, function(o) {
                      return o.selected
                    })
                    .map(function(o) {
                      var val = "_value" in o ? o._value : o.value
                      return val
                    })
                  _vm.op = $event.target.multiple
                    ? $$selectedVal
                    : $$selectedVal[0]
                }
              }
            },
            [
              _c("option", { attrs: { value: "" } }, [_vm._v("Selecione")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "arma" } }, [_vm._v("arma")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "munição" } }, [
                _vm._v("munição")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "semovente" } }, [
                _vm._v("semovente")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "viatura" } }, [
                _vm._v("viatura")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "outros" } }, [_vm._v("outros")])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.op === "viatura"
        ? [
            _c(
              "v-label",
              {
                attrs: {
                  label: "vtr_placa",
                  title: "Placa da viatura (sem traço)"
                }
              },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: { id: "vtr_placa", name: "vtr_placa", type: "text" }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "v-label",
              { attrs: { label: "vtr_prefixo", title: "Prefixo da viatura" } },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: {
                    id: "vtr_prefixo",
                    name: "vtr_prefixo",
                    type: "text"
                  }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "v-label",
              { attrs: { label: "tipo_acidente", title: "Tipo acidente" } },
              [
                _c(
                  "select",
                  {
                    staticClass: "form-control",
                    attrs: { name: "tipo_acidente" }
                  },
                  [
                    _c("option", { attrs: { value: "-" } }, [_vm._v("-")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "nao identificado" } }, [
                      _vm._v("Não identificado")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "abalroamento lateral" } }, [
                      _vm._v("Abalroamento lateral")
                    ]),
                    _vm._v(" "),
                    _c(
                      "option",
                      { attrs: { value: "abalroamento transversal" } },
                      [_vm._v("Abalroamento transversal")]
                    ),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "atropelamento" } }, [
                      _vm._v("Atropelamento")
                    ]),
                    _vm._v(" "),
                    _c(
                      "option",
                      { attrs: { value: "atropelamento de animal" } },
                      [_vm._v("Atropelamento de animal")]
                    ),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "capotamento" } }, [
                      _vm._v("Capotamento")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "colisao frontal" } }, [
                      _vm._v("Colisão frontal")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "colisao traseira" } }, [
                      _vm._v("Colisão traseira")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "choque" } }, [
                      _vm._v("Choque")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "engavetamento" } }, [
                      _vm._v("Engavetamento")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "incendio" } }, [
                      _vm._v("Incêndio")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "queda de passageiro" } }, [
                      _vm._v("Queda de passageiro")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "queda de objeto" } }, [
                      _vm._v("Queda de objeto")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "queda de moto" } }, [
                      _vm._v("Queda de moto")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "queda de veiculo" } }, [
                      _vm._v("Queda de veículo")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "tombamento" } }, [
                      _vm._v("Tombamento")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "acidente complexo" } }, [
                      _vm._v("Acidente complexo")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "nao identificado" } }, [
                      _vm._v("Não identificado")
                    ])
                  ]
                )
              ]
            ),
            _vm._v(" "),
            _c("v-label", { attrs: { label: "avarias", title: "Avarias" } }, [
              _c(
                "select",
                { staticClass: "form-control", attrs: { name: "avarias" } },
                [
                  _c("option", { attrs: { value: "" } }, [_vm._v("Selecione")]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "Pequena Monta" } }, [
                    _vm._v("Pequena Monta")
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "Media Monta" } }, [
                    _vm._v("Media Monta")
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "Grande Monta" } }, [
                    _vm._v("Grande Monta")
                  ])
                ]
              )
            ]),
            _vm._v(" "),
            _c(
              "v-label",
              {
                attrs: { label: "situacaoviatura", title: "Situação Viatura" }
              },
              [
                _c(
                  "select",
                  {
                    staticClass: "form-control",
                    attrs: { name: "situacaoviatura" }
                  },
                  [
                    _c("option", { attrs: { value: "nao informado" } }, [
                      _vm._v("Não informado")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "consertada com onus" } }, [
                      _vm._v("Consertada com ônus")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "consertada sem onus" } }, [
                      _vm._v("Consertada sem ônus")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "inservivel" } }, [
                      _vm._v("Inservível")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "aguarda conserto" } }, [
                      _vm._v("Aguarda conserto")
                    ])
                  ]
                )
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _vm.op === "arma"
        ? [
            _c(
              "v-label",
              {
                attrs: {
                  label: "identificacao_arma",
                  title: "Identificação da arma"
                }
              },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: {
                    id: "identificacao_arma",
                    name: "vtr_placa",
                    type: "text"
                  }
                })
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _vm.op === "munição"
        ? [
            _c(
              "v-label",
              {
                attrs: {
                  label: "identificacao_municao",
                  title: "Identificação da munição"
                }
              },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: {
                    id: "identificacao_municao",
                    name: "vtr_placa",
                    type: "text"
                  }
                })
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _vm.op === "semovente"
        ? [
            _c(
              "v-label",
              {
                attrs: {
                  label: "identificacao_semovente",
                  title: "Identificação do semovente"
                }
              },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: {
                    id: "identificacao_semovente",
                    name: "vtr_placa",
                    type: "text"
                  }
                })
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _vm.op === "outros"
        ? [
            _c(
              "v-label",
              { attrs: { label: "outros", title: "Identificação Outros" } },
              [
                _c("input", {
                  staticClass: "form-control ",
                  attrs: { id: "outros", name: "vtr_placa", type: "text" }
                })
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
    require("vue-hot-reload-api")      .rerender("data-v-5a1608d6", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("0374e049", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ItObjetoProcedimento.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ItObjetoProcedimento.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Form/ItObjetoProcedimento.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5a1608d6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5a1608d6\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/ItObjetoProcedimento.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5a1608d6"
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
Component.options.__file = "resources/assets/js/components/Form/ItObjetoProcedimento.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5a1608d6", Component.options)
  } else {
    hotAPI.reload("data-v-5a1608d6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});