webpackJsonp([58],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Protocolo.vue":
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



/* harmony default export */ __webpack_exports__["default"] = ({
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_0_vue_the_mask__["TheMask"] },
    props: ['rg'],
    data: function data() {
        return {
            module: 'protocolo',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false
        };
    },
    mounted: function mounted() {
        this.list();
        this.canCreate = this.$root.hasPermission('criar-protocolo');
        this.canEdit = this.$root.hasPermission('editar-protocolo');
        this.canDelete = this.$root.hasPermission('apagar-protocolo');
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.numero && this.registro.descricao_txt) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: N\xDAMERO E DESCRI\xC7\xC3O deve estar preenchidos';
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.rg_autor = this.$root.dadoSession('rg');
            this.registro.rg = this.rg;
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

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Protocolo.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-3ab01cec] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-3ab01cec] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3ab01cec\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Protocolo.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "E-Protocolo", badge: _vm.lenght } },
    [
      _c(
        "table",
        { staticClass: "table table-striped" },
        [
          _vm.lenght
            ? [
                _c("thead", [
                  _c("tr", [
                    _c("th", { staticClass: "col-xs-1" }, [
                      _vm._v("N° Documento")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-4" }, [
                      _vm._v("Descrição")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-1" }, [_vm._v("RG Autor")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-1" }, [
                      _vm._v("RG Analista")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-3" }, [
                      _vm._v("Observações")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Ações")])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.registros, function(registro) {
                    return _c("tr", { key: registro.id_protocolo }, [
                      _c("td", [_vm._v(_vm._s(registro.numero))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.descricao_txt))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.rg_autor))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.rg_analista))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.obs))]),
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
                                            registro.id_protocolo
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
                _vm._v("Adicionar Protocolo\n        ")
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _c(
        "v-modal",
        {
          attrs: { large: "", effect: "fade" },
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
                _vm.registro.id_protocolo
                  ? _c("b", [_vm._v("Editar Protocolo")])
                  : _c("b", [_vm._v("Inserir novo Protocolo")])
              ])
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            { attrs: { slot: "modal-body" }, slot: "modal-body" },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.registro.id_protocolo,
                    expression: "registro.id_protocolo"
                  }
                ],
                attrs: { type: "hidden", name: "id" },
                domProps: { value: _vm.registro.id_protocolo },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.registro, "id_protocolo", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    lg: "6",
                    label: "numero",
                    title: "Numero do protocolo"
                  }
                },
                [
                  _c("the-mask", {
                    staticClass: "form-control",
                    attrs: {
                      mask: "##.###.###-#",
                      type: "text",
                      required: "",
                      placeholder: "00.000.000-0"
                    },
                    model: {
                      value: _vm.registro.numero,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "numero", $$v)
                      },
                      expression: "registro.numero"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { lg: "6", label: "rg", title: "RG cadastro" } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.rg_autor,
                        expression: "registro.rg_autor"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", readonly: "" },
                    domProps: { value: _vm.registro.rg_autor },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "rg_autor", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: { lg: "6", label: "rg_analista", title: "RG analista" }
                },
                [
                  _c("the-mask", {
                    staticClass: "form-control",
                    attrs: {
                      mask: "###############",
                      type: "text",
                      placeholder: "Só números"
                    },
                    model: {
                      value: _vm.registro.rg_analista,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "rg_analista", $$v)
                      },
                      expression: "registro.rg_analista"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { lg: "6", label: "obs", title: "Observações" } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.obs,
                        expression: "registro.obs"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", maxlength: "50" },
                    domProps: { value: _vm.registro.obs },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "obs", $event.target.value)
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
                    lg: "12",
                    label: "descricao_txt",
                    title: "Descrição"
                  }
                },
                [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.descricao_txt,
                        expression: "registro.descricao_txt"
                      }
                    ],
                    attrs: {
                      id: "foco",
                      rows: "5",
                      cols: "105",
                      width: "100%"
                    },
                    domProps: { value: _vm.registro.descricao_txt },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.registro,
                          "descricao_txt",
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
                      _vm.registro.id_protocolo
                        ? _c(
                            "a",
                            {
                              staticClass: "btn btn-success btn-block",
                              attrs: { disabled: _vm.requireds },
                              on: {
                                click: function($event) {
                                  return _vm.update(_vm.registro.id_protocolo)
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
    require("vue-hot-reload-api")      .rerender("data-v-3ab01cec", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Protocolo.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Protocolo.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7fcd2d8e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Protocolo.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Protocolo.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Protocolo.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ab01cec\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Protocolo.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Protocolo.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3ab01cec\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Protocolo.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3ab01cec"
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
Component.options.__file = "resources/assets/js/components/FDI/Protocolo.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3ab01cec", Component.options)
  } else {
    hotAPI.reload("data-v-3ab01cec", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});