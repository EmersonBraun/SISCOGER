webpackJsonp([27],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue":
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
    mixins: [__WEBPACK_IMPORTED_MODULE_0__mixins_js__["a" /* default */]],
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_1_vue_the_mask__["TheMask"] },
    props: {
        unique: { type: Boolean, default: false },
        situacao: { type: String, default: '' },
        idp: { type: String, default: '' },
        dproc: { type: String, default: '' }
    },
    data: function data() {
        return {
            nome: '',
            cargo: '',
            pms: [],
            cls: false,
            resultado: false,
            counter: 0,
            only: false,
            edit: '',
            hasPM: false
        };
    },

    filters: {
        vazio: function vazio(value) {
            return !value ? 'Não há' : value;
        }
    },
    mounted: function mounted() {
        this.verifyOnly;
        this.listPM();
    },

    watch: {
        rg: function rg() {
            if (this.rg.length > 5) {
                this.searchPM();
            } else {
                this.clear(true);
            }
        }
    },
    computed: {
        verifyOnly: function verifyOnly() {
            if (this.unique == true) {
                this.only = true;
                this.cls = 'col-lg-3 col-md-3 col-xs-3';
            } else {
                this.only = false;
                this.cls = 'col-lg-2 col-md-2 col-xs-2';
            }
        }
    },
    methods: {
        searchPM: function searchPM() {
            var _this = this;

            var searchUrl = this.$root.baseUrl + 'api/dados/pm/' + this.rg;
            if (this.rg.length > 5) {
                axios.get(searchUrl).then(function (response) {
                    if (response.data.success) {
                        _this.nome = response.data['pm'].NOME || response.data['pm'].nome;
                        _this.cargo = response.data['pm'].CARGO || response.data['pm'].cargo;
                        _this.finded = true;
                    } else {
                        _this.nome = '';
                        _this.cargo = '';
                        _this.finded = false;
                    }
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        listPM: function listPM() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/dados/envolvido/' + this.dproc + '/' + this.idp + '/' + this.situacao;
            if (this.dproc && this.idp && this.situacao) {
                axios.get(urlIndex).then(function (response) {
                    _this2.pms = response.data;
                    if (_this2.pms.length) _this2.hasPM = true;
                    // console.log(response.data)
                }).then(this.clear(false)) //limpa a busca
                .catch(function (error) {
                    return console.log(error);
                });
            }
        },
        createPM: function createPM() {
            var urlCreate = this.$root.baseUrl + 'api/acusado/store';

            var formAcusadoUnico = document.getElementById('formAcusadoUnico');
            var data = new FormData(formAcusadoUnico);

            axios.post(urlCreate, data).then(this.listPM()).catch(function (error) {
                return console.log(error);
            });
        },
        showPM: function showPM(rg) {
            var urlIndex = this.$root.baseUrl + 'fdi/' + rg + '/ver';
            window.open(urlIndex, "_blank");
        },
        replacePM: function replacePM(pm) {
            this.hasPM = false;
            this.edit = pm.id_envolvido;
            this.rg = pm.rg, this.nome = pm.nome, this.cargo = pm.cargo, this.resultado = pm.resultado;
            // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
        },
        editPM: function editPM() {
            var _this3 = this;

            var urledit = this.$root.baseUrl + 'api/acusado/edit/' + this.edit;

            var formData = document.getElementById('formData');
            var data = new FormData(formData);

            axios.post(urledit, data).then(function () {
                _this3.listPM();
                _this3.clear(false);
            }).catch(function (error) {
                return console.log(error);
            });
        },
        clear: function clear() {
            this.rg = '';
            this.nome = '';
            this.cargo = '';
            this.resultado = '';
            this.edit = '';
            this.finded = false;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-36437e9c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-body" },
      [
        _vm.hasPM
          ? [
              _vm.pms.length
                ? _vm._l(_vm.pms, function(pm, index) {
                    return _c("div", { key: index }, [
                      _c("div", { staticClass: "col-lg-3 col-md-3 col-xs-3" }, [
                        _c("label", { attrs: { for: "nome" } }, [_vm._v("RG")]),
                        _c("br"),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(pm.rg))])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-3 col-md-3 col-xs-3" }, [
                        _c("label", { attrs: { for: "nome" } }, [
                          _vm._v("Nome")
                        ]),
                        _c("br"),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(pm.nome))])
                      ]),
                      _vm._v(" "),
                      _c("div", { class: _vm.cls }, [
                        _c("label", { attrs: { for: "cargo" } }, [
                          _vm._v("Posto/Graduação")
                        ]),
                        _c("br"),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(pm.cargo))])
                      ]),
                      _vm._v(" "),
                      _c("div", { class: _vm.cls }, [
                        _c("label", { attrs: { for: "resultado" } }, [
                          _vm._v("Resultado")
                        ]),
                        _c("br"),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(pm.situacao))])
                      ]),
                      _vm._v(" "),
                      !_vm.only
                        ? _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs-2" },
                            [
                              _c("label", [_vm._v("Editar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-success btn-block",
                                  on: {
                                    click: function($event) {
                                      return _vm.replacePM(pm)
                                    }
                                  }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-edit",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          )
                        : _vm._e()
                    ])
                  })
                : void 0
            ]
          : _c("div", [
              _c("div", { staticClass: "row", attrs: { id: "ligacaoForm1" } }, [
                _c(
                  "form",
                  {
                    attrs: { id: "formAcusadoUnico", name: "formAcusadoUnico" }
                  },
                  [
                    _c("input", {
                      attrs: { type: "hidden", name: "id_" + _vm.dproc },
                      domProps: { value: _vm.idp }
                    }),
                    _vm._v(" "),
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
                          model: {
                            value: _vm.rg,
                            callback: function($$v) {
                              _vm.rg = $$v
                            },
                            expression: "rg"
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
                        staticClass: "numero form-control",
                        attrs: { type: "text", name: "nome", readonly: "" },
                        domProps: { value: _vm.nome }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-lg-2 col-md-2 col-xs-2" }, [
                      _c("label", { attrs: { for: "cargo" } }, [
                        _vm._v("Posto/Graduação")
                      ]),
                      _c("br"),
                      _vm._v(" "),
                      _c("input", {
                        staticClass: "numero form-control",
                        attrs: { type: "text", name: "cargo", readonly: "" },
                        domProps: { value: _vm.cargo }
                      })
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-lg-2 col-md-2 col-xs-2" },
                      [
                        _c("label", { attrs: { for: "resultado" } }, [
                          _vm._v("Resultado")
                        ]),
                        _c("br"),
                        _vm._v(" "),
                        _vm.situacao
                          ? [
                              _c("input", {
                                staticClass: "numero form-control",
                                attrs: {
                                  type: "text",
                                  name: "situacao",
                                  readonly: ""
                                },
                                domProps: { value: _vm.situacao }
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
                                        .call($event.target.options, function(
                                          o
                                        ) {
                                          return o.selected
                                        })
                                        .map(function(o) {
                                          var val =
                                            "_value" in o ? o._value : o.value
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
                                  _c(
                                    "option",
                                    { attrs: { value: "Excluído" } },
                                    [_vm._v("Excluído")]
                                  ),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "Punido" } }, [
                                    _vm._v("Punido")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Absolvido" } },
                                    [_vm._v("Absolvido")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Perda objeto" } },
                                    [_vm._v("Perda objeto")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Prescricao" } },
                                    [_vm._v("Prescricao")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    {
                                      attrs: { value: "Reintegrado/Reinserido" }
                                    },
                                    [_vm._v("Reintegrado/Reinserido")]
                                  )
                                ]
                              )
                            ]
                      ],
                      2
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-lg-1 col-md-1 col-xs-1" },
                      [
                        !_vm.edit
                          ? [
                              _c("label", [_vm._v("Cancelar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-danger btn-block",
                                  on: {
                                    click: function($event) {
                                      return _vm.clear(true)
                                    }
                                  }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-times",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          : [
                              _c("label", [_vm._v("Cancelar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-danger btn-block",
                                  on: {
                                    click: function($event) {
                                      _vm.hasPM = !_vm.hasPM
                                    }
                                  }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-times",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                      ],
                      2
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-lg-1 col-md-1 col-xs-1" },
                      [
                        !_vm.edit
                          ? [
                              _c("label", [_vm._v("Editar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-success btn-block",
                                  attrs: { disabled: !_vm.resultado },
                                  on: { click: _vm.editPM }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-plus",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          : [
                              _c("label", [_vm._v("Adicionar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-success btn-block",
                                  attrs: { disabled: !_vm.resultado },
                                  on: { click: _vm.createPM }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-plus",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                      ],
                      2
                    )
                  ]
                )
              ])
            ])
      ],
      2
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h5", [_c("b", [_vm._v("Acusado")])])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-36437e9c", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("0c2ce9e8", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AcusadoUnico.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AcusadoUnico.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/AcusadoUnico.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-36437e9c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-36437e9c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/AcusadoUnico.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-36437e9c"
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
Component.options.__file = "resources/assets/js/components/SubForm/AcusadoUnico.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-36437e9c", Component.options)
  } else {
    hotAPI.reload("data-v-36437e9c", Component.options)
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
            add: false
        };
    },

    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        create: function create() {
            var _this2 = this;

            var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
            axios.post(urlCreate, this.registro).then(function (response) {
                _this2.transation(response.data.success, 'create');
            }).catch(function (error) {
                return console.log(error);
            });
            this.showModal = false;
        },
        edit: function edit(registro) {
            this.registro = registro;
            this.showModal = true;
        },
        update: function update(id) {
            var _this3 = this;

            var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
            axios.put(urlUpdate, this.registro).then(function (response) {
                _this3.transation(response.data.success, 'edit');
            }).catch(function (error) {
                return console.log(error);
            });
        },
        destroy: function destroy(id) {
            var _this4 = this;

            if (confirm('Você tem certeza?')) {
                var urlDelete = this.$root.baseUrl + 'api/' + this.module + '/destroy/' + id;
                axios.delete(urlDelete).then(function (response) {
                    _this4.transation(response.data.success, 'delete');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        transation: function transation(happen, type) {
            var msg = this.words(type);
            this.showModal = false;
            if (happen) {
                // se deu certo
                this.list();
                this.$root.msg(msg.success, 'success');
                this.registro = [];
            } else {
                // se falhou
                this.$root.msg(msg.fail, 'danger');
            }
        },
        words: function words(type) {
            if (type == 'create') return { success: 'Inserido com sucesso', fail: 'Erro ao inserir' };
            if (type == 'edit') return { success: 'Editado com sucesso', fail: 'Erro ao editar' };
            if (type == 'delete') return { success: 'Apagado com sucesso', fail: 'Erro ao apagar' };
        }
    }
});

/***/ })

});