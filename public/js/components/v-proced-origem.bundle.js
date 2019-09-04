webpackJsonp([23],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_js__ = __webpack_require__("./resources/assets/js/mixins.js");
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


/* harmony default export */ __webpack_exports__["default"] = ({
    mixins: [__WEBPACK_IMPORTED_MODULE_0__mixins_js__["a" /* default */]],
    props: {
        unique: { type: Boolean, default: false }
    },
    data: function data() {
        var _ref;

        return _ref = {
            proc: '',
            ref: '',
            ano: '',
            opm: '',
            action: 'editar',
            procedimentos: []
        }, _defineProperty(_ref, 'action', 'proc'), _defineProperty(_ref, 'params', ''), _defineProperty(_ref, 'finded', false), _defineProperty(_ref, 'counter', 0), _defineProperty(_ref, 'id_proc', ''), _defineProperty(_ref, 'idp', ''), _defineProperty(_ref, 'origin', ''), _defineProperty(_ref, 'only', false), _ref;
    },

    // depois de montado
    beforeMount: function beforeMount() {
        this.listProc();
        this.verifyOnly();
    },

    filters: {
        uppercase: function uppercase(v) {
            return v.toUpperCase();
        }
    },
    computed: {
        years: function years() {
            var year = new Date().getFullYear();
            return Array.from({ length: year - 2008 }, function (value, index) {
                return 2009 + index;
            });
        },
        canDelete: function canDelete() {
            return this.permissions.includes('apagar-procedimento-origem');
        }
    },
    methods: {
        searchProc: function searchProc() {
            var _this = this;

            this.opm = '';
            var searchUrl = this.getBaseUrl + 'api/dados/proc/' + this.proc + '/' + this.ref + '/' + this.ano;
            if (this.proc && this.ref && this.ano) {
                axios.get(searchUrl).then(function (response) {
                    _this.opm = response.data.opm;
                    _this.idp = response.data.id;
                    _this.finded = response.data.success;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        createProc: function createProc() {
            var _this2 = this;

            var urlCreate = this.getBaseUrl + 'api/ligacao/store';

            var formData = document.getElementById('formData');
            var data = new FormData(formData);

            axios.post(urlCreate, data).then(this.listProc).catch(function (error) {
                console.log(error);
                _this2.erro = "Erro ao enviar arquivo";
            });
        },

        // listagem dos arquivos existentes
        listProc: function listProc() {
            var _this3 = this;

            var urlIndex = this.dano ? this.getBaseUrl + 'api/ligacao/list/' + this.dproc + '/' + this.dref + '/' + this.dano : this.getBaseUrl + 'api/ligacao/list/' + this.dproc + '/' + this.dref;
            axios.get(urlIndex).then(function (response) {
                _this3.procedimentos = response.data;
            }).then(this.clear) //limpa a busca
            .catch(function (error) {
                return console.log(error);
            });
        },
        showProc: function showProc(proc, ref, ano) {
            var urlIndex = '' + this.getBaseUrl + proc + '/' + this.action + '/' + ref + '/' + ano;
            window.open(urlIndex, "_blank");
        },

        // apagar arquivo
        removeProc: function removeProc(id) {
            var urlDelete = this.getBaseUrl + 'api/ligacao/destroy/' + id;
            axios.delete(urlDelete).then(this.listProc) //chama list para atualizar
            .catch(function (error) {
                return console.log(error);
            });
        },
        verifyOnly: function verifyOnly() {
            if (this.unique == true) {
                this.only = true;
            } else {
                this.only = false;
            }
        },
        cancel: function cancel() {
            this.add = false;
            this.proc = '';
            this.ref = '';
            this.ano = '';
            this.opm = '';
        },
        clear: function clear() {
            this.proc = '';
            this.ref = '';
            this.ano = '';
            this.opm = '';
        }
    },
    watch: {
        proc: function proc() {
            var name = this.proc == 'apfdc' || this.proc == 'apfdm' ? 'apfd' : this.proc;
            this.id_proc = 'id_' + name;
            this.origin = name;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-205688e0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _vm._m(0),
    _vm._v(" "),
    !_vm.only
      ? _c(
          "div",
          { staticClass: "card-body", class: _vm.add ? "bordaform" : "" },
          [
            !_vm.add
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
                      _vm._v(" Adicionar documento de origem")
                    ]
                  )
                ])
              : _c("div", [
                  _c(
                    "div",
                    { staticClass: "row", attrs: { id: "ligacaoForm1" } },
                    [
                      _c(
                        "form",
                        { attrs: { id: "formData", name: "formData" } },
                        [
                          _c("input", {
                            attrs: { type: "hidden", name: _vm.id_proc },
                            domProps: { value: _vm.idp }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "origem_proc" },
                            domProps: { value: _vm.origin }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "destino_proc" },
                            domProps: { value: _vm.dproc }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "destino_sjd_ref" },
                            domProps: { value: _vm.dref }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: {
                              type: "hidden",
                              name: "destino_sjd_ref_ano"
                            },
                            domProps: { value: _vm.dano }
                          }),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass:
                                "col-lg-3 col-md-3 col-xs-3 form-group"
                            },
                            [
                              _c("label", { attrs: { for: "origem_proc" } }, [
                                _vm._v("Processo/Procedimento")
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
                                      value: _vm.proc,
                                      expression: "proc"
                                    }
                                  ],
                                  staticClass: "form-control",
                                  attrs: { name: "origem_proc" },
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
                                      _vm.proc = $event.target.multiple
                                        ? $$selectedVal
                                        : $$selectedVal[0]
                                    }
                                  }
                                },
                                [
                                  _c("option", { attrs: { value: "" } }, [
                                    _vm._v("Escolha")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "ipm" } }, [
                                    _vm._v("IPM")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "sindicancia" } },
                                    [_vm._v("SINDICÂNCIA")]
                                  ),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "cd" } }, [
                                    _vm._v("CD")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "cj" } }, [
                                    _vm._v("CJ")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "apfdc" } }, [
                                    _vm._v("APFDC")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "apfdm" } }, [
                                    _vm._v("APFDM")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "fatd" } }, [
                                    _vm._v("FATD")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "iso" } }, [
                                    _vm._v("ISO")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "desercao" } },
                                    [_vm._v("DESERÇÃO")]
                                  ),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "it" } }, [
                                    _vm._v("IT")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "adl" } }, [
                                    _vm._v("ADL")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "pad" } }, [
                                    _vm._v("PAD")
                                  ]),
                                  _vm._v(" "),
                                  _c("option", { attrs: { value: "sai" } }, [
                                    _vm._v("SAI")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "option",
                                    { attrs: { value: "proc_outros" } },
                                    [_vm._v("PROC. OUTROS")]
                                  )
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "origem_sjd_ref" } },
                                [_vm._v("Referência")]
                              ),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.ref,
                                    expression: "ref"
                                  }
                                ],
                                staticClass: "numero form-control",
                                attrs: {
                                  type: "text",
                                  maxlength: "4",
                                  name: "origem_sjd_ref",
                                  placeholder: "Nº",
                                  value: ""
                                },
                                domProps: { value: _vm.ref },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.ref = $event.target.value
                                  }
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "origem_sjd_ref_ano" } },
                                [_vm._v("Ano")]
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
                                      value: _vm.ano,
                                      expression: "ano"
                                    }
                                  ],
                                  staticClass: "form-control",
                                  attrs: { name: "origem_sjd_ref_ano" },
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
                                      _vm.ano = $event.target.multiple
                                        ? $$selectedVal
                                        : $$selectedVal[0]
                                    }
                                  }
                                },
                                _vm._l(_vm.years, function(year) {
                                  return _c(
                                    "option",
                                    { key: year, domProps: { value: year } },
                                    [_vm._v(_vm._s(year))]
                                  )
                                }),
                                0
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-1 col-md-1 col-xs 1" },
                            [
                              _c("label", [_vm._v("Buscar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-info btn-block",
                                  on: {
                                    click: function($event) {
                                      return _vm.searchProc()
                                    }
                                  }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-search",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c("label", [_vm._v("OM")]),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                staticClass: "form-control",
                                attrs: {
                                  readonly: "",
                                  type: "text",
                                  size: "35",
                                  name: "origem_opm",
                                  placeholder: "Apenas para conferência"
                                },
                                domProps: { value: _vm.opm }
                              })
                            ]
                          ),
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
                                  on: { click: _vm.cancel }
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
                              _c("label", [_vm._v("Adicionar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-success btn-block",
                                  attrs: { disabled: !_vm.finded },
                                  on: { click: _vm.createProc }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-plus",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          )
                        ]
                      )
                    ]
                  )
                ])
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "card-footer" }, [
      _vm.procedimentos.length
        ? _c("div", { staticClass: "row bordaform" }, [
            _c("div", { staticClass: "col-sm-12" }, [
              _c("table", { staticClass: "table table-hover" }, [
                _vm._m(1),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.procedimentos, function(procedimento, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [
                        _vm._v(
                          "\n                                " +
                            _vm._s(index + 1) +
                            "\n                            "
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          "\n                                " +
                            _vm._s(
                              _vm._f("uppercase")(procedimento.origem_proc)
                            ) +
                            " " +
                            _vm._s(procedimento.origem_sjd_ref) +
                            "/" +
                            _vm._s(procedimento.origem_sjd_ref_ano) +
                            "\n                            "
                        )
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
                                attrs: { type: "button", target: "_blanck" },
                                on: {
                                  click: function($event) {
                                    return _vm.showProc(
                                      procedimento.origem_proc,
                                      procedimento.origem_sjd_ref,
                                      procedimento.origem_sjd_ref_ano
                                    )
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-eye" })]
                            ),
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
                                        return _vm.removeProc(
                                          procedimento.id_ligacao
                                        )
                                      }
                                    }
                                  },
                                  [_c("i", { staticClass: "fa fa-trash" })]
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
        : !_vm.procedimentos.length && _vm.only
        ? _c("div", [_vm._m(2)])
        : _vm._e()
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h5", [
        _c("b", [_vm._v("Procedimento(s) de Origem (apenas se houver)")])
      ])
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
        _c("th", { staticClass: "col-sm-8" }, [_vm._v("Proc. REF/ANO")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ver/Apagar Ligação")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Não há registtros")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-205688e0", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("92cb2390", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProcedOrigem.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProcedOrigem.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/ProcedOrigem.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-205688e0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-205688e0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/ProcedOrigem.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-205688e0"
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
Component.options.__file = "resources/assets/js/components/SubForm/ProcedOrigem.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-205688e0", Component.options)
  } else {
    hotAPI.reload("data-v-205688e0", Component.options)
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