webpackJsonp([75],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue":
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


/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            module: 'cadastroopm',
            om: '',
            registro: {},
            canCreate: false,
            canEdit: false
        };
    },
    created: function created() {
        this.om = this.$root.dadoSession('cdopmbase');
        this.rg = this.$root.dadoSession('rg');
        this.canCreate = this.$root.hasPermission('criar-dados-unidade');
        this.canEdit = this.$root.hasPermission('editar-dados-unidade');
        this.get();
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.opm_nome_por_extenso && this.registro.opm_autoridade_rg) return false;
            return true;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: NOME DA UNIDADE e RG deve estar preenchidos';
        }
    },
    methods: {
        get: function get() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/get/' + this.om;
            if (this.om) {
                axios.get(urlIndex).then(function (response) {
                    _this.registro = response.data[0];
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.usuario_rg = this.rg;
        },
        create: function create() {
            var _this2 = this;

            if (!this.requireds) {

                var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
                axios.post(urlCreate, this.registro).then(function (response) {
                    _this2.transation(response.data.success, 'create');
                }).catch(function (error) {
                    return console.log(error);
                });
                this.showModal = false;
            }
        },
        edit: function edit(registro) {
            this.registro = registro;
            this.showModal = true;
        },
        update: function update(id) {
            var _this3 = this;

            if (!this.requireds) {
                var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
                axios.put(urlUpdate, this.registro).then(function (response) {
                    _this3.transation(response.data.success, 'edit');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
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
                this.$root.msg(msg.success, 'success');
            } else {
                // se falhou
                this.$root.msg(msg.fail, 'danger');
            }
        },
        words: function words(type) {
            if (type == 'create') return { success: 'Inserido com sucesso', fail: 'Erro ao inserir' };
            if (type == 'edit') return { success: 'Editado com sucesso', fail: 'Erro ao editar' };
            if (type == 'delete') return { success: 'Apagado com sucesso', fail: 'Erro ao apagar' };
        },
        dadosPM: function dadosPM() {
            var _this5 = this;

            if (this.registro.opm_autoridade_rg.length > 3) {
                var urlSearch = this.$root.baseUrl + 'api/dados/pm/' + this.registro.opm_autoridade_rg;
                axios.get(urlSearch).then(function (response) {
                    console.log(response.data.pm);
                    var res = response.data.pm;
                    _this5.registro.opm_autoridade_cargo = res.CARGO;
                    _this5.registro.opm_autoridade_quadro = res.QUADRO;
                    _this5.registro.opm_autoridade_subquadro = res.SUBQUADRO;

                    var cargolimpo = _this5.$root.formatUcwords(res.CARGO);
                    console.log(cargolimpo);
                    var quadro = _this5.registro.opm_autoridade_quadro;
                    var nomelimpo = _this5.$root.formatUcwords(res.NOME);
                    _this5.registro.opm_autoridade_nome = cargolimpo + '. ' + quadro + ' ' + nomelimpo;

                    // this.registro.origem_opm = response.data.opm
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-53afc6df] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-53afc6df] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-53afc6df\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "row" },
    [
      _c("div", { staticClass: "col-xs-12" }, [
        _c("div", { staticClass: "box" }, [
          _c("div", { staticClass: "box-header" }, [
            _vm.registro.opm_nome_por_extenso
              ? _c("h2", { staticClass: "box-title" }, [
                  _vm._v(_vm._s(_vm.registro.opm_nome_por_extenso))
                ])
              : _c("h2", { staticClass: "box-title" }, [
                  _vm._v("Dados cadastrais da Unidade ")
                ]),
            _vm._v(" "),
            _vm._m(0)
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "box-body" }, [
            _c(
              "div",
              { staticClass: "col-md-12 col-xs-12" },
              [
                _c(
                  "v-label",
                  {
                    attrs: {
                      lg: "6",
                      md: "6",
                      label: "opm_intermediaria_cdopm",
                      title: "OM Interm."
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
                            value: _vm.registro.opm_intermediaria_cdopm,
                            expression: "registro.opm_intermediaria_cdopm"
                          }
                        ],
                        staticClass: "form-control",
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
                            _vm.$set(
                              _vm.registro,
                              "opm_intermediaria_cdopm",
                              $event.target.multiple
                                ? $$selectedVal
                                : $$selectedVal[0]
                            )
                          }
                        }
                      },
                      [
                        _c("option", { attrs: { value: "0" } }, [_vm._v("CG")]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "010" } }, [
                          _vm._v("SUBCG")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "1" } }, [_vm._v("EM")]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "2" } }, [
                          _vm._v("1CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "3" } }, [
                          _vm._v("2CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "4" } }, [
                          _vm._v("3CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "5" } }, [
                          _vm._v("4CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "6" } }, [
                          _vm._v("5CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "7" } }, [
                          _vm._v("6CRPM")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "9" } }, [
                          _vm._v("CCB")
                        ]),
                        _vm._v(" "),
                        _c("option", { attrs: { value: "90000008" } }, [
                          _vm._v("GOST")
                        ])
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  {
                    attrs: {
                      lg: "6",
                      md: "6",
                      label: "opm_intermediaria_nome_por_extenso",
                      title: "Nome da Unidade Intermediaria por extenso"
                    }
                  },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value:
                            _vm.registro.opm_intermediaria_nome_por_extenso,
                          expression:
                            "registro.opm_intermediaria_nome_por_extenso"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { size: "45", type: "text" },
                      domProps: {
                        value: _vm.registro.opm_intermediaria_nome_por_extenso
                      },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "opm_intermediaria_nome_por_extenso",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  {
                    attrs: {
                      lg: "6",
                      md: "6",
                      label: "opm_nome_por_extenso",
                      title: "Nome da Unidade por extenso"
                    }
                  },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.opm_nome_por_extenso,
                          expression: "registro.opm_nome_por_extenso"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { size: "45", type: "text" },
                      domProps: { value: _vm.registro.opm_nome_por_extenso },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "opm_nome_por_extenso",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  {
                    attrs: {
                      lg: "6",
                      md: "6",
                      label: "id_municipio",
                      title: "Municipio"
                    }
                  },
                  [
                    _c("v-municipio", {
                      attrs: { id_municipio: _vm.registro.id_municipio },
                      model: {
                        value: _vm.registro.id_municipio,
                        callback: function($$v) {
                          _vm.$set(_vm.registro, "id_municipio", $$v)
                        },
                        expression: "registro.id_municipio"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  { attrs: { label: "opm_autoridade_rg", title: "RG" } },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.opm_autoridade_rg,
                          expression: "registro.opm_autoridade_rg"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { size: "45", type: "text" },
                      domProps: { value: _vm.registro.opm_autoridade_rg },
                      on: {
                        keyup: _vm.dadosPM,
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "opm_autoridade_rg",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  {
                    attrs: {
                      label: "opm_autoridade_nome",
                      title: "Comandante/Chefe/Diretor"
                    }
                  },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.opm_autoridade_nome,
                          expression: "registro.opm_autoridade_nome"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { size: "45", readonly: "", type: "text" },
                      domProps: { value: _vm.registro.opm_autoridade_nome },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "opm_autoridade_nome",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "v-label",
                  {
                    attrs: { label: "opm_autoridade_funcao", title: "Função" }
                  },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.opm_autoridade_funcao,
                          expression: "registro.opm_autoridade_funcao"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { size: "45", type: "text" },
                      domProps: { value: _vm.registro.opm_autoridade_funcao },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "opm_autoridade_funcao",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _vm.canCreate
                      ? [
                          _c(
                            "v-tooltip",
                            {
                              attrs: {
                                effect: "scale",
                                placement: "top",
                                content: _vm.msgRequired
                              }
                            },
                            [
                              _vm.registro.id_cadastroopmcoger
                                ? _c(
                                    "a",
                                    {
                                      staticClass: "btn btn-success btn-block",
                                      attrs: { disabled: _vm.requireds },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.update(
                                            _vm.registro.id_cadastroopmcoger
                                          )
                                        }
                                      }
                                    },
                                    [_vm._v("Editar")]
                                  )
                                : _c(
                                    "a",
                                    {
                                      staticClass: "btn btn-success btn-block",
                                      attrs: { disabled: _vm.requireds },
                                      on: { click: _vm.create }
                                    },
                                    [_vm._v("Inserir")]
                                  )
                            ]
                          )
                        ]
                      : _vm._e()
                  ],
                  2
                )
              ],
              1
            )
          ])
        ])
      ]),
      _vm._v(" "),
      _vm.registro.id_cadastroopmcoger
        ? [
            _c("v-outras-autoridades", {
              attrs: { id_cadastroopmcoger: _vm.registro.id_cadastroopmcoger }
            })
          ]
        : _vm._e()
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "box-tools pull-right" }, [
      _c(
        "button",
        {
          staticClass: "btn btn-box-tool",
          attrs: { type: "button", "data-widget": "collapse" }
        },
        [_c("i", { staticClass: "fa fa-plus" })]
      )
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-53afc6df", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("04851976", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./DadosOpm.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./DadosOpm.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/DadosOpm.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-53afc6df\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-53afc6df\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/DadosOpm.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-53afc6df"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/DadosOpm.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-53afc6df", Component.options)
  } else {
    hotAPI.reload("data-v-53afc6df", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});