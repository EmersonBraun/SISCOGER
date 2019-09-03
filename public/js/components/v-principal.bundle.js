webpackJsonp([54],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Principal.vue":
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
//
//
//
//
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
            pm: '',
            adc: '',
            comportamento: '',
            preso: '',
            suspenso: '',
            excluido: '',
            subJudice: ''
        };
    },
    mounted: function mounted() {
        this.listDadosGerais();
        this.listDadosAdicionais();
        this.listComportamento();
        this.estaPreso();
        this.estaSuspenso();
        this.estaExcluido();
        this.estaSubJudice();
    },

    computed: {
        foto: function foto() {
            return 'http://10.47.1.8/sispics/fotos/' + this.pm.RG + '.JPG';
        }
    },
    methods: {
        listDadosGerais: function listDadosGerais() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/dadosGerais/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.pm = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        listDadosAdicionais: function listDadosAdicionais() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/dadosAdicionais/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this2.adc = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        listComportamento: function listComportamento() {
            var _this3 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/comportamento/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this3.comportamento = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaPreso: function estaPreso() {
            var _this4 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/preso/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this4.preso = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaSuspenso: function estaSuspenso() {
            var _this5 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/suspenso/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this5.suspenso = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaExcluido: function estaExcluido() {
            var _this6 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/excluido/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this6.excluido = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaSubJudice: function estaSubJudice() {
            var _this7 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/subJudice/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this7.subJudice = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.border[data-v-bcb8767a] {\n    border: 1px solid #dee2e6 !important;\n    border-top-color: rgb(222, 226, 250);\n    border-right-color: rgb(222, 226, 250);\n    border-bottom-color: rgb(222, 226, 250);\n    border-left-color: rgb(222, 226, 250);\n    min-height: 60px;\n}\n", ""]);

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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-bcb8767a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "box" }, [
    _c("div", { staticClass: "box-header" }, [
      _c("h2", { staticClass: "box-title" }, [_vm._v("Dados Principais")]),
      _vm._v(" "),
      _c("div", { staticClass: "box-tools pull-right" }, [
        _vm.pm.STATUS == "Ativo"
          ? _c("i", { staticClass: "fa fa-circle text-success" })
          : _vm._e(),
        _vm._v(" "),
        _vm.pm.STATUS == "Inativo"
          ? _c("i", { staticClass: "fa fa-circle text-warning" })
          : _vm._e(),
        _vm._v(" "),
        _vm.pm.STATUS == "Reserva"
          ? _c("i", { staticClass: "fa fa-circle text-info" })
          : _vm._e(),
        _vm._v(" "),
        _c("strong", [_vm._v(_vm._s(_vm.pm.STATUS))]),
        _vm._v(" "),
        _vm.preso
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Preso")])
          : _vm._e(),
        _vm._v(" "),
        _vm.suspenso
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Suspenso")])
          : _vm._e(),
        _vm._v(" "),
        _vm.excluido
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Excluido")])
          : _vm._e(),
        _vm._v(" "),
        _vm.subJudice
          ? _c("strong", { staticClass: "text-danger" }, [
              _vm._v("| Sub Judice")
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm._m(0)
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "box-body" }, [
      _c(
        "div",
        { staticClass: "row" },
        [
          _c("div", { staticClass: "col-md-2 " }, [
            _c("a", { attrs: { href: _vm.foto } }, [
              _c("img", {
                staticClass: "img-responsive",
                staticStyle: { "max-height": "350px", "max-width": "250px" },
                attrs: { src: _vm.foto }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(1),
            _vm._v(" "),
            _c(
              "p",
              [
                _vm._v(_vm._s(_vm.pm.CARGO) + " " + _vm._s(_vm.pm.QUADRO)),
                _vm.pm.SUBQUADRO !== "NA"
                  ? [_vm._v("-" + _vm._s(_vm.pm.SUBQUADRO))]
                  : _vm._e(),
                _vm._v(" " + _vm._s(_vm.pm.NOME) + " ")
              ],
              2
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.RG))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(3),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.comportamento))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _c(
              "p",
              [
                _vm.pm.STATUS == "Ativo"
                  ? [_c("b", [_vm._v("Data de inclusão:")])]
                  : _vm._e(),
                _vm._v(" "),
                _vm.pm.STATUS == "Inativo"
                  ? [_c("b", [_vm._v("Data Inatividade:")])]
                  : _vm._e(),
                _vm._v(" "),
                _vm.pm.STATUS == "Reserva"
                  ? [_c("b", [_vm._v("Data Reserva:")])]
                  : _vm._e()
              ],
              2
            ),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(_vm._f("date_br")(_vm.pm.ADMISSAO_REAL)) +
                  " (" +
                  _vm._s(
                    _vm._f("tempo_em_anos_e_meses")(
                      _vm._f("date_bd")(_vm.pm.ADMISSAO_REAL)
                    )
                  ) +
                  ")"
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(4),
            _vm._v(" "),
            _c(
              "p",
              [
                _vm._v(_vm._s(_vm.pm.CIDADE) + " "),
                _vm.pm.STATUS == "Inativo"
                  ? [_vm._v("- " + _vm._s(_vm.pm.END_BAIRRO))]
                  : _vm._e()
              ],
              2
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(5),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(_vm._f("date_br")(_vm.pm.NASCIMENTO)) +
                  " (" +
                  _vm._s(_vm.pm.IDADE) +
                  " Anos)"
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(6),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.OPM_DESCRICAO))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(7),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.EMAIL_META4))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(8),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.adc.CPF || "Não encontrado"))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(9),
            _vm._v(" "),
            _vm.adc.SBR_NUM_TIT
              ? _c("p", [
                  _vm._v(
                    _vm._s(_vm.adc.SBR_NUM_TIT) +
                      "  Zona: " +
                      _vm._s(_vm.adc.SBR_ZONA) +
                      " Seção: " +
                      _vm._s(_vm.adc.SBR_SECAO)
                  )
                ])
              : _c("p", [_vm._v("Não encontrado")])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(10),
            _vm._v(" "),
            _c("p", [
              _vm._v(_vm._s(_vm.adc.CBR_NAME_FATHER || "Não encontrado"))
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(11),
            _vm._v(" "),
            _c("p", [
              _vm._v(_vm._s(_vm.adc.CBR_NAME_MATHER || "Não encontrado"))
            ])
          ]),
          _vm._v(" "),
          _vm.pm.STATUS == "Inativo"
            ? [
                _c("div", { staticClass: "col-md-6 border" }, [
                  _vm._m(12),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.pm.END_RUA) +
                        ", n° " +
                        _vm._s(_vm.pm.END_NUM) +
                        " (" +
                        _vm._s(_vm.pm.END_COMPL) +
                        ") CEP: " +
                        _vm._s(_vm.pm.END_CEP)
                    )
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6 border" }, [
                  _vm._m(13),
                  _vm._v(" "),
                  _c("p", [_vm._v(_vm._s(_vm.pm.FONE))])
                ])
              ]
            : _vm._e()
        ],
        2
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "btn btn-box-tool",
        attrs: { type: "button", "data-widget": "collapse" }
      },
      [_c("i", { staticClass: "fa fa-minus" })]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome:")]), _c("br")])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("RG:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Comportamento atual:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Cidade:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Data de nascimento:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Classificacao Meta4:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Email funcional:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("CPF:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Título de eleitor:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome do pai:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome da mãe:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Endereço:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Telefone:")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-bcb8767a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3079fb8d", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Principal.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Principal.vue");
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

/***/ "./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Principal.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-bcb8767a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Principal.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-bcb8767a"
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
Component.options.__file = "resources/assets/js/components/FDI/Principal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-bcb8767a", Component.options)
  } else {
    hotAPI.reload("data-v-bcb8767a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});