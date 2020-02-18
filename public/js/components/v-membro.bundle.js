webpackJsonp([27],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Membro.vue":
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        idp: { type: String, default: '' },
        dproc: { type: String, default: '' }
    },
    data: function data() {
        return {
            add: false,
            nome: '',
            cargo: '',
            pms: [],
            subs: [],
            finded: false,
            situacao: false,
            counter: 0,
            only: false,
            situacoes: [],
            usados: [],
            // substituto
            substituido: false,
            idsubs: '',
            rgsubs: '',
            nomesubs: '',
            situacaosubs: '',
            substitute: false,
            titleSubstitute: '',
            indexsubs: '',
            mode: 'atuais'
        };
    },
    created: function created() {
        this.verifyOnly;
        this.listPM();
    },

    // watch: {
    //     rg() {
    //         if(!this.rg.length){
    //             this.nome = ''
    //             this.cargo = ''
    //         }
    //         this.searchPM()
    //     },
    // },
    computed: {
        verifyOnly: function verifyOnly() {
            if (this.unique == true) {
                this.only = true;
            } else {
                this.only = false;
            }
        },
        canReplace: function canReplace() {
            return this.$root.hasPermission('substituir-membros');
        },
        canDelete: function canDelete() {
            return this.$root.hasPermission('apagar-membros');
        }
    },
    methods: {
        searchPM: function searchPM() {
            var _this = this;

            var searchUrl = this.$root.baseUrl + 'api/dados/pm/' + this.rg;
            console.log('url', searchUrl);
            if (this.rg.length > 5) {
                if (this.substituido && this.rg == this.rgsubs) {
                    this.nome = 'Inválido - Mesmo RG informado';
                    this.cargo = 'Mesmo RG';
                    this.finded = false;
                } else {
                    axios.get(searchUrl).then(function (response) {
                        if (response.data.success) {
                            _this.nome = response.data['pm'].NOME || response.data['pm'].nome;
                            _this.cargo = response.data['pm'].CARGO || response.data['pm'].cargo;
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
            }
        },
        listPM: function listPM() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/dados/membros/' + this.dproc + '/' + this.idp;
            if (this.dproc && this.idp) {
                axios.get(urlIndex).then(function (response) {
                    _this2.pms = response.data.membros;
                    _this2.subs = response.data.subs;
                    _this2.usados = response.data.usados;
                }).then(function () {
                    var usados = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : _this2.usados;

                    var situacoes = ['Acusador', 'Encarregado', 'Escrivão', 'Membro', 'Presidente'];
                    _this2.situacoes = situacoes.filter(function (a) {
                        return !_this2.usados.includes(a);
                    });
                }) // atualiza disponíveis
                .then(this.clear(false)).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        createPM: function createPM() {
            var urlCreate = this.$root.baseUrl + 'api/membros/store';

            var formFormMembro = document.getElementById('formFormMembro');
            var data = new FormData(formFormMembro);

            axios.post(urlCreate, data).then(this.listPM()) //limpa a busca
            .catch(function (error) {
                return console.log(error);
            });
        },
        showPM: function showPM(rg) {
            var urlIndex = this.$root.baseUrl + 'fdi/' + rg + '/ver';
            window.open(urlIndex, "_blank");
        },
        removePM: function removePM(id, situacao, index) {
            if (confirm('Você tem certeza?')) {
                this.clear(false); //limpa a busca

                var urlDelete = this.$root.baseUrl + 'api/membros/destroy/' + id;
                axios.delete(urlDelete).then(this.updateSituacao(situacao, 'remove')).then(this.pms.splice(index, 1)).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        updateSituacao: function updateSituacao(situacao, tipo) {
            var _this3 = this;

            if (tipo == 'add') {
                this.usados.push(situacao);
            } else {
                var search = this.usados.indexOf(situacao);
                this.usados.splice(search, 1);
            }
            var situacoes = ['Acusador', 'Encarregado', 'Escrivão', 'Membro', 'Presidente'];
            this.situacoes = situacoes.filter(function (a) {
                return !_this3.usados.includes(a);
            });
        },
        replacePM: function replacePM(pm, index) {
            this.titleSubstitute = ' - Substitui\xE7\xE3o do ' + pm.situacao + ' ' + pm.nome;
            this.substituido = true;
            this.rgsubs = pm.rg;
            this.nomesubs = pm.nome;
            this.situacaosubs = pm.situacao;
            this.idsubs = pm.id_envolvido;
            this.indexsubs = index;
            this.add = true;
        },
        clear: function clear(add) {
            this.add = add;
            this.rg = '';
            this.nome = '';
            this.cargo = '';
            this.situacao = '';
            this.substituido = false;
            this.rgsubs = '';
            this.nomesubs = '', this.situacaosubs = '', this.substitute = false;
            this.titleSubstitute = '';
            this.finded = false;
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membro.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-aebcc5e8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Membro.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _c("div", { staticClass: "card-header" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-sm-10" }, [
          _c("h5", [
            _c("b", [_vm._v("Membros " + _vm._s(_vm.titleSubstitute || ""))])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col align-self-end" }, [
          _c("div", { staticClass: "btn-group" }, [
            _c(
              "a",
              {
                staticClass: "btn",
                class: _vm.mode == "atuais" ? "btn-info" : "btn-default",
                on: {
                  click: function($event) {
                    _vm.mode = "atuais"
                  }
                }
              },
              [_vm._v("\n                        Atuais\n                    ")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "btn",
                class: _vm.mode == "substituidos" ? "btn-info" : "btn-default",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    _vm.mode = "substituidos"
                  }
                }
              },
              [
                _vm._v(
                  "\n                        Substituídos\n                    "
                )
              ]
            )
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c("br"),
    _vm._v(" "),
    _vm.mode == "atuais" && !_vm.only
      ? _c(
          "div",
          { staticClass: "card-body ", class: _vm.add ? "bordaform" : "" },
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
                      _vm._v(" Adicionar membro")
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
                        {
                          attrs: {
                            id: "formFormMembro",
                            name: "formFormMembro"
                          }
                        },
                        [
                          _c("input", {
                            attrs: { type: "hidden", name: "id_" + _vm.dproc },
                            domProps: { value: _vm.idp }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "indexsubs" },
                            domProps: { value: _vm.indexsubs }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "idsubs" },
                            domProps: { value: _vm.idsubs }
                          }),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-3 col-md-4 col-xs 4" },
                            [
                              !_vm.substituido
                                ? [
                                    _c("label", { attrs: { for: "rg" } }, [
                                      _vm._v("RG")
                                    ]),
                                    _c("br")
                                  ]
                                : [
                                    _c("label", { attrs: { for: "rg" } }, [
                                      _vm._v("RG Substituto")
                                    ]),
                                    _c("br")
                                  ],
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.rg,
                                    expression: "rg"
                                  }
                                ],
                                staticClass: "numero form-control",
                                attrs: {
                                  type: "text",
                                  maxlength: "12",
                                  name: "rg",
                                  placeholder: "Nº"
                                },
                                domProps: { value: _vm.rg },
                                on: {
                                  keyup: function($event) {
                                    return _vm.searchPM()
                                  },
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.rg = $event.target.value
                                  }
                                }
                              })
                            ],
                            2
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-3 col-md-2 col-xs 2" },
                            [
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
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
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
                            { staticClass: "col-lg-2 col-md-2 col-xs 2" },
                            [
                              _c("label", { attrs: { for: "situacao" } }, [
                                _vm._v("Situação")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              !_vm.substituido
                                ? _c(
                                    "select",
                                    {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.situacao,
                                          expression: "situacao"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      attrs: {
                                        name: "situacao",
                                        disabled: !_vm.finded,
                                        required: ""
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
                                          _vm.situacao = $event.target.multiple
                                            ? $$selectedVal
                                            : $$selectedVal[0]
                                        }
                                      }
                                    },
                                    _vm._l(_vm.situacoes, function(s, index) {
                                      return _c(
                                        "option",
                                        { key: index, domProps: { value: s } },
                                        [_vm._v(_vm._s(s))]
                                      )
                                    }),
                                    0
                                  )
                                : _c("input", {
                                    staticClass: "form-control",
                                    attrs: {
                                      type: "text",
                                      name: "situacao",
                                      readonly: ""
                                    },
                                    domProps: { value: _vm.situacaosubs }
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
                              !_vm.substituido
                                ? [
                                    _c("label", [_vm._v("Adicionar")]),
                                    _c("br"),
                                    _vm._v(" "),
                                    _c(
                                      "a",
                                      {
                                        staticClass:
                                          "btn btn-success btn-block",
                                        attrs: { disabled: !_vm.situacao },
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
                                : [
                                    _c("label", [_vm._v("Substituir")]),
                                    _c("br"),
                                    _vm._v(" "),
                                    _c(
                                      "a",
                                      {
                                        staticClass:
                                          "btn btn-success btn-block",
                                        attrs: { disabled: !_vm.finded },
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
                        ]
                      )
                    ]
                  )
                ])
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-footer" },
      [
        _vm.mode == "atuais"
          ? [
              _vm._m(0),
              _vm._v(" "),
              _vm.pms.length
                ? _c("div", { staticClass: "row bordaform" }, [
                    _c("div", { staticClass: "col-sm-12" }, [
                      _c("table", { staticClass: "table table-hover" }, [
                        _vm._m(1),
                        _vm._v(" "),
                        _c(
                          "tbody",
                          _vm._l(_vm.pms, function(pm, index) {
                            return _c("tr", { key: index }, [
                              _c("td", [_vm._v(_vm._s(index + 1))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(pm.rg))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(pm.nome))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(pm.cargo))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(pm.situacao))]),
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
                                    _vm.canReplace
                                      ? _c(
                                          "a",
                                          {
                                            staticClass: "btn btn-success",
                                            staticStyle: { color: "white" },
                                            attrs: { type: "button" },
                                            on: {
                                              click: function($event) {
                                                return _vm.replacePM(pm, index)
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-retweet"
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
                                                  pm.situacao,
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
                : _c("div", [
                    _c("h6", [
                      _vm._v(
                        "\n                    Não há registros\n                "
                      )
                    ])
                  ])
            ]
          : [
              _vm._m(2),
              _vm._v(" "),
              _vm.subs.length
                ? _c("div", { staticClass: "row bordaform" }, [
                    _c("div", { staticClass: "col-sm-12" }, [
                      _c("table", { staticClass: "table table-hover" }, [
                        _vm._m(3),
                        _vm._v(" "),
                        _c(
                          "tbody",
                          _vm._l(_vm.subs, function(s, index) {
                            return _c("tr", { key: index }, [
                              _c("td", [_vm._v(_vm._s(index + 1))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(s.rg))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(s.nome))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(s.cargo))]),
                              _vm._v(" "),
                              _c("td", [
                                _c("i", {
                                  staticClass: "fa fa-sign-out",
                                  staticStyle: { color: "red" }
                                }),
                                _vm._v(_vm._s(s.situacao)),
                                _c("br"),
                                _vm._v(" "),
                                _c("i", {
                                  staticClass: "fa fa-sign-in",
                                  staticStyle: { color: "green" }
                                }),
                                _vm._v(
                                  _vm._s(s.rg_substituto) +
                                    "\n                                "
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
                                        attrs: {
                                          type: "button",
                                          target: "_blanck"
                                        },
                                        on: {
                                          click: function($event) {
                                            return _vm.showPM(s.rg)
                                          }
                                        }
                                      },
                                      [_c("i", { staticClass: "fa fa-eye" })]
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
                : _c("div", [
                    _c("h6", [
                      _vm._v(
                        "\n                    Não há registros substituídos\n                "
                      )
                    ])
                  ])
            ]
      ],
      2
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Atuais")])])
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
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Situação")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ver/Substituir/Apagar")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h5", [_c("b", [_vm._v("Substituídos")])])
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
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Situação")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ver")])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-aebcc5e8", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membro.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membro.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7f634160", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Membro.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Membro.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/SubForm/Membro.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aebcc5e8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Membro.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Membro.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-aebcc5e8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Membro.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-aebcc5e8"
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
Component.options.__file = "resources/assets/js/components/SubForm/Membro.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-aebcc5e8", Component.options)
  } else {
    hotAPI.reload("data-v-aebcc5e8", Component.options)
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