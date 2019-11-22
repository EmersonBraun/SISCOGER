webpackJsonp([72],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        idp: {
            type: Number,
            default: null
        }
    },
    data: function data() {
        return {
            module: 'apresentacao',
            registro: {},
            opm_intermediaria: null,
            date: {},
            pm: null,
            autoridades: [],
            autoridade: {},
            id_cadastroopmcoger: 0,
            vias: 2,
            check: null
        };
    },
    created: function created() {
        this.list();
    },

    watch: {
        registro: function registro() {
            this.getPm();
            this.getAutoridade();
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/memorando/' + this.idp;
            if (this.idp) {
                axios.get(urlIndex).then(function (response) {
                    _this.registro = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        getPm: function getPm() {
            var _this2 = this;

            var searchUrl = this.$root.baseUrl + 'api/dados/pm/' + this.registro.pessoa_rg;
            axios.get(searchUrl).then(function (response) {
                _this2.pm = response.data.pm;
                _this2.registro.pm = response.data.pm;
            }).catch(function (error) {
                return console.log(error);
            });
        },
        getAutoridade: function getAutoridade() {
            var _this3 = this;

            var opm = this.$root.dadoSession('cdopmbase');
            var urlIndex = this.$root.baseUrl + 'api/cadastroopm/get/' + opm;

            axios.get(urlIndex).then(function (response) {
                var res = response.data[0];

                _this3.id_cadastroopmcoger = res.id_cadastroopmcoger;
                _this3.getOtherAutoridade(res.id_cadastroopmcoger);

                _this3.autoridades.push({
                    nome: res.opm_autoridade_nome,
                    funcao: res.opm_autoridade_funcao
                });
            }).catch(function (error) {
                return console.log(error);
            });
        },
        getOtherAutoridade: function getOtherAutoridade(id) {
            var _this4 = this;

            var urlIndex = this.$root.baseUrl + 'api/cadastroopmautoridade/list/' + id;
            axios.get(urlIndex).then(function (response) {
                var res = response.data[0];
                res.forEach(function (e) {
                    _this4.autoridades.push({
                        nome: e.nome,
                        funcao: e.funcao
                    });
                });
            }).catch(function (error) {
                return console.log(error);
            });
        },
        changeAutoridade: function changeAutoridade(autoridade) {
            this.autoridade = autoridade;
            this.registro.autoridade = autoridade;
        },
        print: function print() {
            var nome = this.autoridade.nome.replace(/\s/g, "-");
            var funcao = this.autoridade.funcao.replace(/\s/g, "-");
            var urlPrint = this.$root.baseUrl + 'api/apresentacao/memorandogerar/' + this.idp + '/' + nome + '/' + funcao;
            console.log('url', urlPrint);
            window.open(urlPrint);
            console.log('print');
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n@media print {\n#printpage[data-v-23911582] {\n        background-color: white;\n        height: 100%;\n        width: 100%;\n        position: fixed;\n        top: 0;\n        left: 0;\n        margin: 0;\n}\n}\n.body[data-v-23911582] {\n        font-family: Arial, Helvetica, sans-serif;\n        font-size: 12px;\n        line-height: 1 !important;\n        background-color: #f1f1f1;\n}\np[data-v-23911582] {\n        text-indent: 50px;\n        text-align: justify;\n}\n.a4[data-v-23911582] {\n        display: flex;\n        flex-direction: column;\n        width: 595px;\n        height: 841px;\n        padding: 20px;\n        border: 1px solid black;\n        page-break-before: always;\n}\n.header[data-v-23911582] {\n        margin: 82.8px 57px 10px 85px;\n        text-align: center;\n        padding-bottom: 10px;\n        border-bottom: 1px solid black;\n}\n.text-bold-g[data-v-23911582]{\n        font-size:14px;\n        font-weight:bold;\n        font-style:normal;\n        text-decoration: none;\n}\n.text-bold-m[data-v-23911582]{\n        font-size:12px;\n        font-weight:bold;\n        font-style:normal;\n        text-decoration: none;\n}\n.text-bold-s[data-v-23911582]{\n        font-size:8px;\n        font-weight:bold;\n        font-style:normal;\n        text-decoration: none;\n}\n.content-mem[data-v-23911582] {\n        margin: 10px 57px 10px 85px !important;\n        padding: 0 !important;\n}\n.ass[data-v-23911582] {\n        margin-top: 50px;\n        text-align: center;\n}\n.cert[data-v-23911582] {\n        display: flex;\n        align-items: flex-end !important;\n        margin: auto 57px 25px 85px; \n        font-size:8px;\n}\n.border-l[data-v-23911582] {\n        border-left: 1px solid black;\n}\n.border[data-v-23911582] {\n        border: 1px solid black;\n}\n.center[data-v-23911582] {\n        text-align: center;\n}\n.table-mem[data-v-23911582]  {\n        width: 100%;\n        height: 90px;\n        text-align: left;\n        text-indent: 5px;\n        padding: 0 10px 0 10px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-23911582\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "body" }, [
    _c(
      "div",
      { staticClass: "col-xs-12" },
      [
        _c(
          "v-label",
          { attrs: { lg: "6", md: "6", title: "Número memorando" } },
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
              attrs: { type: "text" },
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
        _c("v-label", { attrs: { lg: "6", md: "6", title: "Sigla Seção" } }, [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.sigla,
                expression: "registro.sigla"
              }
            ],
            staticClass: "form-control",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.sigla },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "sigla", $event.target.value)
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "v-label",
          { attrs: { label: "check", title: "Fecho: ", md: "12", lg: "12" } },
          _vm._l(_vm.autoridades, function(autoridade, index) {
            return _c("div", { key: index }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.check,
                    expression: "check"
                  }
                ],
                attrs: { type: "radio" },
                domProps: { value: index, checked: _vm._q(_vm.check, index) },
                on: {
                  click: function($event) {
                    return _vm.changeAutoridade(autoridade)
                  },
                  change: function($event) {
                    _vm.check = index
                  }
                }
              }),
              _vm._v(" " + _vm._s(autoridade.nome) + " "),
              _c("b", [_vm._v(" " + _vm._s(autoridade.funcao) + " ")])
            ])
          }),
          0
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-xs-12" },
          [
            _c(
              "v-tooltip",
              {
                attrs: {
                  effect: "scale",
                  placement: "top",
                  content: "Deve selecionar o Fecho"
                }
              },
              [
                _vm.registro.id_apresentacao
                  ? _c(
                      "a",
                      {
                        staticClass: "btn btn-success btn-block",
                        attrs: { disabled: _vm.autoridade.nome == null },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            return _vm.print()
                          }
                        }
                      },
                      [_vm._v("Imprimir")]
                    )
                  : _vm._e()
              ]
            )
          ],
          1
        )
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "section",
      { attrs: { id: "printpage" } },
      _vm._l(_vm.vias, function(via, index) {
        return _c("div", { key: index, staticClass: "a4 col-xs-6" }, [
          _c("div", { staticClass: "header" }, [
            _c("div", { staticClass: "text-bold-g" }, [
              _vm._v("ESTADO DO PARANÁ")
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "text-bold-g" }, [
              _vm._v("POLÍCIA MILITAR")
            ]),
            _vm._v(" "),
            _vm.opm_intermediaria
              ? _c("div", { staticClass: "text-bold-m" }, [
                  _vm._v(_vm._s(_vm.opm_intermediaria))
                ])
              : _vm._e(),
            _vm._v(" "),
            _c("div", { staticClass: "text-bold-m" }, [
              _vm._v(_vm._s(_vm.registro.pessoa_unidade_lotacao_descricao))
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "content-mem" }, [
            _c("div", { staticClass: "col-xs-6 text-bold-m nopadding" }, [
              _vm._v(
                "Memorando nº " +
                  _vm._s(_vm.registro.sjd_ref) +
                  "/" +
                  _vm._s(_vm.registro.sigla)
              )
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-6 text-bold-m text-right nopadding" },
              [
                _vm._v(
                  "Em " +
                    _vm._s(_vm.registro.data_ico.dia) +
                    " de " +
                    _vm._s(_vm.registro.data_ico.mes_abr) +
                    " de " +
                    _vm._s(_vm.registro.data_ico.ano) +
                    "."
                )
              ]
            ),
            _vm._v(" "),
            _vm.pm
              ? _c(
                  "div",
                  {
                    staticClass: "col-xs-12 text-bold-m nopadding",
                    staticStyle: { "padding-top": "10px !important" }
                  },
                  [
                    _vm._v(
                      "Ao " +
                        _vm._s(_vm.pm.cargo_ico) +
                        " " +
                        _vm._s(_vm.pm.quadro_ico) +
                        " " +
                        _vm._s(_vm.pm.nome_ico)
                    )
                  ]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm._m(0, true),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "col-xs-12 nopadding",
                staticStyle: { "padding-bottom": "25px !important" }
              },
              [
                _c("span", { staticClass: "text-bold-m" }, [
                  _vm._v("Referência:")
                ]),
                _vm._v("  " + _vm._s(_vm.registro.documento_de_origem) + ".")
              ]
            ),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                "\n                    Com fundamento no artigo 288,§ 3º do CPPM, \n                    determino o comparecimento de "
              ),
              _vm.pm
                ? _c("span", [_vm._v(_vm._s(_vm.pm.tratamento_ico))])
                : _vm._e(),
              _vm._v(
                " em data de \n                    " +
                  _vm._s(_vm.registro.comparecimento_data_ico.dia) +
                  " \n                    " +
                  _vm._s(_vm.registro.comparecimento_data_ico.mes) +
                  ". \n                    " +
                  _vm._s(_vm.registro.comparecimento_data_ico.ano_abr) +
                  ", \n                    às " +
                  _vm._s(_vm.registro.comparecimento_hora_ico) +
                  ", \n                    no(a) " +
                  _vm._s(_vm.registro.comparecimento_local_txt) +
                  ", a fim de prestar depoimento em autos n°\n                    " +
                  _vm._s(_vm.registro.autos_numero) +
                  " na condição de " +
                  _vm._s(_vm.registro.condicao) +
                  ".\n                "
              )
            ]),
            _vm._v(" "),
            _vm.registro.acusados
              ? _c("div", [
                  _vm._v("Acusado(s): " + _vm._s(_vm.registro.acusados))
                ])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "ass" }, [
            _vm.autoridade
              ? _c("div", [_vm._v(_vm._s(_vm.autoridade.nome) + ",")])
              : _vm._e(),
            _vm._v(" "),
            _c("div", { staticClass: "text-bold-m" }, [
              _vm._v(_vm._s(_vm.autoridade.funcao))
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row cert" }, [
            _c("div", { staticClass: "col-xs-6" }, [
              _c("table", { staticClass: "table-mem border" }, [
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticClass: "border text-bold-s center",
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._v(
                        "USO DO SJD (" +
                          _vm._s(_vm.registro.cod_notificacao.base) +
                          "/" +
                          _vm._s(_vm.registro.data_ico.ano) +
                          ")"
                      )
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Notificado:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.notificado))
                  ])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Não notificado:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.naonotificado))
                  ])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Compareceu/Realizada:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.realizada))
                  ])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Compareceu/Cancelada:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.cancelada))
                  ])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Compareceu/Redesignada:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.redesignada))
                  ])
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("td", { staticClass: "border text-bold-s" }, [
                    _vm._v("Não compareceu:")
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "border-l" }, [
                    _vm._v(_vm._s(_vm.registro.cod_notificacao.naocompareceu))
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-6" },
              [via == 2 ? [_vm._m(1, true)] : [_vm._m(2, true)]],
              2
            )
          ])
        ])
      }),
      0
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "col-xs-12 nopadding",
        staticStyle: { "padding-bottom": "10px !important" }
      },
      [
        _c("span", { staticClass: "text-bold-m" }, [_vm._v("Assunto:")]),
        _vm._v("  Determinação para comparecimento.")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("table", { staticClass: "table-mem border" }, [
      _c("tr", [
        _c(
          "td",
          {
            staticClass: "border text-bold-m",
            staticStyle: { "text-align": "justify" },
            attrs: { colspan: "2" }
          },
          [
            _vm._v(
              "\n                                    ** Esta via deve ser carimbada no local da audiência e ser entregue no SJD após a apresentação do Militar Estadual\n                                "
            )
          ]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("table", { staticClass: "table-mem border" }, [
      _c("tr", [
        _c(
          "td",
          {
            staticClass: "border text-bold-s center",
            staticStyle: { height: "12px" },
            attrs: { colspan: "2" }
          },
          [_vm._v("CIENTE")]
        )
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Data:")]),
          _vm._v("  ______/______/__________")
        ])
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Horário:")]),
          _vm._v("  ______:______")
        ])
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Ass.:")])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-23911582", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("075bf6e3", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Memorando.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Memorando.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-23911582\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-23911582"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/Memorando.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-23911582", Component.options)
  } else {
    hotAPI.reload("data-v-23911582", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});