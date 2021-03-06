webpackJsonp([69],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Medalha.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['pm'],
    data: function data() {
        return {
            module: 'medalha',
            registros: [],
            registro: {},
            punicoes: [],
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false
        };
    },
    created: function created() {
        this.list();
        this.canCreate = this.$root.hasPermission('criar-medalhas');
        this.canEdit = this.$root.hasPermission('editar-medalhas');
        this.canDelete = this.$root.hasPermission('apagar-medalhas');
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.nome_medalha && this.registro.obs_txt) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: NOME DA MEDALHA e DESCRI\xC7\xC3O deve estar preenchidos';
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                    _this.$emit('length', _this.length);
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.rg_cadastro = this.$root.dadoSession('rg');
            this.registro.rg = this.pm.RG;
            this.registro.cargo = this.pm.CARGO;
            this.registro.nome = this.pm.NOME;
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
            this.toCreate();
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
                this.list();
                this.$root.msg(msg.success, 'success');
                this.registro = {};
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

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Medalha.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-3ebc3905] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-3ebc3905] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3ebc3905\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Medalha.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "Medalhas", badge: _vm.lenght } },
    [
      _c(
        "table",
        { staticClass: "table table-striped" },
        [
          _vm.lenght
            ? [
                _c("thead", [
                  _c("tr", [
                    _c("th", { staticClass: "col-xs-2" }, [
                      _c("b", [_vm._v("Medalha")])
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [
                      _c("b", [_vm._v("N° BI")])
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [
                      _c("b", [_vm._v("Data BI")])
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-4" }, [
                      _c("b", [_vm._v("Descrição")])
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [
                      _c("b", [_vm._v("Ações")])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.registros, function(registro, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [_vm._v(_vm._s(registro.nome_medalha))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.bi_num))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.bi_data))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.obs_txt))]),
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
                                            registro.id_medalha
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("i", {
                                        staticClass: "fa fa-fw fa-trash-o "
                                      })
                                    ]
                                  )
                                ]
                              : _vm._e()
                          ],
                          2
                        )
                      ])
                    ])
                  }),
                  0
                )
              ]
            : [_c("tr", [_c("td", [_vm._v("Nada encontrado")])])]
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
                on: { click: _vm.toCreate }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v("Adicionar Medalha\n        ")
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _c(
        "v-modal",
        {
          attrs: { large: "", effect: "fade", width: "65%" },
          model: {
            value: _vm.showModal,
            callback: function($$v) {
              _vm.showModal = $$v
            },
            expression: "showModal"
          }
        },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.id_medalha,
                expression: "registro.id_medalha"
              }
            ],
            attrs: { type: "hidden", name: "id" },
            domProps: { value: _vm.registro.id_medalha },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "id_medalha", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "modal-header",
              attrs: { slot: "modal-header" },
              slot: "modal-header"
            },
            [
              _c("h4", { staticClass: "modal-title" }, [
                _vm.registro.id_medalha
                  ? _c("b", [_vm._v("Editar Medalha")])
                  : _c("b", [_vm._v("Inserir nova Medalha")])
              ])
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            { attrs: { slot: "modal-body" }, slot: "modal-body" },
            [
              _c("v-label", { attrs: { lg: "4", label: "rg", title: "RG" } }, [
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
                  attrs: {
                    type: "text",
                    size: "12",
                    maxlength: "25",
                    readonly: ""
                  },
                  domProps: { value: _vm.registro.rg },
                  on: {
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
              _c(
                "v-label",
                { attrs: { lg: "4", label: "cargo", title: "Posto/Grad." } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.cargo,
                        expression: "registro.cargo"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: {
                      type: "text",
                      size: "6",
                      maxlength: "10",
                      readonly: ""
                    },
                    domProps: { value: _vm.registro.cargo },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "cargo", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { lg: "4", label: "nome", title: "Nome" } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.nome,
                        expression: "registro.nome"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", size: "40", readonly: "" },
                    domProps: { value: _vm.registro.nome },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "nome", $event.target.value)
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
                    lg: "4",
                    label: "nome_medalha",
                    title: "Nome da medalha"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.nome_medalha,
                        expression: "registro.nome_medalha"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", size: "40", maxlength: "120" },
                    domProps: { value: _vm.registro.nome_medalha },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.registro,
                          "nome_medalha",
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
                    lg: "4",
                    label: "publicacao",
                    title: "N° BI",
                    tooltip: "Ex: BI nº 010/2011"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.bi_num,
                        expression: "registro.bi_num"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", size: "40", maxlength: "120" },
                    domProps: { value: _vm.registro.bi_num },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "bi_num", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { lg: "4", label: "data", title: "Data BI" } },
                [
                  _c("v-datepicker", {
                    attrs: {
                      placeholder: _vm.registro.bi_data,
                      "clear-button": ""
                    },
                    model: {
                      value: _vm.registro.bi_data,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "bi_data", $$v)
                      },
                      expression: "registro.bi_data"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "obs_txt",
                    title: "Observações",
                    lg: "12",
                    md: "12"
                  }
                },
                [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.obs_txt,
                        expression: "registro.obs_txt"
                      }
                    ],
                    attrs: {
                      id: "foco",
                      rows: "5",
                      cols: "105",
                      width: "100%"
                    },
                    domProps: { value: _vm.registro.obs_txt },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "obs_txt", $event.target.value)
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
                      _vm.registro.id_medalha
                        ? _c(
                            "a",
                            {
                              staticClass: "btn btn-success btn-block",
                              attrs: { disabled: _vm.requireds },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  return _vm.update(_vm.registro.id_medalha)
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
                ],
                1
              )
            ]
          )
        ]
      )
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3ebc3905", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Medalha.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Medalha.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("e3d789ea", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Medalha.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Medalha.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Medalha.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ebc3905\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Medalha.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Medalha.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3ebc3905\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Medalha.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3ebc3905"
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
Component.options.__file = "resources/assets/js/components/FDI/Medalha.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3ebc3905", Component.options)
  } else {
    hotAPI.reload("data-v-3ebc3905", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});