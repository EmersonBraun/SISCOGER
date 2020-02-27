webpackJsonp([25],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Reus.vue":
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        idp: { type: String, default: '' },
        dproc: { type: String, default: '' }
    },
    data: function data() {
        return {
            reu: [],
            reus: [],
            edit: false,
            idedit: '',
            resultado: false,
            only: false,
            titleSubstitute: ''
        };
    },

    filters: {
        SN: function SN(value) {
            var v = !value ? '-' : value;
            if (v.length < 2) {
                var t = v.toUpperCase() == 'S' || v.toUpperCase() == 'Y' || v == 1 ? 'Sim' : 'Não';
                return t;
            }
            return v;
        }
    },
    created: function created() {
        this.$root.baseUrl;
        this.verifyOnly;
        this.listReus();
    },

    watch: {
        reus: {
            handler: function handler(r) {
                var name = '' + this.dproc + this.idp + 'acusados';
                localStorage.name = r;
            },
            deep: true
        }
    },
    computed: {},
    methods: {
        listReus: function listReus() {
            var name = '' + this.dproc + this.idp + 'acusados';
            var json = sessionStorage.getItem(name);
            var array = JSON.parse(json);
            this.reus = Array.isArray(array) ? array : [];
        },
        showReu: function showReu(rg) {
            var urlIndex = this.$root.baseUrl + 'fdi/' + rg + '/ver';
            window.open(urlIndex, "_blank");
        },
        replaceReu: function replaceReu(reu) {
            this.reu = reu, this.titleSubstitute = ' - Edi\xE7\xE3o ' + reu.nome + '/RG:' + reu.rg;
            this.idedit = reu.id_envolvido;
            this.edit = true;
        },
        editReu: function editReu() {
            var _this = this;

            var urledit = this.$root.baseUrl + 'api/acusado/edit/' + this.idedit;
            var formReus = document.getElementById('formReus');
            var data = new FormData(formReus);

            axios.post(urledit, data).then(function () {
                _this.atualizaReus();
            }).catch(function (error) {
                return console.log(error);
            });
        },
        atualizaReus: function atualizaReus() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/dados/envolvido/' + this.dproc + '/' + this.idp + '/' + this.situacao;
            if (this.dproc && this.idp && this.situacao) {
                axios.get(urlIndex).then(function (response) {
                    _this2.reus = response.data;
                    var name = '' + _this2.dproc + _this2.idp + 'acusados';
                    sessionStorage.setItem(name, JSON.stringify(_this2.reus));
                }).then(this.clear(false)) //limpa a busca
                .catch(function (error) {
                    return console.log(error);
                });
            }
        },
        liberaCampo: function liberaCampo(reu) {
            if (reu.ipm_processocrime == 'Denunciado' && reu.ipm_julgamento == 'Absolvido') return true;
            if (reu.ipm_processocrime != 'Denunciado' && reu.ipm_julgamento == 'Condenado' && reu.ipm_tipodapena) return true;
        },
        clear: function clear(edit) {
            this.edit = edit;
            this.reu = [];
            this.titleSubstitute = '';
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Reus.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-256f281a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Reus.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _c("div", { staticClass: "card-header" }, [
      _c("h5", [_c("b", [_vm._v("Réus")]), _vm._v(_vm._s(_vm.titleSubstitute))])
    ]),
    _vm._v(" "),
    _vm.edit
      ? _c("div", [
          !_vm.only
            ? _c(
                "div",
                {
                  staticClass: "card-body",
                  class: _vm.edit ? "bordaform" : ""
                },
                [
                  _c(
                    "form",
                    { attrs: { id: "formReus", name: "formReus" } },
                    [
                      _c("input", {
                        attrs: { type: "hidden", name: "id_" + _vm.dproc },
                        domProps: { value: _vm.idp }
                      }),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-6 col-md-6 col-xs-6" }, [
                        _c("label", { attrs: { for: "ipm_processocrime" } }, [
                          _vm._v("Processo crime")
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
                                value: _vm.reu.ipm_processocrime,
                                expression: "reu.ipm_processocrime"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: { name: "ipm_processocrime" },
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
                                  _vm.reu,
                                  "ipm_processocrime",
                                  $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                )
                              }
                            }
                          },
                          [
                            _c("option", { attrs: { value: "" } }, [
                              _vm._v("Selecione")
                            ]),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Denunciado" } }, [
                              _vm._v("Denunciado")
                            ]),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Arquivado" } }, [
                              _vm._v("Arquivado")
                            ])
                          ]
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-6 col-md-6 col-xs-6" }, [
                        _c("label", { attrs: { for: "ipm_julgamento" } }, [
                          _vm._v("Julgamento")
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
                                value: _vm.reu.ipm_julgamento,
                                expression: "reu.ipm_julgamento"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: { name: "ipm_julgamento" },
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
                                  _vm.reu,
                                  "ipm_julgamento",
                                  $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                )
                              }
                            }
                          },
                          [
                            _c("option", { attrs: { value: "" } }, [
                              _vm._v("Selecione")
                            ]),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Condenado" } }, [
                              _vm._v("Condenado")
                            ]),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Absolvido" } }, [
                              _vm._v("Absolvido")
                            ])
                          ]
                        )
                      ]),
                      _vm._v(" "),
                      _vm.reu.ipm_julgamento == "Condenado"
                        ? [
                            _c(
                              "div",
                              { staticClass: "col-lg-1 col-md-1 col-xs-1" },
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
                                    value: _vm.reu.ipm_pena_anos,
                                    callback: function($$v) {
                                      _vm.$set(_vm.reu, "ipm_pena_anos", $$v)
                                    },
                                    expression: "reu.ipm_pena_anos"
                                  }
                                })
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-1 col-md-1 col-xs-1" },
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
                                    value: _vm.reu.ipm_pena_meses,
                                    callback: function($$v) {
                                      _vm.$set(_vm.reu, "ipm_pena_meses", $$v)
                                    },
                                    expression: "reu.ipm_pena_meses"
                                  }
                                })
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-1 col-md-1 col-xs-1" },
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
                                    value: _vm.reu.ipm_pena_dias,
                                    callback: function($$v) {
                                      _vm.$set(_vm.reu, "ipm_pena_dias", $$v)
                                    },
                                    expression: "reu.ipm_pena_dias"
                                  }
                                })
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-3 col-md-3 col-xs-3" },
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
                                    value: _vm.reu.ipm_transitojulgado_bl,
                                    callback: function($$v) {
                                      _vm.$set(
                                        _vm.reu,
                                        "ipm_transitojulgado_bl",
                                        $$v
                                      )
                                    },
                                    expression: "reu.ipm_transitojulgado_bl"
                                  }
                                })
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-2 col-md-2 col-xs-2" },
                              [
                                _c(
                                  "label",
                                  { attrs: { for: "ipm_tipodapena" } },
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
                                        value: _vm.reu.ipm_tipodapena,
                                        expression: "reu.ipm_tipodapena"
                                      }
                                    ],
                                    staticClass: "form-control",
                                    attrs: { name: "ipm_tipodapena" },
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
                                        _vm.$set(
                                          _vm.reu,
                                          "ipm_tipodapena",
                                          $event.target.multiple
                                            ? $$selectedVal
                                            : $$selectedVal[0]
                                        )
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
                                      { attrs: { value: "Detenção" } },
                                      [_vm._v("Detenção")]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "option",
                                      { attrs: { value: "Reclusão" } },
                                      [_vm._v("Reclusão")]
                                    )
                                  ]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "col-lg-3 col-md-3 col-xs-3" },
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
                                    value: _vm.reu.ipm_restritiva_bl,
                                    callback: function($$v) {
                                      _vm.$set(
                                        _vm.reu,
                                        "ipm_restritiva_bl",
                                        $$v
                                      )
                                    },
                                    expression: "reu.ipm_restritiva_bl"
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
                        { staticClass: "col-lg-10 col-md-10 col-xs-10" },
                        [
                          _c("label", { attrs: { for: "obs_txt" } }, [
                            _vm._v("Observações")
                          ]),
                          _c("br"),
                          _vm._v(" "),
                          _c("input", {
                            staticClass: "numero form-control",
                            attrs: { type: "text", name: "obs_txt" },
                            domProps: { value: _vm.reu.obs_txt }
                          })
                        ]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-1 col-md-1 col-xs-1" }, [
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
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-1 col-md-1 col-xs-1" }, [
                        _c("label", [_vm._v("Editar")]),
                        _c("br"),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            staticClass: "btn btn-success btn-block",
                            attrs: { disabled: _vm.liberaCampo(_vm.reu) },
                            on: { click: _vm.editReu }
                          },
                          [
                            _c("i", {
                              staticClass: "fa fa-plus",
                              staticStyle: { color: "white" }
                            })
                          ]
                        )
                      ])
                    ],
                    2
                  )
                ]
              )
            : _vm._e()
        ])
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "card-footer" }, [
      _vm.reus.length
        ? _c("div", { staticClass: "row bordaform" }, [
            _c("div", { staticClass: "col-sm-12" }, [
              _c("table", { staticClass: "table table-hover" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.reus, function(reu, index) {
                    return _c(
                      "tr",
                      { key: index },
                      [
                        _c("td", [_vm._v(_vm._s(index + 1))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(reu.rg))]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(_vm._s(_vm._f("SN")(reu.ipm_processocrime)))
                        ]),
                        _vm._v(" "),
                        reu.ipm_julgamento && reu.ipm_julgamento == "Absolvido"
                          ? [
                              _c("td", [_vm._v(_vm._s(reu.ipm_julgamento))]),
                              _vm._v(" "),
                              _c("td", [_vm._v("-")]),
                              _vm._v(" "),
                              _c("td", [_vm._v("-")])
                            ]
                          : [
                              _c("td", [
                                _vm._v(
                                  _vm._s(_vm._f("SN")(reu.ipm_julgamento)) +
                                    ": \n                                    " +
                                    _vm._s(reu.ipm_pena_anos)
                                ),
                                _c("b", [_vm._v("A")]),
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(reu.ipm_pena_meses)
                                ),
                                _c("b", [_vm._v("M")]),
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(reu.ipm_pena_dias)
                                ),
                                _c("b", [_vm._v("D")]),
                                _vm._v(
                                  " \n                                    Transitado? "
                                ),
                                _c("b", [
                                  _vm._v(
                                    _vm._s(
                                      _vm._f("SN")(reu.ipm_transitojulgado_bl)
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("td", [
                                _vm._v(_vm._s(_vm._f("SN")(reu.ipm_tipodapena)))
                              ]),
                              _vm._v(" "),
                              _c("td", [
                                _vm._v(
                                  _vm._s(_vm._f("SN")(reu.ipm_restritiva_bl))
                                )
                              ])
                            ],
                        _vm._v(" "),
                        _c("td", [
                          _c("div", { staticClass: "btn-group" }, [
                            _c(
                              "a",
                              {
                                staticClass: "btn btn-success",
                                staticStyle: { color: "white" },
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    return _vm.replaceReu(reu)
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-edit" })]
                            )
                          ])
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
      !_vm.reus.length && _vm.only ? _c("div", [_vm._m(1)]) : _vm._e()
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("RG")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("Processo crime")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-3" }, [_vm._v("Julgamento")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Tipo pena")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Rest. direito")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ações")])
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
    require("vue-hot-reload-api")      .rerender("data-v-256f281a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Reus.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Reus.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("6e3dd846", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Reus.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Reus.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/Reus.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-256f281a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Reus.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Reus.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-256f281a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Reus.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-256f281a"
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
Component.options.__file = "resources/assets/js/components/SubForm/Reus.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-256f281a", Component.options)
  } else {
    hotAPI.reload("data-v-256f281a", Component.options)
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
            add: false
        };
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
        create: function create() {
            var _this2 = this;

            var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
            axios.post(urlCreate, this.registro).then(function (response) {
                _this2.transation(response.data.success, 'create');
            }).catch(function (error) {
                return console.log(error);
            });
            this.showModal = false;
        },
        edit: function edit(registro) {
            this.registro = registro;
            this.showModal = true;
        },
        update: function update(id) {
            var _this3 = this;

            var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
            axios.put(urlUpdate, this.registro).then(function (response) {
                _this3.transation(response.data.success, 'edit');
            }).catch(function (error) {
                return console.log(error);
            });
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
                this.registro = [];
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

/***/ })

});