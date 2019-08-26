webpackJsonp([41],{

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
    computed: {
        getBaseUrl: function getBaseUrl() {
            var getUrl = window.location;
            var pathname = getUrl.pathname.split('/');
            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + pathname[1] + '/';

            return baseUrl;
        }
    },
    methods: {
        search: function search(val) {
            var _this = this;

            var urlSearch = this.getBaseUrl + 'api/dados/sugest';
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
            window.location.href = this.getBaseUrl + 'fdi/' + rg + '/ver';
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ninput[type=\"checkbox\"], input[type=\"radio\"] {\n    box-sizing: border-box;\n    padding: 0;\n}\n.custom-control-input {\n    position: absolute;\n    z-index: -1;\n    opacity: 0;\n}\n.funkyradio div {\nclear: both;\noverflow: hidden;\n}\n.funkyradio label {\nborder-radius: 3px;\nfont-weight: normal;\n}\n.funkyradio input[type=\"checkbox\"]:empty {\ndisplay: none;\n}\n.funkyradio input[type=\"checkbox\"]:empty ~ label {\nposition: relative;\nline-height: 2em;\ntext-indent: 2.5em;\nmargin-top: .3em;\ncursor: pointer;\n-webkit-user-select: none;\n    -moz-user-select: none;\n    -ms-user-select: none;\n        user-select: none;\n}\n.funkyradio input[type=\"checkbox\"]:empty ~ label:before {\nposition: absolute;\ndisplay: inline;\ntop: 0;\nbottom: 0;\nleft: 0;\ncontent: '';\nwidth: 2em;\nbackground: #D1D3D4;\nborder-radius: 3px;\n}\n.funkyradio input[type=\"checkbox\"]:hover:not(:checked) ~ label {\ncolor: #888;\n}\n.funkyradio input[type=\"checkbox\"]:hover:not(:checked) ~ label:before {\ncontent: '\\2714';\ntext-indent: .6em;\ncolor: #C2C2C2;\n}\n.funkyradio input[type=\"checkbox\"]:checked ~ label {\ncolor: #777;\n}\n.funkyradio input[type=\"checkbox\"]:checked ~ label:before {\ncontent: '\\2714';\ntext-indent: .6em;\ncolor: #333;\nbackground-color: #ccc;\n}\n.funkyradio input[type=\"checkbox\"]:focus ~ label:before {\nbox-shadow: 0 0 0 3px #999;\n}\n.funkyradio-default input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #333;\nbackground-color: #ccc;\n}\n.funkyradio-primary input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #337ab7;\n}\n.funkyradio-success input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #5cb85c;\n}\n.funkyradio-danger input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #d9534f;\n}\n.funkyradio-warning input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #f0ad4e;\n}\n.funkyradio-info input[type=\"checkbox\"]:checked ~ label:before {\ncolor: #fff;\nbackground-color: #5bc0de;\n}\n.vue-simple-suggest > ul {\nlist-style: none;\nmargin: 0;\npadding: 0;\n}\n.vue-simple-suggest{\nposition: relative;\n}\n.vue-simple-suggest.designed, * {\nbox-sizing: border-box;\n}\n.input-wrapper input {\ndisplay: block;\nwidth: 100%;\npadding: 10px;\nborder: 1px solid #cde;\nborder-radius: 3px;\ncolor: black;\nbackground: white;\noutline:none;\ntransition: all .1s;\ntransition-delay: .05s\n}\n.vue-simple-suggest.designed:focus .input-wrapper input {\noutline: 2px solid #2874D5;\n}\n.suggestions {\nposition: absolute;\nleft: 0;\nright: 0;\ntop: 100%;\ntop: calc(100% + 5px);\nborder-radius: 3px;\nborder: 1px solid #aaa;\nbackground-color: #fff;\nopacity: 1;\nz-index: 1000;\n}\n.suggestions .suggest-item {\ncursor: pointer;\nuser-select: none;\n}\n.suggestions .suggest-item,\n.suggestions .misc-item {\npadding: 5px 10px;\n}\n.suggestions .suggest-item:hover {\nbackground-color: #2874D5 !important;\ncolor: #fff !important;\n}\n.suggestions .suggest-item.selected {\nbackground-color: #2832D5;\ncolor: #fff;\n}\n", ""]);

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
                      staticClass: "btn btn-primary btn-block",
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
                      staticClass: "btn btn-success btn-block",
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