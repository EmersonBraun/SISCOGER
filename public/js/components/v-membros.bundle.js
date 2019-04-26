webpackJsonp([0],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Membros.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_the_mask__ = __webpack_require__("./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_the_mask___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue_the_mask__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_0_vue_the_mask__["TheMask"] },
    props: {
        unique: { type: Boolean, default: false },
        idp: { type: String, default: '' }
    },
    data: function data() {
        return {
            rg: '',
            nome: '',
            cargo: '',
            proc: '',
            dproc: '',
            dref: 0,
            dano: 0,
            action: '',
            pms: [],
            add: false,
            finded: false,
            situacao: false,
            counter: 0,
            only: false
        };
    },
    mounted: function mounted() {
        this.verifyOnly;
        this.listPM();
    },

    watch: {
        rg: function rg() {
            this.searchPM();
        }
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
            this.dano = pathname[5];

            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1] + "/";

            return baseUrl;
        },
        verifyOnly: function verifyOnly() {
            if (this.unique == true) {
                this.only = true;
            } else {
                this.only = false;
            }
        }
    },
    methods: {
        searchPM: function searchPM() {
            var _this = this;

            this.clear;

            var searchUrl = this.getBaseUrl + 'api/dados/pm/' + this.rg;
            if (this.rg.length > 5) {
                axios.get(searchUrl).then(function (response) {
                    if (response.data.success) {
                        _this.nome = response.data['pm'].NOME;
                        _this.cargo = response.data['pm'].CARGO;
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

            this.clear();
            var urlIndex = this.getBaseUrl + 'api/dados/membros/' + this.dproc + '/' + this.idp;
            if (this.dproc && this.idp) {
                axios.get(urlIndex).then(function (response) {
                    _this2.pms = response.data;
                    // console.log(response.data)
                }).then(this.clear) //limpa a busca
                .catch(function (error) {
                    return console.log(error);
                });
            }
        },
        createPM: function createPM() {
            var urlCreate = this.getBaseUrl + 'api/membros/store';

            var formData = document.getElementById('formData');
            var data = new FormData(formData);

            axios.post(urlCreate, data).then(this.listPM()).catch(function (error) {
                return console.log(error);
            });
        },
        showPM: function showPM(rg) {
            var urlIndex = this.getBaseUrl + 'fdi/' + rg + '/ver';
            window.open(urlIndex, "_blank");
        },

        // apagar arquivo
        removePM: function removePM(id) {
            var urlDelete = this.getBaseUrl + 'api/membros/destroy/' + id;
            axios.delete(urlDelete).catch(function (error) {
                return console.log(error);
            });
            this.listPM();
        },
        cancel: function cancel() {
            this.add = false;
            this.rg = '';
            this.nome = '';
            this.cargo = '';
            this.situacao = '';
            this.finded = false;
        },
        clear: function clear() {
            this.rg = '';
            this.nome = '';
            this.cargo = '';
            this.situacao = '';
            this.finded = false;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membros.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-6f3da597\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Membros.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _vm._m(0),
    _vm._v(" "),
    !_vm.only
      ? _c(
          "div",
          { staticClass: "card-body", class: _vm.add ? "bordaform" : "" },
          [
            !_vm.add
              ? _c("div", [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-block",
                      on: {
                        click: function($event) {
                          _vm.add = !_vm.add
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fa fa-plus" }),
                      _vm._v(" Adicionar membro")
                    ]
                  )
                ])
              : _c("div", [
                  _c(
                    "div",
                    { staticClass: "row", attrs: { id: "ligacaoForm1" } },
                    [
                      _c(
                        "form",
                        { attrs: { id: "formData", name: "formData" } },
                        [
                          _c("input", {
                            attrs: { type: "hidden", name: "id_" + _vm.dproc },
                            domProps: { value: _vm.idp }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "situacao" },
                            domProps: { value: _vm.situacao }
                          }),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-3 col-md-4 col-xs 4" },
                            [
                              _c("label", { attrs: { for: "rg" } }, [
                                _vm._v("RG")
                              ]),
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
                          _c(
                            "div",
                            { staticClass: "col-lg-3 col-md-2 col-xs 2" },
                            [
                              _c("label", { attrs: { for: "nome" } }, [
                                _vm._v("Nome")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                staticClass: "numero form-control",
                                attrs: {
                                  type: "text",
                                  name: "nome",
                                  readonly: ""
                                },
                                domProps: { value: _vm.nome }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c("label", { attrs: { for: "cargo" } }, [
                                _vm._v("Posto/Graduação")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                staticClass: "numero form-control",
                                attrs: {
                                  type: "text",
                                  name: "cargo",
                                  readonly: ""
                                },
                                domProps: { value: _vm.cargo }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c("label", { attrs: { for: "situacao" } }, [
                                _vm._v("Situação")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "select",
                                {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.situacao,
                                      expression: "situacao"
                                    }
                                  ],
                                  staticClass: "form-control",
                                  attrs: {
                                    name: "situacao",
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
                                      _vm.situacao = $event.target.multiple
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
                                    { attrs: { value: "Acusador" } },
                                    [_vm._v("Acusador")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Defensor" } },
                                    [_vm._v("Defensor")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Encarregado" } },
                                    [_vm._v("Encarregado")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Escrivão" } },
                                    [_vm._v("Escrivão")]
                                  ),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "Membro" } }, [
                                    _vm._v("Membro")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "Presidente" } },
                                    [_vm._v("Presidente")]
                                  )
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-1 col-md-1 col-xs 1" },
                            [
                              _c("label", [_vm._v("Cancelar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-danger btn-block",
                                  on: { click: _vm.cancel }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-times",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-1 col-md-1 col-xs 1" },
                            [
                              _c("label", [_vm._v("Adicionar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-success btn-block",
                                  attrs: { disabled: !_vm.situacao },
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
                          )
                        ]
                      )
                    ]
                  )
                ])
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "card-footer" }, [
      _vm.pms.length
        ? _c("div", { staticClass: "row bordaform" }, [
            _c("div", { staticClass: "col-sm-12" }, [
              _c("table", { staticClass: "table table-hover" }, [
                _vm._m(1),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.pms, function(pm, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [_vm._v(_vm._s(index + 1))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(pm.rg))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(pm.nome))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(pm.cargo))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(pm.situacao))]),
                      _vm._v(" "),
                      _c("td", [
                        _c(
                          "div",
                          {
                            staticClass: "btn-group",
                            attrs: {
                              role: "group",
                              "aria-label": "First group"
                            }
                          },
                          [
                            _c(
                              "a",
                              {
                                staticClass: "btn btn-primary",
                                staticStyle: { color: "white" },
                                attrs: { type: "button", target: "_blanck" },
                                on: {
                                  click: function($event) {
                                    return _vm.showPM(pm.rg)
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-eye" })]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "btn btn-danger",
                                staticStyle: { color: "white" },
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    return _vm.removePM(pm.id_envolvido)
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-trash" })]
                            )
                          ]
                        )
                      ])
                    ])
                  }),
                  0
                )
              ])
            ])
          ])
        : !_vm.pms.length && _vm.only
        ? _c("div", [_vm._m(2)])
        : _vm._e()
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h5", [_c("b", [_vm._v("Membros")])])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("RG")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Nome")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Posto/Grad.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Situação")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ver/Apagar Ligação")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Não há registtros")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6f3da597", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membros.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membros.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("1357670e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Membros.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Membros.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/Membros.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f3da597\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membros.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Membros.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-6f3da597\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Membros.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-6f3da597"
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
Component.options.__file = "resources/assets/js/components/SubForm/Membros.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6f3da597", Component.options)
  } else {
    hotAPI.reload("data-v-6f3da597", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});