webpackJsonp([25],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_js__ = __webpack_require__("./resources/assets/js/mixins.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_the_mask__ = __webpack_require__("./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_the_mask___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_vue_the_mask__);
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
    mixins: [__WEBPACK_IMPORTED_MODULE_0__mixins_js__["a" /* default */]],
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_1_vue_the_mask__["TheMask"] },
    props: {
        situacao: { type: String, default: '' },
        idp: { type: String, default: '' },
        rg: { type: String },
        cargo: { type: String },
        nome: { type: String }
    },
    data: function data() {
        return {
            prg: this.rg,
            pnome: this.nome,
            pcargo: this.cargo,
            proc: '',
            finded: false
        };
    },

    computed: {},
    methods: {
        searchPM: function searchPM() {
            var _this = this;

            var searchUrl = this.getBaseUrl + 'api/dados/pm/' + this.rg;
            if (this.prg.length > 5) {
                axios.get(searchUrl).then(function (response) {
                    if (response.data.success) {
                        _this.pnome = response.data['pm'].NOME;
                        _this.pcargo = response.data['pm'].CARGO;
                        _this.finded = true;
                    } else {
                        _this.pnome = '';
                        _this.pcargo = '';
                        _this.finded = false;
                    }
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        clear: function clear() {
            this.pnome = '';
            this.pcargo = '';
            this.finded = false;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5293004f\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _c("div", { staticClass: "card-body" }, [
      _c("div", { staticClass: "row", attrs: { id: "ligacaoForm1" } }, [
        _c("form", { attrs: { id: "formData", name: "formData" } }, [
          _c(
            "div",
            { staticClass: "col-lg-3 col-md-3 col-xs-3" },
            [
              _c("label", { attrs: { for: "rg" } }, [_vm._v("RG")]),
              _c("br"),
              _vm._v(" "),
              _c("the-mask", {
                staticClass: "form-control",
                attrs: {
                  mask: "############",
                  type: "text",
                  maxlength: "12",
                  name: "rg",
                  placeholder: "Nº"
                },
                on: { change: _vm.searchPM },
                model: {
                  value: _vm.prg,
                  callback: function($$v) {
                    _vm.prg = $$v
                  },
                  expression: "prg"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 col-md-3 col-xs-3" }, [
            _c("label", { attrs: { for: "nome" } }, [_vm._v("Nome")]),
            _c("br"),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.pnome,
                  expression: "pnome"
                }
              ],
              staticClass: "numero form-control",
              attrs: { type: "text", name: "nome", readonly: "" },
              domProps: { value: _vm.pnome },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.pnome = $event.target.value
                }
              }
            })
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 col-md-3 col-xs-3" }, [
            _c("label", { attrs: { for: "cargo" } }, [
              _vm._v("Posto/Graduação")
            ]),
            _c("br"),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.pcargo,
                  expression: "pcargo"
                }
              ],
              staticClass: "numero form-control",
              attrs: { type: "text", name: "cargo", readonly: "" },
              domProps: { value: _vm.pcargo },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.pcargo = $event.target.value
                }
              }
            })
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "col-lg-3 col-md-3 col-xs-3" },
            [
              _c("label", { attrs: { for: "resultado" } }, [
                _vm._v("Resultado")
              ]),
              _c("br"),
              _vm._v(" "),
              _vm.situacao
                ? [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.situacao,
                          expression: "situacao"
                        }
                      ],
                      staticClass: "numero form-control",
                      attrs: { type: "text", name: "situacao", readonly: "" },
                      domProps: { value: _vm.situacao },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.situacao = $event.target.value
                        }
                      }
                    })
                  ]
                : [
                    _c(
                      "select",
                      {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.resultado,
                            expression: "resultado"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          name: "resultado",
                          disabled: !_vm.finded,
                          required: ""
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
                            _vm.resultado = $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          }
                        }
                      },
                      [
                        _c("option", { attrs: { value: "" } }, [
                          _vm._v("Selecione")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "Excluído" } }, [
                          _vm._v("Excluído")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "Punido" } }, [
                          _vm._v("Punido")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "Absolvido" } }, [
                          _vm._v("Absolvido")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "Perda objeto" } }, [
                          _vm._v("Perda objeto")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "Prescricao" } }, [
                          _vm._v("Prescricao")
                        ]),
                        _vm._v(" "),
                        _c(
                          "option",
                          { attrs: { value: "Reintegrado/Reinserido" } },
                          [_vm._v("Reintegrado/Reinserido")]
                        )
                      ]
                    )
                  ]
            ],
            2
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5293004f", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("47a260cf", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AcusadoRg.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AcusadoRg.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/AcusadoRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5293004f\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5293004f\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/AcusadoRg.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5293004f"
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
Component.options.__file = "resources/assets/js/components/SubForm/AcusadoRg.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5293004f", Component.options)
  } else {
    hotAPI.reload("data-v-5293004f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/mixins.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
    data: function data() {
        return {
            action: '',
            dproc: '',
            dref: '',
            dano: '',
            add: false,
            admin: false,
            rg: '',
            roles: [],
            permissions: []
        };
    },

    computed: {
        getBaseUrl: function getBaseUrl() {
            // URL completa
            var getUrl = window.location;
            // dividir em array
            var pathname = getUrl.pathname.split('/');
            this.action = pathname[3];
            this.dproc = pathname[2];
            this.dref = pathname[4];
            this.dano = pathname[5] || false;

            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + pathname[1] + '/';

            return baseUrl;
        }
    },
    methods: {
        dadosSession: function dadosSession() {
            var session = this.$root.getSessionData();
            this.admin = session.is_admin;
            this.rg = session.rg;
            this.permissions = session.permissions;
            this.roles = session.roles;
        }
    }
});

/***/ })

});