webpackJsonp([10],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        title: { type: String },
        name: { type: String },
        proc: { type: String },
        idp: { type: String },
        ext: { type: Array, default: ['pdf'] },
        candelete: { default: '' },
        unique: { type: Boolean, default: true }
    },
    data: function data() {
        return {
            file: '',
            uploaded: [],
            apagados: [],
            forUpload: false,
            error: [],
            progressBar: false,
            width: 0,
            only: false,
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            countup: 0,
            countap: 0,
            filetype: '',
            action: 'fileupload',
            del: false
        };
    },
    beforeMount: function beforeMount() {
        this.listFile();
    },

    watch: {
        countup: function countup() {
            this.verifyOnly;
        }
    },
    filters: {
        toMB: function toMB(value) {
            if (!value) return '';
            var MB = 1048576;
            value = value / MB;
            return value.toFixed(2);
        }
    },
    computed: {
        getBaseUrl: function getBaseUrl() {
            // URL completa
            var getUrl = window.location;
            // dividir em array
            var pathname = getUrl.pathname.split('/');
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1] + "/";

            return baseUrl;
        },

        // verificar se é upload unico
        verifyOnly: function verifyOnly() {
            if (this.unique == true && this.countup > 0) {
                this.only = true;
            } else {
                this.only = false;
            }
        },
        verifyType: function verifyType() {
            this.filetype = this.file.type.split('/')[1];
            if (!this.ext.includes(this.filetype)) {
                this.error.push('Extenção inválida! deve ser: ' + this.ext.join(', '));
                return false;
            } else {
                return true;
            }
        },
        verifySize: function verifySize() {
            var fileSize = this.file.size;
            var qtdMB = 5;
            var maxSize = 1048576 * qtdMB;
            if (fileSize > maxSize) {
                this.error.push('Tamanho excedido! deve ser menor que ' + qtdMB + 'MB ');
                return false;
            } else {
                return true;
            }
        }
    },
    methods: {
        verifyFile: function verifyFile() {
            this.error = [];
            this.file = this.$refs.file.files[0];
            var type = this.verifyType;
            var size = this.verifySize;
            this.forUpload = type && size ? true : false;
            if (!this.forUpload) this.file = '';
        },
        createFile: function createFile() {
            var _this = this;

            var urlCreate = this.getBaseUrl + this.action + '/store';

            var formData = new FormData();
            formData.append('file', this.file);
            formData.append('name', this.name);
            formData.append('id_proc', this.idp);
            formData.append('proc', this.proc);
            formData.append('ext', this.filetype);

            axios.post(urlCreate, formData, { headers: this.headers }).then(this.progress()).catch(function (error) {
                console.log(error);
                _this.erro = "Erro ao enviar arquivo";
            });
        },
        listFile: function listFile() {
            var _this2 = this;

            var urlIndex = this.getBaseUrl + this.action + '/list/' + this.proc + '/' + this.idp + '/' + this.name;
            axios.get(urlIndex).then(function (response) {
                _this2.uploaded = response.data.list;
                _this2.apagados = response.data.apagados;
                _this2.countup = response.data.list.length;
                _this2.countap = response.data.list.length;
            }).catch(function (error) {
                return console.log(error);
            });
        },
        showFile: function showFile(id) {
            var urlShow = this.getBaseUrl + this.action + '/show/' + this.proc + '/' + this.idp + '/' + this.name + '/' + id;
            window.open(urlShow, "_blank");
        },
        deleteFile: function deleteFile(id) {
            var _this3 = this;

            var urlDelete = this.getBaseUrl + this.action + '/delete/' + id;
            axios.delete(urlDelete).then(function (response) {
                return _this3.listFile();
            }) //chama list para atualizar
            .catch(function (error) {
                return console.log(error);
            });
        },
        removeFile: function removeFile(id) {
            var _this4 = this;

            var urlDelete = this.getBaseUrl + this.action + '/destroy/' + id;
            axios.delete(urlDelete).then(function (response) {
                return _this4.listFile();
            }) //chama list para atualizar
            .catch(function (error) {
                return console.log(error);
            });
        },
        cancelFile: function cancelFile() {
            this.file = '';
            this.forUpload = false;
        },
        showUploaded: function showUploaded() {
            this.del = false;
        },
        showDeleted: function showDeleted() {
            this.del = true;
        },
        progress: function progress() {
            var _this5 = this;

            this.progressBar = true;
            setTimeout(function () {
                if (_this5.width < 100) {
                    _this5.width += 5;
                    _this5.progress();
                } else {
                    _this5.width = 0;
                    _this5.listFile();
                    _this5.cancelFile();
                    _this5.progressBar = false;
                }
            }, 25);
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.bgicon{\n    color: white;\n}\n", ""]);

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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-14c5409f\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      { staticClass: "card bordaform" },
      [
        _vm.title
          ? _c("div", { staticClass: "card-header" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-4" }, [
                  _c("h4", [_vm._v(_vm._s(_vm.title))])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-5" }),
                _vm._v(" "),
                _vm.candelete
                  ? _c("div", { staticClass: "col-md-3 btn-group" }, [
                      _c("div", { staticClass: "btn-group" }, [
                        _c(
                          "a",
                          {
                            staticClass: "btn",
                            class: !_vm.del ? "btn-info" : "btn-default",
                            attrs: { type: "button", target: "_black" },
                            on: { click: _vm.showUploaded }
                          },
                          [
                            _vm._v(
                              "\n                            Ativos\n                        "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            staticClass: "btn",
                            class: _vm.del ? "btn-info" : "btn-default",
                            attrs: { type: "button" },
                            on: { click: _vm.showDeleted }
                          },
                          [
                            _vm._v(
                              "\n                            Apagados\n                        "
                            )
                          ]
                        )
                      ])
                    ])
                  : _vm._e()
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        !_vm.only
          ? _c("div", { staticClass: "card-body" }, [
              !_vm.forUpload
                ? _c(
                    "label",
                    {
                      staticClass: "btn btn-primary bgicon",
                      attrs: { for: _vm.name }
                    },
                    [
                      _vm._v(
                        "\n                Selecionar arquivo\n                "
                      ),
                      _c("input", {
                        ref: "file",
                        staticStyle: { display: "none" },
                        attrs: { id: _vm.name, name: _vm.name, type: "file" },
                        on: { change: _vm.verifyFile }
                      })
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.forUpload
                ? _c(
                    "a",
                    {
                      staticClass: "btn btn-danger bgicon",
                      staticStyle: { color: "white" },
                      on: {
                        click: function($event) {
                          return _vm.cancelFile()
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fa fa-undo" }),
                      _vm._v(" Cancelar\n            ")
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.forUpload
                ? _c(
                    "a",
                    {
                      staticClass: "btn btn-primary bgicon",
                      staticStyle: { color: "white" },
                      on: {
                        click: function($event) {
                          return _vm.createFile()
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fa fa-cloud-upload" }),
                      _vm._v(" Upload\n            ")
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.file.name
                ? _c("span", [
                    _vm._v(
                      "\n                " +
                        _vm._s(_vm.file.name) +
                        "\n            "
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.error.length
                ? _c(
                    "div",
                    { staticStyle: { color: "red" } },
                    _vm._l(_vm.error, function(e, index) {
                      return _c("p", { key: index }, [_vm._v(_vm._s(e))])
                    }),
                    0
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.progressBar
                ? _c(
                    "div",
                    {
                      staticClass: "progress",
                      staticStyle: { "padding-top": "3px" }
                    },
                    [
                      _c("div", {
                        staticClass: "progress-bar",
                        style: { width: _vm.width + "%" },
                        attrs: {
                          role: "progressbar",
                          "aria-valuenow": _vm.width,
                          "aria-valuemin": "0",
                          "aria-valuemax": "100"
                        }
                      })
                    ]
                  )
                : _vm._e()
            ])
          : _vm._e(),
        _vm._v(" "),
        !_vm.del
          ? [
              _c("div", { staticClass: "card-footer" }, [
                _vm.uploaded.length
                  ? _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _c("thead", [
                            _c("tr", [
                              !_vm.only
                                ? _c("th", { staticClass: "col-sm-2" }, [
                                    _vm._v("#")
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Aquivo")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Ref.")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Ano")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Tamanho")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Ext.")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Ações")
                              ])
                            ])
                          ]),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.uploaded, function(u, index) {
                              return _c("tr", { key: index }, [
                                !_vm.only
                                  ? _c("td", [_vm._v(_vm._s(u.id))])
                                  : _vm._e(),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.name))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.sjd_ref))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.sjd_ref_ano))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("toMB")(u.size)) + " MB")
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.mime))]),
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
                                            target: "_black"
                                          },
                                          on: {
                                            click: function($event) {
                                              return _vm.showFile(u.id)
                                            }
                                          }
                                        },
                                        [
                                          _c("i", { staticClass: "fa fa-eye" }),
                                          _vm._v(
                                            " Ver\n                                            "
                                          )
                                        ]
                                      ),
                                      _vm._v(" "),
                                      u.deleted_at == null
                                        ? _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-danger",
                                              staticStyle: { color: "white" },
                                              attrs: { type: "button" },
                                              on: {
                                                click: function($event) {
                                                  return _vm.deleteFile(u.id)
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-trash"
                                              }),
                                              _vm._v(
                                                " Apagar\n                                            "
                                              )
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
                  : _vm._e(),
                _vm._v(" "),
                !_vm.uploaded.length && _vm.only
                  ? _c("div", { staticClass: "row" }, [_vm._m(0)])
                  : _vm._e()
              ])
            ]
          : _vm._e(),
        _vm._v(" "),
        _vm.del
          ? [
              _c("div", { staticClass: "card-footer" }, [
                _vm.apagados.length
                  ? _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _vm._m(1),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.apagados, function(a, i) {
                              return _c("tr", { key: i }, [
                                _c("td", [_vm._v(_vm._s(a.id))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.name))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.sjd_ref))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.sjd_ref_ano))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("toMB")(a.size)) + " MB")
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.mime))]),
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
                                            target: "_black"
                                          },
                                          on: {
                                            click: function($event) {
                                              return _vm.showFile(a.id)
                                            }
                                          }
                                        },
                                        [
                                          _c("i", { staticClass: "fa fa-eye" }),
                                          _vm._v(
                                            " Ver\n                                            "
                                          )
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
                                              return _vm.removeFile(a.id)
                                            }
                                          }
                                        },
                                        [
                                          _c("i", {
                                            staticClass: "fa fa-trash"
                                          }),
                                          _vm._v(
                                            " Destruir\n                                            "
                                          )
                                        ]
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
                  : _c("div", { staticClass: "row" }, [_vm._m(2)])
              ])
            ]
          : _vm._e()
      ],
      2
    ),
    _vm._v(" "),
    _c("br")
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-12" }, [
      _c("p", [_vm._v("Não há arquivo")])
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
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Aquivo")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("Ref.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("Ano")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Tamanho")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ext.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ações")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-12" }, [
      _c("p", [_vm._v("Não há arquivo")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-14c5409f", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3e1a8df1", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FileUpload.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FileUpload.vue");
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

/***/ "./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-14c5409f\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
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
Component.options.__file = "resources/assets/js/components/Arquivos/FileUpload.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-14c5409f", Component.options)
  } else {
    hotAPI.reload("data-v-14c5409f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});