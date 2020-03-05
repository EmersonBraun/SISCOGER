webpackJsonp([50],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/SugestRg.vue":
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


/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            rg: '',
            name: '',
            onSearch: true,
            found: {},
            type: '',
            tables: ['ativos'],
            result: [],
            permissions: {},
            hasPermissions: false
        };
    },
    mounted: function mounted() {
        var session = this.$root.getSessionData();
        var verAtivo = Object.values(session.permissions).filter(function (s) {
            return s == 'ver-inativo';
        });
        var verReserva = Object.values(session.permissions).filter(function (s) {
            return s == 'ver-reserva';
        });
        var todasUnidades = Object.values(session.permissions).filter(function (s) {
            return s == 'todas-unidades';
        });
        this.permissions = {
            inativos: verAtivo,
            reserva: verReserva,
            unidades: todasUnidades
        };
        this.hasPermissions = Object.keys(this.permissions).length ? true : false;
    },

    watch: {
        rg: function rg() {
            if (this.rg.length > 2) {
                this.type = 'rg';
                this.search(this.rg);
            } else {
                this.type = '';
                this.result = [];
            }
        },
        name: function name() {
            if (this.name.length > 2) {
                this.type = 'nome';
                this.search(this.name);
            } else {
                this.type = '';
                this.result = [];
            }
        }
    },
    methods: {
        search: function search(val) {
            var _this = this;

            var urlSearch = this.$root.baseUrl + 'api/dados/sugest';
            var search = val; //valor procurado

            // objeto para ser enviado ao controller
            var data = {
                search: val,
                type: this.type,
                tables: this.tables,
                outrasOpms: this.permissions.unidades,
                opts: this.tables.length
            };

            if (this.onSearch) {
                axios.post(urlSearch, data).then(function (response) {
                    var res = response.data.data;
                    if (res.length) _this.result = res;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        sugestList: function sugestList(type) {
            this.type = type;
        },
        completaInput: function completaInput(item) {
            this.type = '';
            this.onSearch = false;

            this.found = {
                rg: item.rg,
                nome: item.nome
            };

            this.result = [];
        },
        reset: function reset() {
            this.onSearch = true;
            this.type = '';
            this.found = {};
            this.result = [];
            this.rg = '';
            this.name = '';
        },
        goToFdi: function goToFdi(rg) {
            window.location.href = this.$root.baseUrl + 'fdi/' + rg + '/ver';
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ninput[type=\"checkbox\"], input[type=\"radio\"] {\n    box-sizing: border-box;\n    padding: 0;\n}\n.custom-control-input {\n    position: absolute;\n    z-index: -1;\n    opacity: 0;\n}\n.funkyradio div {\nclear: both;\noverflow: hidden;\n}\n.funkyradio label {\nborder-radius: 3px;\nfont-weight: normal;\n}\n.funkyradio input[type=\"checkbox\"]:empty {\ndisplay: none;\n}\n.funkyradio input[type=\"checkbox\"]:empty ~ label {\nposition: relative;\nline-height: 2em;\ntext-indent: 2.5em;\nmargin-top: .3em;\ncursor: pointer;\n-webkit-user-select: none;\n    -moz-user-select: none;\n    -ms-user-select: none;\n        user-select: none;\n}\n.funkyradio input[type=\"checkbox\"]:empty ~ label:before {\nposition: absolute;\ndisplay: inline;\ntop: 0;\nbottom: 0;\nleft: 0;\ncontent: '';\n/* width: 2em; */\nbackground: #D1D3D4;\nborder-radius: 3px;\n}\n.funkyradio input[type=\"checkbox\"]:hover:not(:checked) ~ label {\ncolor: #888;\n}\n.funkyradio input[type=\"checkbox\"]:hover:not(:checked) ~ label:before {\ncontent: '\\2714';\ntext-indent: .6em;\ncolor: #C2C2C2;\n}\n.funkyradio input[type=\"checkbox\"]:checked ~ label {\ncolor: #777;\n}\n.funkyradio input[type=\"checkbox\"]:checked ~ label:before {\ncontent: '\\2714';\ntext-indent: .6em;\ncolor: #333;\nbackground-color: #ccc;\n}\n.funkyradio input[type=\"checkbox\"]:focus ~ label:before {\nbox-shadow: 0 0 0 3px #999;\n}\n.funkyradio-default input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #333;\nbackground-color: #ccc;\n}\n.funkyradio-primary input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #337ab7;\n}\n.funkyradio-success input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #5cb85c;\n}\n.funkyradio-danger input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #d9534f;\n}\n.funkyradio-warning input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #f0ad4e;\n}\n.funkyradio-info input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #5bc0de;\n}\n.vue-simple-suggest > ul {\nlist-style: none;\nmargin: 0;\npadding: 0;\n}\n.vue-simple-suggest{\nposition: relative;\n}\n.vue-simple-suggest.designed, * {\nbox-sizing: border-box;\n}\n.input-wrapper input {\ndisplay: block;\nwidth: 100%;\npadding: 10px;\nborder: 1px solid #cde;\nborder-radius: 3px;\ncolor: black;\nbackground: white;\noutline:none;\ntransition: all .1s;\ntransition-delay: .05s\n}\n.vue-simple-suggest.designed:focus .input-wrapper input {\noutline: 2px solid #2874D5;\n}\n.suggestions {\nposition: absolute;\nleft: 0;\nright: 0;\ntop: 100%;\ntop: calc(100% + 5px);\nborder-radius: 3px;\nborder: 1px solid #aaa;\nbackground-color: #fff;\nopacity: 1;\nz-index: 1000;\n}\n.suggestions .suggest-item {\ncursor: pointer;\nuser-select: none;\n}\n.suggestions .suggest-item,\n.suggestions .misc-item {\npadding: 5px 10px;\n}\n.suggestions .suggest-item:hover {\nbackground-color: #2874D5 !important;\ncolor: #fff !important;\n}\n.suggestions .suggest-item.selected {\nbackground-color: #2832D5;\ncolor: #fff;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2d5cb31a\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "row" },
    [
      _vm.hasPermissions
        ? _c("div", { staticClass: "col-md-12 col-xs-12 funkyradio" }, [
            _c("div", { staticClass: "funkyradio-primary" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.tables,
                    expression: "tables"
                  }
                ],
                attrs: { type: "checkbox", id: "checkbox1", value: "ativos" },
                domProps: {
                  checked: Array.isArray(_vm.tables)
                    ? _vm._i(_vm.tables, "ativos") > -1
                    : _vm.tables
                },
                on: {
                  change: function($event) {
                    var $$a = _vm.tables,
                      $$el = $event.target,
                      $$c = $$el.checked ? true : false
                    if (Array.isArray($$a)) {
                      var $$v = "ativos",
                        $$i = _vm._i($$a, $$v)
                      if ($$el.checked) {
                        $$i < 0 && (_vm.tables = $$a.concat([$$v]))
                      } else {
                        $$i > -1 &&
                          (_vm.tables = $$a
                            .slice(0, $$i)
                            .concat($$a.slice($$i + 1)))
                      }
                    } else {
                      _vm.tables = $$c
                    }
                  }
                }
              }),
              _vm._v(" "),
              _c("label", { attrs: { for: "checkbox1" } }, [_vm._v("Ativos")])
            ]),
            _vm._v(" "),
            _vm.permissions.inativos
              ? _c("div", { staticClass: "funkyradio-primary" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.tables,
                        expression: "tables"
                      }
                    ],
                    attrs: {
                      type: "checkbox",
                      id: "checkbox2",
                      value: "inativos"
                    },
                    domProps: {
                      checked: Array.isArray(_vm.tables)
                        ? _vm._i(_vm.tables, "inativos") > -1
                        : _vm.tables
                    },
                    on: {
                      change: function($event) {
                        var $$a = _vm.tables,
                          $$el = $event.target,
                          $$c = $$el.checked ? true : false
                        if (Array.isArray($$a)) {
                          var $$v = "inativos",
                            $$i = _vm._i($$a, $$v)
                          if ($$el.checked) {
                            $$i < 0 && (_vm.tables = $$a.concat([$$v]))
                          } else {
                            $$i > -1 &&
                              (_vm.tables = $$a
                                .slice(0, $$i)
                                .concat($$a.slice($$i + 1)))
                          }
                        } else {
                          _vm.tables = $$c
                        }
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("label", { attrs: { for: "checkbox2" } }, [
                    _vm._v("Inativos")
                  ])
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm.permissions.reserva
              ? _c("div", { staticClass: "funkyradio-primary" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.tables,
                        expression: "tables"
                      }
                    ],
                    attrs: {
                      type: "checkbox",
                      id: "checkbox3",
                      value: "reserva"
                    },
                    domProps: {
                      checked: Array.isArray(_vm.tables)
                        ? _vm._i(_vm.tables, "reserva") > -1
                        : _vm.tables
                    },
                    on: {
                      change: function($event) {
                        var $$a = _vm.tables,
                          $$el = $event.target,
                          $$c = $$el.checked ? true : false
                        if (Array.isArray($$a)) {
                          var $$v = "reserva",
                            $$i = _vm._i($$a, $$v)
                          if ($$el.checked) {
                            $$i < 0 && (_vm.tables = $$a.concat([$$v]))
                          } else {
                            $$i > -1 &&
                              (_vm.tables = $$a
                                .slice(0, $$i)
                                .concat($$a.slice($$i + 1)))
                          }
                        } else {
                          _vm.tables = $$c
                        }
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("label", { attrs: { for: "checkbox3" } }, [
                    _vm._v("Reserva")
                  ])
                ])
              : _vm._e()
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm.tables.length
        ? [
            _c("div", { staticClass: "col-md-6 col-xs-12 form-group" }, [
              _c("div", { staticClass: "vue-simple-suggest designed" }, [
                !_vm.onSearch
                  ? _c("div", { staticClass: "input-wrapper" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.found.rg,
                            expression: "found.rg"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { placeholder: "RG", readonly: "" },
                        domProps: { value: _vm.found.rg },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.found, "rg", $event.target.value)
                          }
                        }
                      })
                    ])
                  : _c(
                      "div",
                      { staticClass: "input-wrapper" },
                      [
                        _c("the-mask", {
                          staticClass: "form-control",
                          attrs: {
                            mask: "###############",
                            type: "text",
                            maxlength: "15",
                            placeholder: "RG",
                            readonly: _vm.name.length > 0
                          },
                          on: {
                            focus: function($event) {
                              return _vm.sugestList("rg")
                            }
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
                _vm.result.length && _vm.type == "rg"
                  ? _c(
                      "ul",
                      { staticClass: "suggestions" },
                      _vm._l(_vm.result, function(r, index) {
                        return _c(
                          "li",
                          {
                            key: index,
                            staticClass: "suggest-item",
                            on: {
                              click: function($event) {
                                return _vm.completaInput(r)
                              }
                            }
                          },
                          [
                            _c("b", [_vm._v(_vm._s(r.rg))]),
                            _vm._v(
                              " " + _vm._s(r.nome) + "\n                    "
                            )
                          ]
                        )
                      }),
                      0
                    )
                  : _vm._e()
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6 col-xs-12 form-group" }, [
              _c("div", { staticClass: "vue-simple-suggest designed" }, [
                !_vm.onSearch
                  ? _c("div", { staticClass: "input-wrapper" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.found.nome,
                            expression: "found.nome"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { placeholder: "Nome", readonly: "" },
                        domProps: { value: _vm.found.nome },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.found, "nome", $event.target.value)
                          }
                        }
                      })
                    ])
                  : _c("div", { staticClass: "input-wrapper" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.name,
                            expression: "name"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          placeholder: "Nome",
                          readonly: _vm.rg.length > 0
                        },
                        domProps: { value: _vm.name },
                        on: {
                          focus: function($event) {
                            return _vm.sugestList("nome")
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.name = $event.target.value
                          }
                        }
                      })
                    ]),
                _vm._v(" "),
                _vm.result.length && _vm.type == "nome"
                  ? _c(
                      "ul",
                      { staticClass: "suggestions" },
                      _vm._l(_vm.result, function(r, index) {
                        return _c(
                          "li",
                          {
                            key: index,
                            staticClass: "suggest-item",
                            on: {
                              click: function($event) {
                                return _vm.completaInput(r)
                              }
                            }
                          },
                          [
                            _c("b", [_vm._v(_vm._s(r.nome))]),
                            _vm._v(
                              " " + _vm._s(r.rg) + "\n                    "
                            )
                          ]
                        )
                      }),
                      0
                    )
                  : _vm._e()
              ])
            ]),
            _vm._v(" "),
            !_vm.onSearch
              ? _c("div", { staticClass: "col-md-6 col-xs-12" }, [
                  _c(
                    "a",
                    {
                      staticClass: "btn btn-success btn-block",
                      on: {
                        click: function($event) {
                          return _vm.goToFdi(_vm.found.rg)
                        }
                      }
                    },
                    [_vm._v("Ir para ficha")]
                  )
                ])
              : _vm._e(),
            _vm._v(" "),
            !_vm.onSearch
              ? _c("div", { staticClass: "col-md-6 col-xs-12" }, [
                  _c(
                    "a",
                    {
                      staticClass: "btn btn-primary btn-block",
                      on: { click: _vm.reset }
                    },
                    [
                      _c("i", { staticClass: "fa fa-search" }),
                      _vm._v(" Procurar outra ficha")
                    ]
                  )
                ])
              : _vm._e()
          ]
        : [_vm._m(0)]
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-xs-12" }, [
      _c("h4", [_vm._v("Selecione pelo menos um local para ser feita a busca")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2d5cb31a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7d507394", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SugestRg.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SugestRg.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/SugestRg.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2d5cb31a\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/SugestRg.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
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
Component.options.__file = "resources/assets/js/components/Form/SugestRg.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2d5cb31a", Component.options)
  } else {
    hotAPI.reload("data-v-2d5cb31a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});