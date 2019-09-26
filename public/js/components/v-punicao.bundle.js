webpackJsonp([57],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Punicao.vue":
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


/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['pm'],
    data: function data() {
        return {
            module: 'punicao',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
            isCoger: false
        };
    },
    mounted: function mounted() {
        this.list();
        this.canCreate = this.$root.hasPermission('criar-tramite-coger');
        this.canEdit = this.$root.hasPermission('editar-tramite-coger');
        this.canDelete = this.$root.hasPermission('apagar-tramite-coger');
        this.isCoger = this.$root.hasPermission('COGER');
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.punicao_data && this.registro.descricao_txt) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: DATA DA PUNI\xC7\xC3O e DESCRI\xC7\xC3O deve estar preenchidos';
        },
        hasDias: function hasDias() {
            if (this.registro.id_gradacao == 2 || this.registro.id_gradacao == 4 || this.registro.id_gradacao == 5 || this.registro.dias) return true;
            return false;
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate(type) {
            this.showModal = true;
            if (type == 'create') this.registro.id_punicao = null;
            this.registro.rg = this.pm.RG;
            this.registro.cargo = this.pm.CARGO;
            this.registro.nome = this.pm.NOME;
            this.registro.rg_cadastro = this.$root.dadoSession('rg');
            this.registro.opm_abreviatura = this.$root.dadoSession('opm_abreviatura');
            this.registro.digitador = this.$root.dadoSession('nome');
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
            this.toCreate('edit');
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
                this.registro = null;
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

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Punicao.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-647267a6] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-647267a6] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-647267a6\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Punicao.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "Histórico Funcional", badge: _vm.lenght } },
    [
      _c(
        "table",
        { staticClass: "table table-striped" },
        [
          _vm.lenght
            ? [
                _c("thead", [
                  _c("tr", [
                    _c("th", { staticClass: "col-xs-1" }, [_vm._v("Data")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-1" }, [
                      _vm._v("Classificação")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-1" }, [_vm._v("Gradação")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-5" }, [
                      _vm._v("Descrição")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("OPM")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Ações")])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.registros, function(registro) {
                    return _c("tr", { key: registro.id_punicao }, [
                      _c("td", [_vm._v(_vm._s(registro.data))]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(registro.classpunicao || "Não cadastrado")
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(registro.gradacao || "Não cadastrado"))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.descricao_txt))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.opm_abreviatura))]),
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
                                            registro.id_punicao
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
                on: {
                  click: function($event) {
                    return _vm.toCreate("create")
                  }
                }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v("Adicionar Punição\n        ")
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
                _vm.registro.id_punicao
                  ? _c("b", [_vm._v("Editar Punição")])
                  : _c("b", [_vm._v("Inserir nova Punição")])
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
                    value: _vm.registro.rg_cadastro,
                    expression: "registro.rg_cadastro"
                  }
                ],
                attrs: { type: "hidden" },
                domProps: { value: _vm.registro.rg_cadastro },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.registro, "rg_cadastro", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.registro.opm_abreviatura,
                    expression: "registro.opm_abreviatura"
                  }
                ],
                attrs: { type: "hidden" },
                domProps: { value: _vm.registro.opm_abreviatura },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(
                      _vm.registro,
                      "opm_abreviatura",
                      $event.target.value
                    )
                  }
                }
              }),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.registro.digitador,
                    expression: "registro.digitador"
                  }
                ],
                attrs: { type: "hidden" },
                domProps: { value: _vm.registro.digitador },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.registro, "digitador", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
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
                { attrs: { label: "cargo", title: "Posto/Grad." } },
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
              _c("v-label", { attrs: { label: "nome", title: "Nome" } }, [
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
              ]),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "cdopm", title: "OPM da Punicao" } },
                [
                  _c("v-opm", {
                    attrs: { name: "cdopm", cdopm: "registro.cdopm" },
                    model: {
                      value: _vm.registro.cdopm,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "cdopm", $$v)
                      },
                      expression: "registro.cdopm"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "procedimento", title: "Procedimento" } },
                [
                  _vm.registro.id_punicao && _vm.registro.procedimento
                    ? _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.registro.procedimento,
                            expression: "registro.procedimento"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          size: "6",
                          maxlength: "10",
                          readonly: ""
                        },
                        domProps: { value: _vm.registro.procedimento },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.registro,
                              "procedimento",
                              $event.target.value
                            )
                          }
                        }
                      })
                    : _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.registro.procedimento,
                              expression: "registro.procedimento"
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
                                "procedimento",
                                $event.target.multiple
                                  ? $$selectedVal
                                  : $$selectedVal[0]
                              )
                            }
                          }
                        },
                        [
                          _c("option", { attrs: { value: "NA" } }, [
                            _vm._v("FATD S/N COGER")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "fatd" } }, [
                            _vm._v("FATD")
                          ]),
                          _vm._v(" "),
                          _vm.isCoger
                            ? [
                                _c("option", { attrs: { value: "cd" } }, [
                                  _vm._v("CD")
                                ]),
                                _vm._v(" "),
                                _c("option", { attrs: { value: "cj" } }, [
                                  _vm._v("CJ")
                                ]),
                                _vm._v(" "),
                                _c("option", { attrs: { value: "adl" } }, [
                                  _vm._v("ADL")
                                ])
                              ]
                            : _vm._e()
                        ],
                        2
                      )
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "sjd_ref", title: "Nº Referência" } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.sjd_ref,
                        expression: "registro.sjd_ref"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: {
                      type: "text",
                      size: "6",
                      maxlength: "10",
                      readonly: _vm.registro.id_punicao && _vm.registro.sjd_ref
                    },
                    domProps: { value: _vm.registro.sjd_ref },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "sjd_ref", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c("v-label", { attrs: { label: "sjd_ref_ano", title: "Ano" } }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.sjd_ref_ano,
                      expression: "registro.sjd_ref_ano"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: {
                    type: "text",
                    size: "6",
                    maxlength: "10",
                    readonly:
                      _vm.registro.id_punicao && _vm.registro.sjd_ref_ano
                  },
                  domProps: { value: _vm.registro.sjd_ref_ano },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "sjd_ref_ano", $event.target.value)
                    }
                  }
                })
              ]),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "punicao_data",
                    title: "Data da punição",
                    icon: "fa fa-calendar"
                  }
                },
                [
                  _c("v-datepicker", {
                    attrs: {
                      name: "punicao_data",
                      placeholder: _vm.registro.punicao_data,
                      "clear-button": ""
                    },
                    model: {
                      value: _vm.registro.punicao_data,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "punicao_data", $$v)
                      },
                      expression: "registro.punicao_data"
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
                    label: "ultimodia_data",
                    title: "Ultimo dia de cumprimento da punição",
                    tooltip: "Art. 63 RDE",
                    icon: "fa fa-calendar"
                  }
                },
                [
                  _c("v-datepicker", {
                    attrs: {
                      name: "ultimodia_data",
                      placeholder: _vm.registro.ultimodia_data,
                      "clear-button": ""
                    },
                    model: {
                      value: _vm.registro.ultimodia_data,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "ultimodia_data", $$v)
                      },
                      expression: "registro.ultimodia_data"
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
                    label: "id_classpunicao",
                    title: "Classificação da punição"
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
                          value: _vm.registro.id_classpunicao,
                          expression: "registro.id_classpunicao"
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
                            "id_classpunicao",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "1" } }, [_vm._v("Leve")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "2" } }, [
                        _vm._v("Média")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "3" } }, [_vm._v("Grave")])
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _vm.registro.id_classpunicao || _vm.registro.id_gradacao
                ? _c(
                    "v-label",
                    {
                      attrs: {
                        label: "id_gradacao",
                        title: "Gradação da punição"
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
                              value: _vm.registro.id_gradacao,
                              expression: "registro.id_gradacao"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: { name: "id_gradacao" },
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
                                "id_gradacao",
                                $event.target.multiple
                                  ? $$selectedVal
                                  : $$selectedVal[0]
                              )
                            }
                          }
                        },
                        [
                          _vm.registro.id_classpunicao == 1
                            ? [
                                _c("option", { attrs: { value: "1" } }, [
                                  _vm._v("Advertência")
                                ]),
                                _vm._v(" "),
                                _c("option", { attrs: { value: "2" } }, [
                                  _vm._v("Impedimento Disciplinar")
                                ])
                              ]
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.registro.id_classpunicao == 2
                            ? [
                                _c("option", { attrs: { value: "3" } }, [
                                  _vm._v("Repreensão")
                                ]),
                                _vm._v(" "),
                                _c("option", { attrs: { value: "4" } }, [
                                  _vm._v("Detenção")
                                ])
                              ]
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.registro.id_classpunicao == 3
                            ? [
                                _c("option", { attrs: { value: "5" } }, [
                                  _vm._v("Prisão")
                                ])
                              ]
                            : _vm._e()
                        ],
                        2
                      )
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.hasDias
                ? [
                    _c(
                      "v-label",
                      { attrs: { label: "dias", title: "Quantidade de dias" } },
                      [
                        _c("the-mask", {
                          staticClass: "form-control",
                          attrs: {
                            mask: "####",
                            type: "text",
                            maxlength: "4",
                            name: "dias",
                            placeholder: "Dias"
                          },
                          model: {
                            value: _vm.registro.dias,
                            callback: function($$v) {
                              _vm.$set(_vm.registro, "dias", $$v)
                            },
                            expression: "registro.dias"
                          }
                        })
                      ],
                      1
                    )
                  ]
                : _vm._e(),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "descricao_txt",
                    title: "Descrição",
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
                        value: _vm.registro.descricao_txt,
                        expression: "registro.descricao_txt"
                      }
                    ],
                    attrs: {
                      id: "foco",
                      rows: "6",
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
            2
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
                      _vm.registro.id_punicao
                        ? _c(
                            "a",
                            {
                              staticClass: "btn btn-success btn-block",
                              attrs: { disabled: _vm.requireds },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  return _vm.update(_vm.registro.id_punicao)
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
    require("vue-hot-reload-api")      .rerender("data-v-647267a6", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Punicao.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Punicao.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3ae1febc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Punicao.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Punicao.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Punicao.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647267a6\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Punicao.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Punicao.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-647267a6\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Punicao.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-647267a6"
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
Component.options.__file = "resources/assets/js/components/FDI/Punicao.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-647267a6", Component.options)
  } else {
    hotAPI.reload("data-v-647267a6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});