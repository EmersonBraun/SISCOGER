webpackJsonp([11],{

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
        idp: { type: String, default: '' }
    },
    data: function data() {
        return {
            nome: '',
            cargo: '',
            proc: '',
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

            var urlIndex = this.getBaseUrl + 'api/dados/envolvido/' + this.dproc + '/' + this.idp + '/' + this.situacao;
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
            var urlCreate = this.getBaseUrl + 'api/acusado/store';

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
        replacePM: function replacePM(pm) {
            this.hasPM = false;
            this.edit = pm.id_envolvido;
            this.rg = pm.rg, this.nome = pm.nome, this.cargo = pm.cargo, this.resultado = pm.resultado;
            // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
        },
        editPM: function editPM() {
            var _this3 = this;

            var urledit = this.getBaseUrl + 'api/acusado/edit/' + this.edit;

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

/***/ "./node_modules/css-loader/lib/css-base.js":
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/vue-loader/lib/component-normalizer.js":
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


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
                _c("form", { attrs: { id: "formData", name: "formData" } }, [
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
                                      .call($event.target.options, function(o) {
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
                                _c("option", { attrs: { value: "Excluído" } }, [
                                  _vm._v("Excluído")
                                ]),
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
                ])
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

/***/ "./node_modules/vue-style-loader/lib/addStylesClient.js":
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__("./node_modules/vue-style-loader/lib/listToStyles.js")

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ "./node_modules/vue-style-loader/lib/listToStyles.js":
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
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
            action: '',
            dproc: '',
            dref: '',
            dano: '',
            add: false,
            admin: false,
            rg: ''
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
            this.dano = pathname[5];

            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + pathname[1] + '/';

            return baseUrl;
        }
    },
    methods: {
        dadosSession: function dadosSession() {
            var session = this.$root.getSessionData();
            this.admin = session.is_admin;
            this.rg = session.rg;
        }
    }
});

/***/ })

});