webpackJsonp([75],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue":
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


/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['id_cadastroopmcoger'],
    data: function data() {
        return {
            module: 'cadastroopmautoridade',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
            nome: ''
        };
    },
    created: function created() {
        this.canCreate = this.$root.hasPermission('criar-dados-unidade');
        this.canEdit = this.$root.hasPermission('editar-dados-unidade');
        this.canDelete = this.$root.hasPermission('apagar-dados-unidade');
        this.list();
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.rg && this.registro.funcao) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: RG e Fun\xE7\xE3o deve estar preenchidos';
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.id_cadastroopmcoger;
            if (this.id_cadastroopmcoger) {
                axios.get(urlIndex).then(function (response) {
                    console.log(response.data);
                    _this.registros = response.data[0];
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.id_cadastroopmcoger = this.id_cadastroopmcoger;
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
                this.registro = null;
                this.registro = {};
                this.list();
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

            if (this.registro.rg.length > 3) {
                var urlSearch = this.$root.baseUrl + 'api/dados/pm/' + this.registro.rg;
                axios.get(urlSearch).then(function (response) {
                    console.log('res', response);
                    var res = response.data.pm;
                    _this5.nome = res.cargo_ico + ' ' + res.quadro_ico + ' ' + res.nome_ico;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-1aa41d2b] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-1aa41d2b] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-1aa41d2b\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-xs-12" }, [
    _c("div", { staticClass: "box" }, [
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "box-body" }, [
        _c(
          "div",
          { staticClass: "col-md-12 col-xs-12" },
          [
            _c(
              "table",
              { staticClass: "table table-striped" },
              [
                _vm.lenght
                  ? [
                      _vm._m(1),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.registros, function(registro) {
                          return _c(
                            "tr",
                            { key: registro.id_cadastroopmcogerautoridade },
                            [
                              _c("td", [_vm._v(_vm._s(registro.rg))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(registro.funcao))]),
                              _vm._v(" "),
                              _c("td", [
                                _c(
                                  "span",
                                  [
                                    _vm.canEdit
                                      ? [
                                          _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-info",
                                              on: {
                                                click: function($event) {
                                                  return _vm.edit(registro)
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-fw fa-edit "
                                              })
                                            ]
                                          )
                                        ]
                                      : _vm._e(),
                                    _vm._v(" "),
                                    _vm.canDelete
                                      ? [
                                          _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-danger",
                                              on: {
                                                click: function($event) {
                                                  return _vm.destroy(
                                                    registro.id_cadastroopmcogerautoridade
                                                  )
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass:
                                                  "fa fa-fw fa-trash-o "
                                              })
                                            ]
                                          )
                                        ]
                                      : _vm._e()
                                  ],
                                  2
                                )
                              ])
                            ]
                          )
                        }),
                        0
                      )
                    ]
                  : [_vm._m(2)]
              ],
              2
            ),
            _vm._v(" "),
            _vm.canCreate
              ? [
                  _c(
                    "a",
                    {
                      staticClass: "btn btn-primary btn-block",
                      on: {
                        click: function($event) {
                          return _vm.toCreate("create")
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fa fa-plus" }),
                      _vm._v("Adicionar Autoridade\n                    ")
                    ]
                  )
                ]
              : _vm._e(),
            _vm._v(" "),
            _c(
              "v-modal",
              {
                attrs: { large: "", effect: "fade", width: "80%" },
                model: {
                  value: _vm.showModal,
                  callback: function($$v) {
                    _vm.showModal = $$v
                  },
                  expression: "showModal"
                }
              },
              [
                _c(
                  "div",
                  {
                    staticClass: "modal-header",
                    attrs: { slot: "modal-header" },
                    slot: "modal-header"
                  },
                  [
                    _c("h4", { staticClass: "modal-title" }, [
                      _vm.registro.id_cadastroopmcogerautoridade
                        ? _c("b", [_vm._v("Editar Autoridade")])
                        : _c("b", [_vm._v("Inserir nova Autoridade")])
                    ])
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { attrs: { slot: "modal-body" }, slot: "modal-body" },
                  [
                    _c("v-label", { attrs: { label: "rg", title: "RG" } }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.registro.rg,
                            expression: "registro.rg"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { size: "45", type: "text" },
                        domProps: { value: _vm.registro.rg },
                        on: {
                          keyup: _vm.dadosPM,
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.registro, "rg", $event.target.value)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("v-label", { attrs: { label: "nome", title: "Nome" } }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.nome,
                            expression: "nome"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", readonly: "" },
                        domProps: { value: _vm.nome },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.nome = $event.target.value
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c(
                      "v-label",
                      { attrs: { label: "funcao", title: "Função" } },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.registro.funcao,
                              expression: "registro.funcao"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: { size: "45", type: "text" },
                          domProps: { value: _vm.registro.funcao },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.registro,
                                "funcao",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ]
                    )
                  ],
                  1
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
                    _c("div", { staticClass: "col-xs-6" }, [
                      _c(
                        "a",
                        {
                          staticClass: "btn btn-default btn-block",
                          on: {
                            click: function($event) {
                              _vm.showModal = false
                            }
                          }
                        },
                        [_vm._v("Cancelar")]
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "col-xs-6" },
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
                                  _vm.registro.id_cadastroopmcogerautoridade
                                    ? _c(
                                        "a",
                                        {
                                          staticClass:
                                            "btn btn-success btn-block",
                                          attrs: { disabled: _vm.requireds },
                                          on: {
                                            click: function($event) {
                                              $event.preventDefault()
                                              return _vm.update(
                                                _vm.registro
                                                  .id_cadastroopmcogerautoridade
                                              )
                                            }
                                          }
                                        },
                                        [_vm._v("Editar")]
                                      )
                                    : _c(
                                        "a",
                                        {
                                          staticClass:
                                            "btn btn-success btn-block",
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
                  ]
                )
              ]
            )
          ],
          2
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "box-header" }, [
      _c("h2", { staticClass: "box-title" }, [_vm._v("Outras Autoridades")]),
      _vm._v(" "),
      _c("div", { staticClass: "box-tools pull-right" }, [
        _c(
          "button",
          {
            staticClass: "btn btn-box-tool",
            attrs: { type: "button", "data-widget": "collapse" }
          },
          [_c("i", { staticClass: "fa fa-plus" })]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "col-xs-4" }, [_vm._v("RG")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-4" }, [_vm._v("Função")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-4" }, [_vm._v("Ações")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [_c("td", [_vm._v("Nada encontrado")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1aa41d2b", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("f5408f74", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./OutrasAutoridades.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./OutrasAutoridades.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1aa41d2b\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-1aa41d2b\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/OutrasAutoridades.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1aa41d2b"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/OutrasAutoridades.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1aa41d2b", Component.options)
  } else {
    hotAPI.reload("data-v-1aa41d2b", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});