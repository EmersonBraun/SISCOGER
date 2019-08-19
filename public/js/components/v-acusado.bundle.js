webpackJsonp([4,25],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Acusado.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_js__ = __webpack_require__("./resources/assets/js/mixins.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_the_mask__ = __webpack_require__("./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_the_mask___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_vue_the_mask__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Modal__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Modal.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Modal___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__Vuestrap_Modal__);
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_1_vue_the_mask__["TheMask"], Modal: __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Modal__["Modal"] },
    props: {
        unique: { type: Boolean, default: false },
        situacao: { type: String, default: '' },
        idp: { type: String, default: '' },
        reu: { type: Boolean, default: false }
    },
    data: function data() {
        var _ref;

        return _ref = {
            cargo: '',
            nome: '',
            resultado: '',
            pm: [],
            proc: '',
            pms: [],
            finded: false
        }, _defineProperty(_ref, 'resultado', false), _defineProperty(_ref, 'counter', 0), _defineProperty(_ref, 'only', false), _defineProperty(_ref, 'edit', ''), _defineProperty(_ref, 'verReus', false), _defineProperty(_ref, 'confirmModal', false), _ref;
    },

    filters: {
        vazio: function vazio(value) {
            return !value ? 'Não há' : value;
        },
        SN: function SN(value) {
            var v = !value ? '-' : value;
            if (v.length < 2) {
                var t = v.toUpperCase() == 'S' || v.toUpperCase() == 'Y' || v == 1 ? 'Sim' : 'Não';
                return t;
            }
            return v;
        }
    },
    mounted: function mounted() {
        this.verifyOnly;
    },
    created: function created() {
        this.dadosSession();
        var name = '' + this.dproc + this.idp + 'acusados';
        var json = sessionStorage.getItem(name);
        var array = JSON.parse(json);
        this.pms = Array.isArray(array) ? array : [];
        if (!this.pms.length) this.listPM();
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
            this.only = this.unique == true ? true : false;
        },
        canEdit: function canEdit() {
            return this.permissions.includes('editar-acusado');
        },
        canDelete: function canDelete() {
            return this.permissions.includes('apagar-acusado');
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
                    var name = _this2.dproc + _this2.idp + 'acusados';
                    sessionStorage.setItem(name, JSON.stringify(_this2.pms));
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
            this.rg = pm.rg, this.nome = pm.nome, this.cargo = pm.cargo, this.resultado = pm.resultado, this.edit = pm.id_envolvido;
            // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
            this.add = true;
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
        removePM: function removePM(id, index) {
            this.confimModal = true;
            if (r) {
                var urlDelete = this.getBaseUrl + 'api/acusado/destroy/' + id;
                axios.delete(urlDelete).then(this.pms.splice(index, 1)).then(this.clear(false)).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        clear: function clear(add) {
            this.add = add;
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

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__util_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/util.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: {
    backdrop: { type: Boolean, default: true },
    callback: { type: Function, default: null },
    cancelText: { type: String, default: 'Close' },
    effect: { type: String, default: null },
    large: { type: Boolean, default: false },
    okText: { type: String, default: 'Save changes' },
    small: { type: Boolean, default: false },
    title: { type: String, default: '' },
    value: { type: Boolean, required: true },
    width: { default: null }
  },
  data: function data() {
    return {
      transition: false,
      val: null
    };
  },

  computed: {
    optionalWidth: function optionalWidth() {
      if (this.width === null) {
        return null;
      } else if (Number.isInteger(this.width)) {
        return this.width + 'px';
      }
      return this.width;
    }
  },
  watch: {
    transition: function transition(val, old) {
      if (val === old) {
        return;
      }
      var el = this.$el;
      var body = document.body;
      if (val) {
        //starting
        if (this.val) {
          el.querySelector('.modal-content').focus();
          el.style.display = 'block';
          setTimeout(function () {
            return el.classList.add('in');
          }, 0);
          body.classList.add('modal-open');
          if (Object(__WEBPACK_IMPORTED_MODULE_0__util_js__["a" /* getScrollBarWidth */])() !== 0) {
            body.style.paddingRight = Object(__WEBPACK_IMPORTED_MODULE_0__util_js__["a" /* getScrollBarWidth */])() + 'px';
          }
        } else {
          el.classList.remove('in');
        }
      } else {
        //ending
        this.$emit(this.val ? 'opened' : 'closed');
        if (!this.val) {
          el.style.display = 'none';
          body.style.paddingRight = null;
          body.classList.remove('modal-open');
        }
      }
    },
    val: function val(_val, old) {
      this.$emit('input', _val);
      if (old === null ? _val === true : _val !== old) this.transition = true;
    },
    value: function value(val, old) {
      if (val !== old) this.val = val;
    }
  },
  methods: {
    action: function action(val, p) {
      if (val === null) {
        return;
      }
      if (val && this.callback instanceof Function) this.callback();
      this.$emit(val ? 'ok' : 'cancel', p);
      this.val = val || false;
    }
  },
  mounted: function mounted() {
    this.val = this.value;
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.modal {\n  transition: all 0.3s ease;\n}\n.modal.in {\n  background-color: rgba(0,0,0,0.5);\n}\n.modal.zoom .modal-dialog {\n  -webkit-transform: scale(0.1);\n  -moz-transform: scale(0.1);\n  -ms-transform: scale(0.1);\n  transform: scale(0.1);\n  top: 300px;\n  opacity: 0;\n  -webkit-transition: all 0.3s;\n  -moz-transition: all 0.3s;\n  transition: all 0.3s;\n}\n.modal.zoom.in .modal-dialog {\n  -webkit-transform: scale(1);\n  -moz-transform: scale(1);\n  -ms-transform: scale(1);\n  transform: scale(1);\n  -webkit-transform: translate3d(0, -300px, 0);\n  transform: translate3d(0, -300px, 0);\n  opacity: 1;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Acusado.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-51e4cae2\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      class: ["modal", _vm.effect],
      attrs: { role: "dialog" },
      on: {
        click: function($event) {
          _vm.backdrop && _vm.action(false, 1)
        },
        transitionend: function($event) {
          _vm.transition = false
        }
      }
    },
    [
      _c(
        "div",
        {
          class: [
            "modal-dialog",
            { "modal-lg": _vm.large, "modal-sm": _vm.small }
          ],
          style: { width: _vm.optionalWidth },
          attrs: { role: "document" },
          on: {
            click: function($event) {
              $event.stopPropagation()
              return _vm.action(null)
            }
          }
        },
        [
          _c(
            "div",
            { staticClass: "modal-content" },
            [
              _vm._t("modal-header", [
                _c("div", { staticClass: "modal-header" }, [
                  _c(
                    "button",
                    {
                      staticClass: "close",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(false, 2)
                        }
                      }
                    },
                    [_c("span", [_vm._v("×")])]
                  ),
                  _vm._v(" "),
                  _c(
                    "h4",
                    { staticClass: "modal-title" },
                    [_vm._t("title", [_vm._v(_vm._s(_vm.title))])],
                    2
                  )
                ])
              ]),
              _vm._v(" "),
              _vm._t("modal-body", [
                _c("div", { staticClass: "modal-body" }, [_vm._t("default")], 2)
              ]),
              _vm._v(" "),
              _vm._t("modal-footer", [
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-default",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(false, 3)
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.cancelText))]
                  ),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(true, 4)
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.okText))]
                  )
                ])
              ])
            ],
            2
          )
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-51e4cae2", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7dc238fa\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Acusado.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "col-lg-12 col-md-12 col-xs-12 card mt-4" },
    [
      _c("br"),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "card-header" },
        [
          _vm.reu
            ? _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-sm-10" }, [
                  _c("h4", [_vm._v(_vm._s(_vm.verReus ? "Réus" : "Acusados"))])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col align-self-end" }, [
                  _c("div", { staticClass: "btn-group" }, [
                    _c(
                      "a",
                      {
                        staticClass: "btn",
                        class: !_vm.verReus ? "btn-info" : "btn-default",
                        attrs: { type: "button", target: "_black" },
                        on: {
                          click: function($event) {
                            _vm.verReus = false
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                        Acusados\n                    "
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass: "btn",
                        class: _vm.verReus ? "btn-info" : "btn-default",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            _vm.verReus = true
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                        Réus\n                    "
                        )
                      ]
                    )
                  ])
                ])
              ])
            : [_vm._m(0)]
        ],
        2
      ),
      _vm._v(" "),
      !_vm.only
        ? _c(
            "div",
            { staticClass: "card-body", class: _vm.add ? "bordaform" : "" },
            [
              !_vm.add && !_vm.verReus
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
                        _vm._v(" Adicionar acusado")
                      ]
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.add
                ? _c("div", [
                    _c(
                      "div",
                      { staticClass: "row", attrs: { id: "ligacaoForm1" } },
                      [
                        _c(
                          "form",
                          { attrs: { id: "formData", name: "formData" } },
                          [
                            _c("input", {
                              attrs: {
                                type: "hidden",
                                name: "id_" + _vm.dproc
                              },
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
                              { staticClass: "col-xs-3" },
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
                            _c("div", { staticClass: "col-xs-3" }, [
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
                            ]),
                            _vm._v(" "),
                            _c(
                              "div",
                              { class: _vm.reu ? "col-xs-3" : "col-xs-2" },
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
                              { class: _vm.reu ? "col-xs-3" : "col-xs-2" },
                              [
                                _c("label", { attrs: { for: "resultado" } }, [
                                  _vm._v("Resultado")
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
                                    _c(
                                      "option",
                                      { attrs: { value: "Punido" } },
                                      [_vm._v("Punido")]
                                    ),
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
                                        attrs: {
                                          value: "Reintegrado/Reinserido"
                                        }
                                      },
                                      [_vm._v("Reintegrado/Reinserido")]
                                    )
                                  ]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _vm.reu && _vm.edit
                              ? [
                                  _c(
                                    "div",
                                    {
                                      staticClass: "col-lg-6 col-md-6 col-xs-6"
                                    },
                                    [
                                      _c(
                                        "label",
                                        { attrs: { for: "ipm_processocrime" } },
                                        [_vm._v("Processo crime")]
                                      ),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c(
                                        "select",
                                        {
                                          directives: [
                                            {
                                              name: "model",
                                              rawName: "v-model",
                                              value: _vm.pm.ipm_processocrime,
                                              expression: "pm.ipm_processocrime"
                                            }
                                          ],
                                          staticClass: "form-control",
                                          attrs: { name: "ipm_processocrime" },
                                          on: {
                                            change: function($event) {
                                              var $$selectedVal = Array.prototype.filter
                                                .call(
                                                  $event.target.options,
                                                  function(o) {
                                                    return o.selected
                                                  }
                                                )
                                                .map(function(o) {
                                                  var val =
                                                    "_value" in o
                                                      ? o._value
                                                      : o.value
                                                  return val
                                                })
                                              _vm.$set(
                                                _vm.pm,
                                                "ipm_processocrime",
                                                $event.target.multiple
                                                  ? $$selectedVal
                                                  : $$selectedVal[0]
                                              )
                                            }
                                          }
                                        },
                                        [
                                          _c(
                                            "option",
                                            { attrs: { value: "" } },
                                            [_vm._v("Selecione")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "option",
                                            { attrs: { value: "Denunciado" } },
                                            [_vm._v("Denunciado")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "option",
                                            { attrs: { value: "Arquivado" } },
                                            [_vm._v("Arquivado")]
                                          )
                                        ]
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    {
                                      staticClass: "col-lg-6 col-md-6 col-xs-6"
                                    },
                                    [
                                      _c(
                                        "label",
                                        { attrs: { for: "ipm_julgamento" } },
                                        [_vm._v("Julgamento")]
                                      ),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c(
                                        "select",
                                        {
                                          directives: [
                                            {
                                              name: "model",
                                              rawName: "v-model",
                                              value: _vm.pm.ipm_julgamento,
                                              expression: "pm.ipm_julgamento"
                                            }
                                          ],
                                          staticClass: "form-control",
                                          attrs: { name: "ipm_julgamento" },
                                          on: {
                                            change: function($event) {
                                              var $$selectedVal = Array.prototype.filter
                                                .call(
                                                  $event.target.options,
                                                  function(o) {
                                                    return o.selected
                                                  }
                                                )
                                                .map(function(o) {
                                                  var val =
                                                    "_value" in o
                                                      ? o._value
                                                      : o.value
                                                  return val
                                                })
                                              _vm.$set(
                                                _vm.pm,
                                                "ipm_julgamento",
                                                $event.target.multiple
                                                  ? $$selectedVal
                                                  : $$selectedVal[0]
                                              )
                                            }
                                          }
                                        },
                                        [
                                          _c(
                                            "option",
                                            { attrs: { value: "" } },
                                            [_vm._v("Selecione")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "option",
                                            { attrs: { value: "Condenado" } },
                                            [_vm._v("Condenado")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "option",
                                            { attrs: { value: "Absolvido" } },
                                            [_vm._v("Absolvido")]
                                          )
                                        ]
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _vm.pm.ipm_julgamento == "Condenado"
                                    ? [
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-1 col-md-1 col-xs-1"
                                          },
                                          [
                                            _c("label", [_vm._v("Anos")]),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c("the-mask", {
                                              staticClass: "form-control",
                                              attrs: {
                                                mask: "###",
                                                type: "text",
                                                maxlength: "3",
                                                name: "ipm_pena_anos",
                                                placeholder: "Anos"
                                              },
                                              model: {
                                                value: _vm.pm.ipm_pena_anos,
                                                callback: function($$v) {
                                                  _vm.$set(
                                                    _vm.pm,
                                                    "ipm_pena_anos",
                                                    $$v
                                                  )
                                                },
                                                expression: "pm.ipm_pena_anos"
                                              }
                                            })
                                          ],
                                          1
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-1 col-md-1 col-xs-1"
                                          },
                                          [
                                            _c("label", [_vm._v("Meses")]),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c("the-mask", {
                                              staticClass: "form-control",
                                              attrs: {
                                                mask: "###",
                                                type: "text",
                                                maxlength: "3",
                                                name: "ipm_pena_meses",
                                                placeholder: "Meses"
                                              },
                                              model: {
                                                value: _vm.pm.ipm_pena_meses,
                                                callback: function($$v) {
                                                  _vm.$set(
                                                    _vm.pm,
                                                    "ipm_pena_meses",
                                                    $$v
                                                  )
                                                },
                                                expression: "pm.ipm_pena_meses"
                                              }
                                            })
                                          ],
                                          1
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-1 col-md-1 col-xs-1"
                                          },
                                          [
                                            _c("label", [_vm._v("Dias")]),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c("the-mask", {
                                              staticClass: "form-control",
                                              attrs: {
                                                mask: "###",
                                                type: "text",
                                                maxlength: "3",
                                                name: "ipm_pena_dias",
                                                placeholder: "Dias"
                                              },
                                              model: {
                                                value: _vm.pm.ipm_pena_dias,
                                                callback: function($$v) {
                                                  _vm.$set(
                                                    _vm.pm,
                                                    "ipm_pena_dias",
                                                    $$v
                                                  )
                                                },
                                                expression: "pm.ipm_pena_dias"
                                              }
                                            })
                                          ],
                                          1
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-3 col-md-3 col-xs-3"
                                          },
                                          [
                                            _c("label"),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c("v-checkbox", {
                                              attrs: {
                                                name: "ipm_transitojulgado_bl",
                                                "true-value": "S",
                                                "false-value": "0",
                                                text: "Transitou em julgado?"
                                              },
                                              model: {
                                                value:
                                                  _vm.pm.ipm_transitojulgado_bl,
                                                callback: function($$v) {
                                                  _vm.$set(
                                                    _vm.pm,
                                                    "ipm_transitojulgado_bl",
                                                    $$v
                                                  )
                                                },
                                                expression:
                                                  "pm.ipm_transitojulgado_bl"
                                              }
                                            })
                                          ],
                                          1
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-2 col-md-2 col-xs-2"
                                          },
                                          [
                                            _c(
                                              "label",
                                              {
                                                attrs: { for: "ipm_tipodapena" }
                                              },
                                              [_vm._v("Tipo Pena")]
                                            ),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c(
                                              "select",
                                              {
                                                directives: [
                                                  {
                                                    name: "model",
                                                    rawName: "v-model",
                                                    value:
                                                      _vm.pm.ipm_tipodapena,
                                                    expression:
                                                      "pm.ipm_tipodapena"
                                                  }
                                                ],
                                                staticClass: "form-control",
                                                attrs: {
                                                  name: "ipm_tipodapena"
                                                },
                                                on: {
                                                  change: function($event) {
                                                    var $$selectedVal = Array.prototype.filter
                                                      .call(
                                                        $event.target.options,
                                                        function(o) {
                                                          return o.selected
                                                        }
                                                      )
                                                      .map(function(o) {
                                                        var val =
                                                          "_value" in o
                                                            ? o._value
                                                            : o.value
                                                        return val
                                                      })
                                                    _vm.$set(
                                                      _vm.pm,
                                                      "ipm_tipodapena",
                                                      $event.target.multiple
                                                        ? $$selectedVal
                                                        : $$selectedVal[0]
                                                    )
                                                  }
                                                }
                                              },
                                              [
                                                _c(
                                                  "option",
                                                  { attrs: { value: "" } },
                                                  [_vm._v("Selecione")]
                                                ),
                                                _vm._v(" "),
                                                _c(
                                                  "option",
                                                  {
                                                    attrs: { value: "Detenção" }
                                                  },
                                                  [_vm._v("Detenção")]
                                                ),
                                                _vm._v(" "),
                                                _c(
                                                  "option",
                                                  {
                                                    attrs: { value: "Reclusão" }
                                                  },
                                                  [_vm._v("Reclusão")]
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "col-lg-3 col-md-3 col-xs-3"
                                          },
                                          [
                                            _c("label"),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c("v-checkbox", {
                                              attrs: {
                                                name: "ipm_restritiva_bl",
                                                "true-value": "S",
                                                "false-value": "0",
                                                text: "Restritiva de direito?"
                                              },
                                              model: {
                                                value: _vm.pm.ipm_restritiva_bl,
                                                callback: function($$v) {
                                                  _vm.$set(
                                                    _vm.pm,
                                                    "ipm_restritiva_bl",
                                                    $$v
                                                  )
                                                },
                                                expression:
                                                  "pm.ipm_restritiva_bl"
                                              }
                                            })
                                          ],
                                          1
                                        )
                                      ]
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    {
                                      staticClass:
                                        "col-lg-10 col-md-10 col-xs-10"
                                    },
                                    [
                                      _c(
                                        "label",
                                        { attrs: { for: "obs_txt" } },
                                        [_vm._v("Observações")]
                                      ),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c("input", {
                                        staticClass: "numero form-control",
                                        attrs: {
                                          type: "text",
                                          name: "obs_txt"
                                        },
                                        domProps: { value: _vm.pm.obs_txt }
                                      })
                                    ]
                                  )
                                ]
                              : _vm._e(),
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
                                    on: {
                                      click: function($event) {
                                        return _vm.clear(false)
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
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-1 col-md-1 col-xs 1" },
                              [
                                _vm.edit
                                  ? [
                                      _c("label", [_vm._v("Editar")]),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c(
                                        "a",
                                        {
                                          staticClass:
                                            "btn btn-success btn-block",
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
                                          staticClass:
                                            "btn btn-success btn-block",
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
                          ],
                          2
                        )
                      ]
                    )
                  ])
                : _vm._e()
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "card-footer" },
        [
          _vm.verReus
            ? [
                _vm.pms.length
                  ? _c("div", { staticClass: "row bordaform" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _c("thead", [
                            _c(
                              "tr",
                              [
                                _c("th", { staticClass: "col-sm-1" }, [
                                  _vm._v("#")
                                ]),
                                _vm._v(" "),
                                _c("th", { staticClass: "col-sm-1" }, [
                                  _vm._v("RG")
                                ]),
                                _vm._v(" "),
                                _vm.verReus
                                  ? [
                                      _c("th", { staticClass: "col-sm-1" }, [
                                        _vm._v("Processo crime")
                                      ]),
                                      _vm._v(" "),
                                      _c("th", { staticClass: "col-sm-3" }, [
                                        _vm._v("Julgamento")
                                      ]),
                                      _vm._v(" "),
                                      _c("th", { staticClass: "col-sm-2" }, [
                                        _vm._v("Tipo pena")
                                      ]),
                                      _vm._v(" "),
                                      _c("th", { staticClass: "col-sm-2" }, [
                                        _vm._v("Rest. direito")
                                      ])
                                    ]
                                  : [
                                      _c("th", { staticClass: "col-sm-2" }, [
                                        _vm._v("Nome")
                                      ]),
                                      _vm._v(" "),
                                      _c("th", { staticClass: "col-sm-2" }, [
                                        _vm._v("Posto/Grad.")
                                      ]),
                                      _vm._v(" "),
                                      _c("th", { staticClass: "col-sm-2" }, [
                                        _vm._v("Resultado")
                                      ])
                                    ],
                                _vm._v(" "),
                                _c("th", { staticClass: "col-sm-2" }, [
                                  _vm._v("Ver/Editar/Apagar")
                                ])
                              ],
                              2
                            )
                          ]),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.pms, function(pm, index) {
                              return _c(
                                "tr",
                                { key: index },
                                [
                                  _c("td", [_vm._v(_vm._s(index + 1))]),
                                  _vm._v(" "),
                                  _c("td", [_vm._v(_vm._s(pm.rg))]),
                                  _vm._v(" "),
                                  _vm.verReus
                                    ? [
                                        _c("td", [
                                          _vm._v(
                                            _vm._s(
                                              _vm._f("SN")(pm.ipm_processocrime)
                                            )
                                          )
                                        ]),
                                        _vm._v(" "),
                                        pm.ipm_julgamento &&
                                        pm.ipm_julgamento == "Absolvido"
                                          ? [
                                              _c("td", [
                                                _vm._v(
                                                  _vm._s(pm.ipm_julgamento)
                                                )
                                              ]),
                                              _vm._v(" "),
                                              _c("td", [_vm._v("-")]),
                                              _vm._v(" "),
                                              _c("td", [_vm._v("-")])
                                            ]
                                          : [
                                              _c("td", [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm._f("SN")(
                                                      pm.ipm_julgamento
                                                    )
                                                  ) +
                                                    ": \n                                            " +
                                                    _vm._s(pm.ipm_pena_anos)
                                                ),
                                                _c("b", [_vm._v("A")]),
                                                _vm._v(
                                                  "\n                                            " +
                                                    _vm._s(pm.ipm_pena_meses)
                                                ),
                                                _c("b", [_vm._v("M")]),
                                                _vm._v(
                                                  "\n                                            " +
                                                    _vm._s(pm.ipm_pena_dias)
                                                ),
                                                _c("b", [_vm._v("D")]),
                                                _vm._v(
                                                  " \n                                            Transitado? "
                                                ),
                                                _c("b", [
                                                  _vm._v(
                                                    _vm._s(
                                                      _vm._f("SN")(
                                                        pm.ipm_transitojulgado_bl
                                                      )
                                                    )
                                                  )
                                                ])
                                              ]),
                                              _vm._v(" "),
                                              _c("td", [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm._f("SN")(
                                                      pm.ipm_tipodapena
                                                    )
                                                  )
                                                )
                                              ]),
                                              _vm._v(" "),
                                              _c("td", [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm._f("SN")(
                                                      pm.ipm_restritiva_bl
                                                    )
                                                  )
                                                )
                                              ])
                                            ]
                                      ]
                                    : [
                                        _c("td", [_vm._v(_vm._s(pm.nome))]),
                                        _vm._v(" "),
                                        _c("td", [_vm._v(_vm._s(pm.cargo))]),
                                        _vm._v(" "),
                                        _c("td", [
                                          _vm._v(
                                            _vm._s(
                                              _vm._f("vazio")(pm.resultado)
                                            )
                                          )
                                        ])
                                      ],
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
                                            attrs: {
                                              type: "button",
                                              target: "_blanck"
                                            },
                                            on: {
                                              click: function($event) {
                                                return _vm.showPM(pm.rg)
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-eye"
                                            })
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "a",
                                          {
                                            staticClass: "btn btn-success",
                                            staticStyle: { color: "white" },
                                            attrs: {
                                              type: "button",
                                              target: "_blanck"
                                            },
                                            on: {
                                              click: function($event) {
                                                return _vm.replacePM(pm)
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-edit"
                                            })
                                          ]
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
                                                return _vm.removePM(
                                                  pm.id_envolvido,
                                                  index
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-trash"
                                            })
                                          ]
                                        )
                                      ]
                                    )
                                  ])
                                ],
                                2
                              )
                            }),
                            0
                          )
                        ])
                      ])
                    ])
                  : _vm._e(),
                _vm._v(" "),
                !_vm.pms.length && _vm.only ? _c("div", [_vm._m(1)]) : _vm._e()
              ]
            : [
                _vm.pms.length
                  ? _c("div", { staticClass: "row bordaform" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _vm._m(2),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.pms, function(pm, index) {
                              return _c("tr", { key: index }, [
                                _c("td", [_vm._v(_vm._s(index + 1))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(pm.rg))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(pm.nome) +
                                      " " +
                                      _vm._s(pm.ipm_tipodapena)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(pm.cargo))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("vazio")(pm.resultado)))
                                ]),
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
                                          attrs: {
                                            type: "button",
                                            target: "_blanck"
                                          },
                                          on: {
                                            click: function($event) {
                                              return _vm.showPM(pm.rg)
                                            }
                                          }
                                        },
                                        [_c("i", { staticClass: "fa fa-eye" })]
                                      ),
                                      _vm._v(" "),
                                      _vm.canEdit
                                        ? _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-success",
                                              staticStyle: { color: "white" },
                                              attrs: {
                                                type: "button",
                                                target: "_blanck"
                                              },
                                              on: {
                                                click: function($event) {
                                                  return _vm.replacePM(pm)
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-edit"
                                              })
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.canDelete
                                        ? _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-danger",
                                              staticStyle: { color: "white" },
                                              attrs: { type: "button" },
                                              on: {
                                                click: function($event) {
                                                  return _vm.removePM(
                                                    pm.id_envolvido,
                                                    index
                                                  )
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-trash"
                                              })
                                            ]
                                          )
                                        : _vm._e()
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
                  ? _c("div", [_vm._m(3)])
                  : _vm._e()
              ]
        ],
        2
      ),
      _vm._v(" "),
      _vm.confirmModal
        ? _c("v-modal", { attrs: { effect: "fade", width: "400" } }, [
            _c(
              "div",
              {
                staticClass: "modal-header",
                attrs: { slot: "modal-header" },
                slot: "modal-header"
              },
              [
                _c("h4", { staticClass: "modal-title" }, [
                  _vm._v("Você tem certeza?")
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "modal-footer",
                attrs: { slot: "modal-footer" },
                slot: "modal-footer"
              },
              [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-success",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        _vm.respModal = true
                      }
                    }
                  },
                  [_vm._v("Sim")]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-danger",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        _vm.confirmModal = false
                      }
                    }
                  },
                  [_vm._v("Não")]
                )
              ]
            )
          ])
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h4", [_c("b", [_vm._v("Acusado")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Não há registros")])])
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
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Resultado")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ver/Editar/Apagar")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Não há registros")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7dc238fa", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("17a0604a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Modal.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Modal.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Acusado.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Acusado.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("db9c6e3c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Acusado.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Acusado.vue");
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

/***/ "./resources/assets/js/components/SubForm/Acusado.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dc238fa\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Acusado.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Acusado.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7dc238fa\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Acusado.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7dc238fa"
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
Component.options.__file = "resources/assets/js/components/SubForm/Acusado.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7dc238fa", Component.options)
  } else {
    hotAPI.reload("data-v-7dc238fa", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-51e4cae2\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Modal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-51e4cae2", Component.options)
  } else {
    hotAPI.reload("data-v-51e4cae2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/util.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* unused harmony export coerce */
/* unused harmony export getJSON */
/* harmony export (immutable) */ __webpack_exports__["a"] = getScrollBarWidth;
/* unused harmony export translations */
/* unused harmony export delayer */
/* unused harmony export VueFixer */
// coerce convert som types of data into another type
var coerce = {
  // Convert a string to booleam. Otherwise, return the value without modification, so if is not boolean, Vue throw a warning.
  boolean: function boolean(val) {
    return typeof val === 'string' ? val === '' || val === 'true' ? true : val === 'false' || val === 'null' || val === 'undefined' ? false : val : val;
  },
  // Attempt to convert a string value to a Number. Otherwise, return 0.
  number: function number(val) {
    var alt = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    return typeof val === 'number' ? val : val === undefined || val === null || isNaN(Number(val)) ? alt : Number(val);
  },
  // Attempt to convert to string any value, except for null or undefined.
  string: function string(val) {
    return val === undefined || val === null ? '' : val + '';
  },
  // Pattern accept RegExp, function, or string (converted to RegExp). Otherwise return null.
  pattern: function pattern(val) {
    return val instanceof Function || val instanceof RegExp ? val : typeof val === 'string' ? new RegExp(val) : null;
  }
};

function getJSON(url) {
  var request = new window.XMLHttpRequest();
  var data = {};
  // p (-simulated- promise)
  var p = {
    then: function then(fn1, fn2) {
      return p.done(fn1).fail(fn2);
    },
    catch: function _catch(fn) {
      return p.fail(fn);
    },
    always: function always(fn) {
      return p.done(fn).fail(fn);
    }
  };
  ['done', 'fail'].forEach(function (name) {
    data[name] = [];
    p[name] = function (fn) {
      if (fn instanceof Function) data[name].push(fn);
      return p;
    };
  });
  p.done(JSON.parse);
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      var e = { status: request.status };
      if (request.status === 200) {
        try {
          var response = request.responseText;
          for (var i in data.done) {
            var value = data.done[i](response);
            if (value !== undefined) {
              response = value;
            }
          }
        } catch (err) {
          data.fail.forEach(function (fail) {
            return fail(err);
          });
        }
      } else {
        data.fail.forEach(function (fail) {
          return fail(e);
        });
      }
    }
  };
  request.open('GET', url);
  request.setRequestHeader('Accept', 'application/json');
  request.send();
  return p;
}

function getScrollBarWidth() {
  if (document.documentElement.scrollHeight <= document.documentElement.clientHeight) {
    return 0;
  }
  var inner = document.createElement('p');
  inner.style.width = '100%';
  inner.style.height = '200px';

  var outer = document.createElement('div');
  outer.style.position = 'absolute';
  outer.style.top = '0px';
  outer.style.left = '0px';
  outer.style.visibility = 'hidden';
  outer.style.width = '200px';
  outer.style.height = '150px';
  outer.style.overflow = 'hidden';
  outer.appendChild(inner);

  document.body.appendChild(outer);
  var w1 = inner.offsetWidth;
  outer.style.overflow = 'scroll';
  var w2 = inner.offsetWidth;
  if (w1 === w2) w2 = outer.clientWidth;

  document.body.removeChild(outer);

  return w1 - w2;
}

// return all the translations or the default language (english)
function translations() {
  var lang = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'en';

  var text = {
    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    limit: 'Limit reached ({{limit}} items max).',
    loading: 'Loading...',
    minLength: 'Min. Length',
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    notSelected: 'Nothing Selected',
    required: 'Required',
    search: 'Search'
  };
  return window.VueStrapLang ? window.VueStrapLang(lang) : text;
}

// delayer: set a function that execute after a delay
// @params (function, delay_prop or value, default_value)
function delayer(fn, varTimer) {
  var ifNaN = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 100;

  function toInt(el) {
    return (/^[0-9]+$/.test(el) ? Number(el) || 1 : null
    );
  }
  var timerId;
  return function () {
    var _this = this;

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    if (timerId) clearTimeout(timerId);
    timerId = setTimeout(function () {
      fn.apply(_this, args);
    }, toInt(varTimer) || toInt(this[varTimer]) || ifNaN);
  };
}

// Fix a vue instance Lifecycle to vue 1/2 (just the basic elements, is not a real parser, so this work only if your code is compatible with both)
// (Waiting for testing)
function VueFixer(vue) {
  var vue2 = !window.Vue || !window.Vue.partial;
  var mixin = {
    computed: {
      vue2: function vue2() {
        return !this.$dispatch;
      }
    }
  };
  if (!vue2) {
    //translate vue2 attributes to vue1
    if (vue.beforeCreate) {
      mixin.create = vue.beforeCreate;
      delete vue.beforeCreate;
    }
    if (vue.beforeMount) {
      vue.beforeCompile = vue.beforeMount;
      delete vue.beforeMount;
    }
    if (vue.mounted) {
      vue.ready = vue.mounted;
      delete vue.mounted;
    }
  } else {
    //translate vue1 attributes to vue2
    if (vue.beforeCompile) {
      vue.beforeMount = vue.beforeCompile;
      delete vue.beforeCompile;
    }
    if (vue.compiled) {
      mixin.compiled = vue.compiled;
      delete vue.compiled;
    }
    if (vue.ready) {
      vue.mounted = vue.ready;
      delete vue.ready;
    }
  }
  if (!vue.mixins) {
    vue.mixins = [];
  }
  vue.mixins.unshift(mixin);
  return vue;
}

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