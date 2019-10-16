webpackJsonp([84],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Form.vue":
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
            registro: {},
            error: {},
            customTemplate: '<span>{{item.localdeapresentacao}} {{item.municipio}} - {{item.logradouro | }}</span>'
        };
    },

    computed: {
        buscaLocal: function buscaLocal() {
            return this.$root.baseUrl + 'api/localapresentacao/';
        },
        requireds: function requireds() {
            if (this.registro.comparecimento_data && this.registro.motivo && this.registro.motivo_txt) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: COMPORTAMENTO, MOTIVO e DESCRI\xC7\xC3O deve estar preenchidos';
        }
    },
    methods: {
        limparDados: function limparDados() {},
        selectLocal: function selectLocal() {},
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.rg = this.pm.RG;
            this.registro.cargo = this.pm.CARGO;
            this.registro.nome = this.pm.NOME;
            this.registro.rg_cadastro = this.$root.dadoSession('rg');
            this.registro.cdopm = this.$root.dadoSession('cdopm');
            this.registro.opm_abreviatura = this.$root.dadoSession('opm_abreviatura');
            this.registro.digitador = this.$root.dadoSession('nome');
        },
        create: function create() {
            var _this = this;

            if (!this.requireds) {

                var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
                axios.post(urlCreate, this.registro).then(function (response) {
                    _this.transation(response.data.success, 'create');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        edit: function edit(registro) {
            this.registro = registro;
            this.toCreate();
        },
        update: function update(id) {
            var _this2 = this;

            if (!this.requireds) {
                var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
                axios.put(urlUpdate, this.registro).then(function (response) {
                    _this2.transation(response.data.success, 'edit');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        destroy: function destroy(id) {
            var _this3 = this;

            if (confirm('Você tem certeza?')) {
                var urlDelete = this.$root.baseUrl + 'api/' + this.module + '/destroy/' + id;
                axios.delete(urlDelete).then(function (response) {
                    _this3.transation(response.data.success, 'delete');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        transation: function transation(happen, type) {
            var msg = this.words(type);
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

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0d66c622\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "v-label",
        { attrs: { label: "cdopm", title: "OPM" } },
        [
          _c("v-opm", {
            attrs: { name: "cdopm", cdopm: _vm.registro.cdopm },
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
      _c("v-label", { attrs: { title: "Notificação" } }, [
        _c(
          "select",
          {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.id_apresentacaonotificacao,
                expression: "registro.id_apresentacaonotificacao"
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
                  "id_apresentacaonotificacao",
                  $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                )
              }
            }
          },
          [
            _c("option", { attrs: { value: "1" } }, [_vm._v("Pendente")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "2" } }, [_vm._v("Notificado")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "3" } }, [_vm._v("Não notificado")])
          ]
        )
      ]),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: { title: "Situação", error: _vm.error.id_apresentacaosituacao }
        },
        [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.registro.id_apresentacaosituacao,
                  expression: "registro.id_apresentacaosituacao"
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
                    "id_apresentacaosituacao",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "1" } }, [_vm._v("Prevista")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2" } }, [
                _vm._v("Compareceu/Realizada")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "3" } }, [
                _vm._v("Compareceu/Cancelada")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [
                _vm._v("Compareceu/Redesignada")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [
                _vm._v("Não compareceu")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "6" } }, [
                _vm._v("Não compareceu/Justificado")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "7" } }, [_vm._v("Redesignada")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "8" } }, [
                _vm._v("Substituído (Cons. VAJME)")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "9" } }, [
                _vm._v("Ag. Publicação")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "10" } }, [_vm._v("Apagada")])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: {
            title: "Classificação de sigilo",
            error: _vm.error.id_apresentacaoclassificacaosigilo
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
                  value: _vm.registro.id_apresentacaoclassificacaosigilo,
                  expression: "registro.id_apresentacaoclassificacaosigilo"
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
                    "id_apresentacaoclassificacaosigilo",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "1" } }, [_vm._v("Publico")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2" } }, [
                _vm._v("Usuário Siscoger")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "3" } }, [
                _vm._v("Reservado - SDJ/Pares/Superiores")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [
                _vm._v("Reservado - Somente o próprio")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [
                _vm._v("Reservado - SJD/Próprio")
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.registro.id_apresentacao
        ? _c("file-upload", {
            attrs: {
              title: "Documento de Origem:",
              name: "documento_de_origem",
              proc: "apresentacao",
              idp: _vm.registro.id_apresentacao,
              ext: ["pdf"]
            }
          })
        : _vm._e(),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: {
            title: "Processo/Procedimento",
            error: _vm.error.id_apresentacaotipoprocesso
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
                  value: _vm.registro.id_apresentacaotipoprocesso,
                  expression: "registro.id_apresentacaotipoprocesso"
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
                    "id_apresentacaotipoprocesso",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "1" } }, [_vm._v("Ação Penal")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2" } }, [_vm._v("Ação Civil")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "3" } }, [
                _vm._v("Não informado")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [
                _vm._v("Não se aplica")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [_vm._v("PM-IPM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "6" } }, [
                _vm._v("PM-Sindicância")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "7" } }, [_vm._v("PM-FATD")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "8" } }, [
                _vm._v("PM-Inquérito Técnico")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "9" } }, [_vm._v("PM-CJ")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "10" } }, [_vm._v("PM-CD")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "11" } }, [_vm._v("PM-ADL")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "12" } }, [_vm._v("PM-ISO")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "13" } }, [_vm._v("PM-PAD")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "14" } }, [_vm._v("PM-Outro ")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "15" } }, [
                _vm._v("Poder Judiciário ")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "16" } }, [
                _vm._v("Inquérito Policial")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "17" } }, [_vm._v("VAJME")])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Autos Nº", error: _vm.error.autos_numero } },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.autos_numero,
                expression: "registro.autos_numero"
              }
            ],
            staticClass: "form-control ",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.autos_numero },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "autos_numero", $event.target.value)
              }
            }
          })
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Acusados", error: _vm.error.acusados } },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.acusados,
                expression: "registro.acusados"
              }
            ],
            staticClass: "form-control ",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.acusados },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "acusados", $event.target.value)
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
            title: "Descrição do local",
            error: _vm.error.comparecimento_local_txt
          }
        },
        [
          _c("v-typeahead", {
            attrs: {
              placeholder: "Busca local",
              "async-key": "items",
              src: _vm.buscaLocal,
              template: _vm.customTemplate,
              "on-hit": _vm.selectLocal
            },
            model: {
              value: _vm.registro.comparecimento_local_txt,
              callback: function($$v) {
                _vm.$set(_vm.registro, "comparecimento_local_txt", $$v)
              },
              expression: "registro.comparecimento_local_txt"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Data do comparecimento", icon: "fa fa-calendar" } },
        [
          _c("v-datepicker", {
            attrs: { placeholder: "dd/mm/aaaa", "clear-button": "" },
            model: {
              value: _vm.registro.comparecimento_data,
              callback: function($$v) {
                _vm.$set(_vm.registro, "comparecimento_data", $$v)
              },
              expression: "registro.comparecimento_data"
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
            lg: "12",
            md: "12",
            title: "Observações",
            error: _vm.error.observacao_txt
          }
        },
        [
          _c("textarea", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.observacao_txt,
                expression: "registro.observacao_txt"
              }
            ],
            staticStyle: { width: "100%" },
            attrs: { rows: "3", cols: "80" },
            domProps: { value: _vm.registro.observacao_txt },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "observacao_txt", $event.target.value)
              }
            }
          })
        ]
      ),
      _vm._v(" "),
      _c("v-label", { attrs: { title: "RG", error: _vm.error.pessoa_rg } }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.registro.pessoa_rg,
              expression: "registro.pessoa_rg"
            }
          ],
          staticClass: "form-control ",
          attrs: { type: "text" },
          domProps: { value: _vm.registro.pessoa_rg },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.registro, "pessoa_rg", $event.target.value)
            }
          }
        })
      ]),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Nome", error: _vm.error.pessoa_nome } },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.pessoa_nome,
                expression: "registro.pessoa_nome"
              }
            ],
            staticClass: "form-control ",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.pessoa_nome },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "pessoa_nome", $event.target.value)
              }
            }
          })
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Posto/Grad", error: _vm.error.pessoa_posto } },
        [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.registro.pessoa_posto,
                  expression: "registro.pessoa_posto"
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
                    "pessoa_posto",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "CELAGREG" } }, [
                _vm._v("CELAGREG")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "CEL" } }, [_vm._v("CEL")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "TENCEL" } }, [_vm._v("TENCEL")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "MAJ" } }, [_vm._v("MAJ")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "CAP" } }, [_vm._v("CAP")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "1TEN" } }, [_vm._v("1TEN")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2TEN" } }, [_vm._v("2TEN")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "ASPOF" } }, [_vm._v("ASPOF")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "ALUNO" } }, [_vm._v("ALUNO")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "ALUNO3A" } }, [
                _vm._v("ALUNO3A")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "ALUNO2A" } }, [
                _vm._v("ALUNO2A")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "ALUNO1A" } }, [
                _vm._v("ALUNO1A")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "SUBTEN" } }, [_vm._v("SUBTEN")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "1SGT" } }, [_vm._v("1SGT")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2SGT" } }, [_vm._v("2SGT")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "3SGT" } }, [_vm._v("3SGT")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "CABO" } }, [_vm._v("CABO")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "SD1C" } }, [_vm._v("SD1C")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "SD2C" } }, [_vm._v("SD2C")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "null" } }, [
                _vm._v("Nâo encontrado")
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "Quadro", error: _vm.error.pessoa_quadro } },
        [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.registro.pessoa_quadro,
                  expression: "registro.pessoa_quadro"
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
                    "pessoa_quadro",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "QPMG1" } }, [_vm._v("QPMG1")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "QPMG2" } }, [_vm._v("QPMG2")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "QOPM" } }, [_vm._v("QOPM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "QOBM" } }, [_vm._v("QOBM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "QEOPM" } }, [_vm._v("QEOPM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "QOS" } }, [_vm._v("QOS")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "PM" } }, [_vm._v("PM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "BM" } }, [_vm._v("BM")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "null" } }, [
                _vm._v("Nâo encontrado")
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { title: "OPM", error: _vm.error.pessoa_opm_codigo } },
        [
          _c("v-opm", {
            attrs: { cdopm: _vm.registro.pessoa_opm_codigo },
            model: {
              value: _vm.registro.pessoa_opm_codigo,
              callback: function($$v) {
                _vm.$set(_vm.registro, "pessoa_opm_codigo", $$v)
              },
              expression: "registro.pessoa_opm_codigo"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: { title: "Condição", error: _vm.error.id_apresentacaocondicao }
        },
        [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.registro.id_apresentacaocondicao,
                  expression: "registro.id_apresentacaocondicao"
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
                    "id_apresentacaocondicao",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "1" } }, [_vm._v("Testemunha")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "2" } }, [
                _vm._v("Juiz Militar - Conselho Permanente")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "3" } }, [
                _vm._v("Juiz Militar - Conselho Especial")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [_vm._v("Réu")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [
                _vm._v("Testemunha de Defesa")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "6" } }, [
                _vm._v("Testemunha da Denúncia")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "7" } }, [
                _vm._v("Testemunha de Acusação")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "8" } }, [
                _vm._v("Testemunha do Juízo")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "9" } }, [_vm._v("Outro")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "10" } }, [
                _vm._v("Não informado")
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-xs-12" }, [
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
                _vm.registro.id_apresentacao
                  ? _c(
                      "a",
                      {
                        staticClass: "btn btn-success btn-block",
                        attrs: { disabled: _vm.requireds },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            return _vm.update(_vm.registro.id_apresentacao)
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
        ),
        _vm._v(" "),
        _c("div", { staticClass: "col-xs-6" }, [
          _c(
            "a",
            {
              staticClass: "btn btn-danger btn-block",
              on: { click: _vm.limparDados }
            },
            [_vm._v("Limpar todos dados")]
          )
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0d66c622", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Form.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7e3f0c87", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Form.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Form.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d66c622\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Form.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Form.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0d66c622\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Form.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0d66c622"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/Form.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0d66c622", Component.options)
  } else {
    hotAPI.reload("data-v-0d66c622", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});