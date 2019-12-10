webpackJsonp([73],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue":
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
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        reference: { type: Number, default: null },
        ano: { type: Number, default: null },
        id_notacomparecimento: { type: Number, default: null }
    },
    data: function data() {
        return {
            module: 'apresentacao',
            registros: null,
            registro: {
                pessoa_rg: '',
                pessoa_nome: '',
                id_apresentacaonotificacao: '1',
                id_apresentacaosituacao: '1',
                id_apresentacaoclassificacaosigilo: '1',
                id_apresentacaotipoprocesso: '3',
                id_apresentacaocondicao: '1'
            },
            error: {},
            type: null,
            onSearch: false,
            templateLocal: '<span>{{item.localdeapresentacao}}.{{item.logradouro}}, {{item.numero}} - {{item.bairro}} - {{item.municipio}}/{{item.uf}}. Tel.: {{item.telefone}}. CEP: {{item.cep}}.</span>',
            templatePM: '<span>{{item.CARGO}} {{item.NOME}} - {{item.RG}} (OM: {{item.OPM_DESCRICAO}}).</span>'
        };
    },

    computed: {
        buscaLocal: function buscaLocal() {
            return this.$root.baseUrl + 'api/localapresentacao/';
        },
        buscaPM: function buscaPM() {
            return this.$root.baseUrl + 'api/dados/showsugest/' + this.type + '/';
        },
        requireds: function requireds() {
            if (this.registro.autos_numero && this.registro.comparecimento_data && this.registro.comparecimento_hora && this.registro.comparecimento_local_txt && this.registro.pessoa_rg && this.registro.pessoa_nome && this.registro.pessoa_posto && this.registro.pessoa_quadro && this.registro.id_apresentacaocondicao) return false;
            return true;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: AUTOS, DATA DO COMPARECIMENTO, HORA, DESCRI\xC7\xC3O DO LOCAL, E OS DADOS DO PM/BM deve estar preenchidos';
        },
        canEdit: function canEdit() {
            return this.$root.hasPermission('editar-apresentacao');
        },
        canDelete: function canDelete() {
            return this.$root.hasPermission('apagar-apresentacao');
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        }
    },
    created: function created() {
        this.list();
        if (this.reference) this.dadosApresentacao();else this.cleanRegister();
    },

    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/listnota/' + this.id_notacomparecimento;
            if (this.id_notacomparecimento) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        changeMode: function changeMode(type) {
            this.type = type;
            this.onSearch = true;
            return true;
        },
        limparDados: function limparDados() {
            var sn = confirm('Você tem certeza?');
            if (sn) {
                this.registro = null;
                this.registro = {};
            }
        },
        selectLocal: function selectLocal(item) {
            var localapresentacao = item.localdeapresentacao + '.' + item.logradouro + ', ' + item.numero + ' - ' + item.bairro + ' - ' + item.municipio + '/' + item.uf + '. Tel.: ' + item.telefone + '. CEP: ' + item.cep + '.';
            this.registro.comparecimento_local_txt = localapresentacao;
            this.registro.id_localdeapresentacao = item.id_localdeapresentacao;
            return localapresentacao;
        },
        selectPM: function selectPM(item) {
            this.onSearch = false;
            this.type = null;
            // dado PM
            this.registro.pessoa_rg = item.RG;
            this.registro.pessoa_nome = item.NOME;
            this.registro.pessoa_posto = item.CARGO;
            this.registro.pessoa_quadro = item.QUADRO;
            this.registro.pessoa_email = item.EMAIL_META4;
            this.registro.pessoa_opm_meta4 = item.META4;
            this.registro.pessoa_opm_sigla = item.ABREVIATURA;
            this.registro.pessoa_opm_descricao = item.OPM_DESCRICAO;
            // dados unidade
            this.registro.pessoa_unidade_lotacao_meta4 = item.META4;
            this.registro.pessoa_unidade_lotacao_codigo = item.CDOPM;
            this.registro.pessoa_unidade_lotacao_sigla = item.ABREVIATURA;
            this.registro.pessoa_unidade_lotacao_descricao = item.OPM_DESCRICAO;

            var cleanCdopm = item.CDOPM.substring(0, 3);
            this.registro.pessoa_opm_codigo = cleanCdopm;

            return this.type ? item.RG : item.NOME;
        },
        dadosApresentacao: function dadosApresentacao() {
            var _this2 = this;

            var refAno = this.ano ? this.reference + '/' + this.ano : this.reference;
            var urlData = this.$root.baseUrl + 'api/' + this.module + '/' + refAno;
            axios.get(urlData).then(function (response) {
                _this2.registro = response.data;
            }).catch(function (error) {
                return console.log(error);
            });
        },
        cleanRegister: function cleanRegister() {
            this.registro = {
                pessoa_rg: '',
                pessoa_nome: '',
                id_apresentacaonotificacao: '1',
                id_apresentacaosituacao: '1',
                id_apresentacaoclassificacaosigilo: '1',
                id_apresentacaotipoprocesso: '3',
                id_apresentacaocondicao: '1',
                id_notacomparecimento: this.id_notacomparecimento,
                cdopm: this.$root.dadoSession('cdopmbase'),
                usuario_rg: this.$root.dadoSession('rg'),
                autos_ano: new Date().getFullYear()
            };
        },
        additionalData: function additionalData() {
            var reg = this.registro;
            var cleanData = reg.comparecimento_data.split('/').reverse().join('-');
            this.registro.comparecimento_hora = this.registro.comparecimento_hora;
            this.registro.comparecimento_dh = cleanData + ' ' + reg.comparecimento_hora;
        },
        create: function create() {
            var _this3 = this;

            if (!this.requireds) {
                this.additionalData();
                var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
                axios.post(urlCreate, this.registro).then(function (response) {
                    _this3.transation(response.data.success, 'create');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        edit: function edit(registro) {
            this.registro = registro;
        },
        update: function update(id) {
            var _this4 = this;

            if (!this.requireds) {
                var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
                axios.put(urlUpdate, this.registro).then(function (response) {
                    _this4.transation(response.data.success, 'edit');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        destroy: function destroy(id) {
            var _this5 = this;

            if (confirm('Você tem certeza?')) {
                var urlDelete = this.$root.baseUrl + 'api/' + this.module + '/destroyApi/' + id;
                axios.delete(urlDelete).then(function (response) {
                    _this5.transation(response.data.success, 'delete');
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
                this.cleanRegister();
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

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-26106570\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue":
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
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "Autos Nº",
            error: _vm.error.autos_numero
          }
        },
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
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "Autos Ano",
            error: _vm.error.autos_ano
          }
        },
        [
          _c("v-ano", {
            model: {
              value: _vm.registro.autos_ano,
              callback: function($$v) {
                _vm.$set(_vm.registro, "autos_ano", $$v)
              },
              expression: "registro.autos_ano"
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
            lg: "2",
            md: "2",
            title: "Acusados",
            error: _vm.error.acusados
          }
        },
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
            lg: "2",
            md: "2",
            title: "Data do comparecimento",
            icon: "fa fa-calendar"
          }
        },
        [
          _c("v-datepicker", {
            attrs: { "clear-button": "" },
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
            lg: "2",
            md: "2",
            title: "Hora",
            error: _vm.error.comparecimento_hora
          }
        },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.comparecimento_hora,
                expression: "registro.comparecimento_hora"
              }
            ],
            staticClass: "form-control",
            attrs: { type: "time", placeholder: "00:00", required: "" },
            domProps: { value: _vm.registro.comparecimento_hora },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(
                  _vm.registro,
                  "comparecimento_hora",
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
            lg: "2",
            md: "2",
            title: "Observações",
            error: _vm.error.observacao_txt
          }
        },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.observacao_txt,
                expression: "registro.observacao_txt"
              }
            ],
            staticClass: "form-control",
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
      _c(
        "v-label",
        {
          attrs: {
            lg: "12",
            md: "12",
            title: "Descrição do local",
            error: _vm.error.comparecimento_local_txt
          }
        },
        [
          _c("v-typeahead", {
            attrs: {
              placeholder: "Busca local",
              async: _vm.buscaLocal,
              "on-hit": _vm.selectLocal,
              template: _vm.templateLocal
            },
            model: {
              value: _vm.registro.comparecimento_local_txt,
              callback: function($$v) {
                _vm.$set(_vm.registro, "comparecimento_local_txt", $$v)
              },
              expression: "registro.comparecimento_local_txt"
            }
          }),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.id_localdeapresentacao,
                expression: "registro.id_localdeapresentacao"
              }
            ],
            attrs: { type: "hidden" },
            domProps: { value: _vm.registro.id_localdeapresentacao },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(
                  _vm.registro,
                  "id_localdeapresentacao",
                  $event.target.value
                )
              }
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: { lg: "2", md: "2", title: "RG", error: _vm.error.pessoa_rg }
        },
        [
          _vm.onSearch && _vm.type == "rg"
            ? [
                _c("v-typeahead", {
                  attrs: {
                    placeholder: "Busca PM/BM ativos",
                    async: _vm.buscaPM,
                    "on-hit": _vm.selectPM,
                    template: _vm.templatePM,
                    "match-start": ""
                  },
                  model: {
                    value: _vm.registro.pessoa_rg,
                    callback: function($$v) {
                      _vm.$set(_vm.registro, "pessoa_rg", $$v)
                    },
                    expression: "registro.pessoa_rg"
                  }
                })
              ]
            : [
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
                  attrs: { type: "text", placeholder: "Busca PM/BM ativos" },
                  domProps: { value: _vm.registro.pessoa_rg },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.changeMode("rg")
                    },
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "pessoa_rg", $event.target.value)
                    }
                  }
                })
              ]
        ],
        2
      ),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "Nome",
            error: _vm.error.pessoa_nome
          }
        },
        [
          _vm.onSearch && _vm.type == "nome"
            ? [
                _c("v-typeahead", {
                  attrs: {
                    placeholder: "Busca PM/BM ativos",
                    async: _vm.buscaPM,
                    "on-hit": _vm.selectPM,
                    template: _vm.templatePM,
                    "match-start": ""
                  },
                  model: {
                    value: _vm.registro.pessoa_nome,
                    callback: function($$v) {
                      _vm.$set(_vm.registro, "pessoa_nome", $$v)
                    },
                    expression: "registro.pessoa_nome"
                  }
                })
              ]
            : [
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
                  attrs: { type: "text", placeholder: "Busca PM/BM ativos" },
                  domProps: { value: _vm.registro.pessoa_nome },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.changeMode("nome")
                    },
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "pessoa_nome", $event.target.value)
                    }
                  }
                })
              ]
        ],
        2
      ),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "Posto/Grad",
            error: _vm.error.pessoa_posto
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
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "Quadro",
            error: _vm.error.pessoa_quadro
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
        {
          attrs: {
            lg: "2",
            md: "2",
            title: "OPM",
            error: _vm.error.pessoa_opm_codigo
          }
        },
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
      _c("div", { staticClass: "col-xs-12" }, [
        _c(
          "div",
          { staticClass: "col-md-8 col-xs-12" },
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
        _c("div", { staticClass: "col-md-4 col-xs-12" }, [
          _c(
            "a",
            {
              staticClass: "btn btn-danger btn-block",
              on: { click: _vm.limparDados }
            },
            [_vm._v("Limpar todos dados")]
          )
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-xs-12" }, [
        _c(
          "table",
          { staticClass: "table table-striped" },
          [
            _vm.lenght
              ? [
                  _vm._m(0),
                  _vm._v(" "),
                  _c(
                    "tbody",
                    _vm._l(_vm.registros, function(registro, index) {
                      return _c("tr", { key: index }, [
                        _c("td", [_vm._v(_vm._s(registro.autos_numero))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(registro.autos_ano))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(registro.acusados))]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(_vm._s(registro.comparecimento_data))
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(_vm._s(registro.comparecimento_hora))
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(_vm._s(registro.comparecimento_local_txt))
                        ]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(registro.pessoa_rg))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(registro.pessoa_nome))]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(registro.pessoa_quadro))]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(_vm._s(registro.pessoa_unidade_lotacao_sigla))
                        ]),
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
                                              registro.id_apresentacao
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
              : [_vm._m(1)]
          ],
          2
        )
      ])
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("N° Autos")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("Autos ano")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("Acusados")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [
          _c("b", [_vm._v("Data comparecimento")])
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("Hora")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("Local")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("RG")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("Nome")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [
          _c("b", [_vm._v("Posto/grad.")])
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-1" }, [_c("b", [_vm._v("OPM")])]),
        _vm._v(" "),
        _c("th", { staticClass: "col-xs-2" }, [_c("b", [_vm._v("Ações")])])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [_c("td", [_vm._v("Não há registros")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-26106570", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("cc99cc2a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FormNotaCoger.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FormNotaCoger.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/FormNotaCoger.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-26106570\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-26106570\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/FormNotaCoger.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-26106570"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/FormNotaCoger.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-26106570", Component.options)
  } else {
    hotAPI.reload("data-v-26106570", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});