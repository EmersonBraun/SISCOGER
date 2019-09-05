webpackJsonp([56],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Principal.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        pm: { type: Object }
    },
    data: function data() {
        return {
            adc: '',
            comportamento: '',
            preso: '',
            suspenso: '',
            excluido: '',
            subJudice: ''
        };
    },
    mounted: function mounted() {
        // this.listDadosGerais()
        this.listDadosAdicionais();
        this.listComportamento();
        this.estaPreso();
        this.estaSuspenso();
        this.estaExcluido();
        this.estaSubJudice();
    },

    computed: {
        foto: function foto() {
            return 'http://10.47.1.8/sispics/fotos/' + this.pm.RG + '.JPG';
        }
    },
    methods: {
        // listDadosGerais(){
        //     let urlIndex = `${this.$root.baseUrl}api/fdi/dadosGerais/${this.pm.RG}`;
        //     if(this.pm.RG){
        //         axios
        //         .get(urlIndex)
        //         .then((response) => {
        //             this.pm = response.data
        //         })
        //         .catch(error => console.log(error));
        //     }
        // },
        listDadosAdicionais: function listDadosAdicionais() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/dadosAdicionais/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this.adc = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        listComportamento: function listComportamento() {
            var _this2 = this;

            var urlIndex = this.$root.baseUrl + 'api/comportamento/atual/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this2.comportamento = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaPreso: function estaPreso() {
            var _this3 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/preso/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this3.preso = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaSuspenso: function estaSuspenso() {
            var _this4 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/suspenso/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this4.suspenso = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaExcluido: function estaExcluido() {
            var _this5 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/excluido/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this5.excluido = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        estaSubJudice: function estaSubJudice() {
            var _this6 = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/subJudice/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this6.subJudice = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.border[data-v-bcb8767a] {\n    border: 1px solid #dee2e6 !important;\n    border-top-color: rgb(222, 226, 250);\n    border-right-color: rgb(222, 226, 250);\n    border-bottom-color: rgb(222, 226, 250);\n    border-left-color: rgb(222, 226, 250);\n    min-height: 60px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-bcb8767a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "box" }, [
    _c("div", { staticClass: "box-header" }, [
      _c("h2", { staticClass: "box-title" }, [_vm._v("Dados Principais")]),
      _vm._v(" "),
      _c("div", { staticClass: "box-tools pull-right" }, [
        _vm.pm.STATUS == "Ativo"
          ? _c("i", { staticClass: "fa fa-circle text-success" })
          : _vm._e(),
        _vm._v(" "),
        _vm.pm.STATUS == "Inativo"
          ? _c("i", { staticClass: "fa fa-circle text-warning" })
          : _vm._e(),
        _vm._v(" "),
        _vm.pm.STATUS == "Reserva"
          ? _c("i", { staticClass: "fa fa-circle text-info" })
          : _vm._e(),
        _vm._v(" "),
        _c("strong", [_vm._v(_vm._s(_vm.pm.STATUS))]),
        _vm._v(" "),
        _vm.preso
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Preso")])
          : _vm._e(),
        _vm._v(" "),
        _vm.suspenso
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Suspenso")])
          : _vm._e(),
        _vm._v(" "),
        _vm.excluido
          ? _c("strong", { staticClass: "text-danger" }, [_vm._v("| Excluido")])
          : _vm._e(),
        _vm._v(" "),
        _vm.subJudice
          ? _c("strong", { staticClass: "text-danger" }, [
              _vm._v("| Sub Judice")
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm._m(0)
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "box-body" }, [
      _c(
        "div",
        { staticClass: "row" },
        [
          _c("div", { staticClass: "col-md-2 " }, [
            _c("a", { attrs: { href: _vm.foto } }, [
              _c("img", {
                staticClass: "img-responsive",
                attrs: { src: _vm.foto }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(1),
            _vm._v(" "),
            _c(
              "p",
              [
                _vm._v(_vm._s(_vm.pm.CARGO) + " " + _vm._s(_vm.pm.QUADRO)),
                _vm.pm.SUBQUADRO !== "NA"
                  ? [_vm._v("-" + _vm._s(_vm.pm.SUBQUADRO))]
                  : _vm._e(),
                _vm._v(" " + _vm._s(_vm.pm.NOME) + " ")
              ],
              2
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.RG))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(3),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.comportamento))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _c(
              "p",
              [
                _vm.pm.STATUS == "Ativo"
                  ? [_c("b", [_vm._v("Data de inclusão:")])]
                  : _vm._e(),
                _vm._v(" "),
                _vm.pm.STATUS == "Inativo"
                  ? [_c("b", [_vm._v("Data Inatividade:")])]
                  : _vm._e(),
                _vm._v(" "),
                _vm.pm.STATUS == "Reserva"
                  ? [_c("b", [_vm._v("Data Reserva:")])]
                  : _vm._e()
              ],
              2
            ),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(_vm._f("date_br")(_vm.pm.ADMISSAO_REAL)) +
                  " (" +
                  _vm._s(
                    _vm._f("tempo_em_anos_e_meses")(
                      _vm._f("date_bd")(_vm.pm.ADMISSAO_REAL)
                    )
                  ) +
                  ")"
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(4),
            _vm._v(" "),
            _c(
              "p",
              [
                _vm._v(_vm._s(_vm.pm.CIDADE) + " "),
                _vm.pm.STATUS == "Inativo"
                  ? [_vm._v("- " + _vm._s(_vm.pm.END_BAIRRO))]
                  : _vm._e()
              ],
              2
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(5),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(_vm._f("date_br")(_vm.pm.NASCIMENTO)) +
                  " (" +
                  _vm._s(_vm.pm.IDADE) +
                  " Anos)"
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(6),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.OPM_DESCRICAO))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(7),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.pm.EMAIL_META4))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(8),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.adc.CPF || "Não encontrado"))])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(9),
            _vm._v(" "),
            _vm.adc.SBR_NUM_TIT
              ? _c("p", [
                  _vm._v(
                    _vm._s(_vm.adc.SBR_NUM_TIT) +
                      "  Zona: " +
                      _vm._s(_vm.adc.SBR_ZONA) +
                      " Seção: " +
                      _vm._s(_vm.adc.SBR_SECAO)
                  )
                ])
              : _c("p", [_vm._v("Não encontrado")])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(10),
            _vm._v(" "),
            _c("p", [
              _vm._v(_vm._s(_vm.adc.CBR_NAME_FATHER || "Não encontrado"))
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-5 border" }, [
            _vm._m(11),
            _vm._v(" "),
            _c("p", [
              _vm._v(_vm._s(_vm.adc.CBR_NAME_MATHER || "Não encontrado"))
            ])
          ]),
          _vm._v(" "),
          _vm.pm.STATUS == "Inativo"
            ? [
                _c("div", { staticClass: "col-md-6 border" }, [
                  _vm._m(12),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      _vm._s(_vm.pm.END_RUA) +
                        ", n° " +
                        _vm._s(_vm.pm.END_NUM) +
                        " (" +
                        _vm._s(_vm.pm.END_COMPL) +
                        ") CEP: " +
                        _vm._s(_vm.pm.END_CEP)
                    )
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6 border" }, [
                  _vm._m(13),
                  _vm._v(" "),
                  _c("p", [_vm._v(_vm._s(_vm.pm.FONE))])
                ])
              ]
            : _vm._e()
        ],
        2
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "btn btn-box-tool",
        attrs: { type: "button", "data-widget": "collapse" }
      },
      [_c("i", { staticClass: "fa fa-minus" })]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome:")]), _c("br")])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("RG:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Comportamento atual:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Cidade:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Data de nascimento:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Classificacao Meta4:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Email funcional:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("CPF:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Título de eleitor:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome do pai:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome da mãe:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Endereço:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Telefone:")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-bcb8767a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3079fb8d", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Principal.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Principal.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Principal.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bcb8767a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Principal.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Principal.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-bcb8767a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Principal.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-bcb8767a"
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
Component.options.__file = "resources/assets/js/components/FDI/Principal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-bcb8767a", Component.options)
  } else {
    hotAPI.reload("data-v-bcb8767a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});