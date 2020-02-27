webpackJsonp([42],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['idp'],
    data: function data() {
        return {
            error: {},
            registro: {}
        };
    },
    created: function created() {
        console.log('criado');
    },

    methods: {
        create: function create() {},
        update: function update(id) {}
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-31228446\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("v-prioritario", {
        model: {
          value: _vm.registro.prioridade,
          callback: function($$v) {
            _vm.$set(_vm.registro, "prioridade", $$v)
          },
          expression: "registro.prioridade"
        }
      }),
      _vm._v(" "),
      _c(
        "v-label",
        {
          attrs: {
            label: "id_andamento",
            title: "Andamento",
            error: _vm.error.id_andamento
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
                  value: _vm.registro.id_andamento,
                  expression: "registro.id_andamento"
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
                    "id_andamento",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "" } }, [_vm._v("SELECIONE")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [_vm._v("ANDAMENTO")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [_vm._v("CONCLUÍDO")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "35" } }, [
                _vm._v("ANÁLISE DO CM")
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
            label: "id_andamentocoger",
            title: "Andamento COGER",
            error: _vm.error.id_andamentocoger
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
                  value: _vm.registro.id_andamentocoger,
                  expression: "registro.id_andamentocoger"
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
                    "id_andamentocoger",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", { attrs: { value: "" } }, [_vm._v("SELECIONE")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "18" } }, [_vm._v("DECIDIDO CG")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "19" } }, [_vm._v("VAJME")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "20" } }, [
                _vm._v("ARQUIVADO VAJME")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "45" } }, [
                _vm._v("JUSTICA COMUM")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "46" } }, [
                _vm._v("ARQUIVADO/JUST. COMUM")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "47" } }, [_vm._v("COGER")])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { label: "cdopm", title: "OPM", error: _vm.error.cdopm } },
        [
          _c("v-opm", {
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
        {
          attrs: {
            label: "fato_data",
            title: "Data da fato",
            icon: "fa fa-calendar"
          }
        },
        [
          _c("v-datepicker", {
            attrs: {
              name: "fato_data",
              placeholder: "dd/mm/aaaa",
              "clear-button": ""
            },
            model: {
              value: _vm.registro.fato_data,
              callback: function($$v) {
                _vm.$set(_vm.registro, "fato_data", $$v)
              },
              expression: "registro.fato_data"
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
            label: "abertura_data",
            title: "Data da portaria de delegação de poderes",
            icon: "fa fa-calendar"
          }
        },
        [
          _c("v-datepicker", {
            attrs: {
              name: "abertura_data",
              placeholder: "dd/mm/aaaa",
              "clear-button": ""
            },
            model: {
              value: _vm.registro.abertura_data,
              callback: function($$v) {
                _vm.$set(_vm.registro, "abertura_data", $$v)
              },
              expression: "registro.abertura_data"
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
            label: "autuacao_data",
            title: "Data da portaria de instauração",
            icon: "fa fa-calendar"
          }
        },
        [
          _c("v-datepicker", {
            attrs: {
              name: "autuacao_data",
              placeholder: "dd/mm/aaaa",
              "clear-button": ""
            },
            model: {
              value: _vm.registro.autuacao_data,
              callback: function($$v) {
                _vm.$set(_vm.registro, "autuacao_data", $$v)
              },
              expression: "registro.autuacao_data"
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
            label: "portaria_numero",
            title: "Nº da portaria de delegação de poderes"
          }
        },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.portaria_numero,
                expression: "registro.portaria_numero"
              }
            ],
            staticClass: "form-control ",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.portaria_numero },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "portaria_numero", $event.target.value)
              }
            }
          })
        ]
      ),
      _vm._v(" "),
      _c("v-label", { attrs: { label: "crime", title: "Crime" } }, [
        _c(
          "select",
          {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.crime,
                expression: "registro.crime"
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
                  "crime",
                  $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                )
              }
            }
          },
          [
            _c("option", { attrs: { value: "Homicidio" } }, [
              _vm._v('Homicidio"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Lesao Corporal" } }, [
              _vm._v('Lesao Corporal"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Extravio de arma" } }, [
              _vm._v('Extravio de arma"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Furto de arma" } }, [
              _vm._v('Furto de arma"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Roubo de arma" } }, [
              _vm._v('Roubo de arma"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Extravio de municao" } }, [
              _vm._v('Extravio de Munição"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Concussao" } }, [
              _vm._v('Concussão (Art. 305)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Peculato" } }, [
              _vm._v('Peculato (Art. 303)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Corrupcao passiva" } }, [
              _vm._v('Corrupção passiva (Art. 308)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Contrabando ou descaminho" } }, [
              _vm._v('Contrabando ou descaminho"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Uso de documento falso" } }, [
              _vm._v('Uso de documento falso (Art. 315)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Falsidade ideologica" } }, [
              _vm._v('Falsidade ideológica"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Fuga de Preso" } }, [
              _vm._v('Fuga de preso"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Prevaricacao" } }, [
              _vm._v('Prevaricação (Art. 319)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Violacao do sigilo funcional" } }, [
              _vm._v('Violação do sigilo funcional"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Deserção" } }, [
              _vm._v('Deserção"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Violencia contra superior" } }, [
              _vm._v('Violencia contra superior (Art. 157)"')
            ]),
            _vm._v(" "),
            _c(
              "option",
              { attrs: { value: "Violencia contra militar de sv" } },
              [_vm._v('Violencia contra militar de serviço (Art. 158)"')]
            ),
            _vm._v(" "),
            _c("option", { attrs: { value: "Desrespeito a superior" } }, [
              _vm._v('Desrespeito a superior (Art. 160)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Recusa de obediencia" } }, [
              _vm._v('Recusa de obediencia (Art. 163)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Abandono de posto" } }, [
              _vm._v('Abandono de posto (Art. 195)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Embriaguez em servico" } }, [
              _vm._v('Embriaguez em serviço (Art. 202)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Desacato a superior" } }, [
              _vm._v('Desacato a superior (Art. 298)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Desacato a militar" } }, [
              _vm._v('Desacato a militar (Art. 299)"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Furto" } }, [_vm._v('Furto"')]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Roubo" } }, [_vm._v('Roubo"')]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Dano" } }, [_vm._v('Dano"')]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Instigamento ao suicidio" } }, [
              _vm._v('Instigamento ao suicidio"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Abuso de autoridade" } }, [
              _vm._v('Abuso de autoridade"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Auferir vantagem indevida" } }, [
              _vm._v('Auferir vantagem indevida"')
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "Outros" } }, [
              _vm._v('Outros (especificar)"')
            ])
          ]
        )
      ]),
      _vm._v(" "),
      _vm.registro.crime == "Outros"
        ? _c(
            "v-label",
            {
              attrs: { label: "crime_especificar", title: "Especificar crime" }
            },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.registro.crime_especificar,
                    expression: "registro.crime_especificar"
                  }
                ],
                staticClass: "form-control ",
                attrs: { type: "text" },
                domProps: { value: _vm.registro.crime_especificar },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(
                      _vm.registro,
                      "crime_especificar",
                      $event.target.value
                    )
                  }
                }
              })
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { label: "id_municipio", title: "Municipio" } },
        [
          _c("v-municipio", {
            model: {
              value: _vm.registro.id_municipio,
              callback: function($$v) {
                _vm.$set(_vm.registro, "id_municipio", $$v)
              },
              expression: "registro.id_municipio"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { label: "bou_ano", title: "BOU (Ano)" } },
        [
          _c("v-ano", {
            model: {
              value: _vm.registro.bou_ano,
              callback: function($$v) {
                _vm.$set(_vm.registro, "bou_ano", $$v)
              },
              expression: "registro.bou_ano"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("v-label", { attrs: { label: "bou_numero", title: "N° BOU" } }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.registro.bou_numero,
              expression: "registro.bou_numero"
            }
          ],
          staticClass: "form-control ",
          attrs: { type: "text" },
          domProps: { value: _vm.registro.bou_numero },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.registro, "bou_numero", $event.target.value)
            }
          }
        })
      ]),
      _vm._v(" "),
      _c("v-label", { attrs: { label: "n_eproc", title: "N° Eproc" } }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.registro.n_eproc,
              expression: "registro.n_eproc"
            }
          ],
          staticClass: "form-control ",
          attrs: { type: "text" },
          domProps: { value: _vm.registro.n_eproc },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.registro, "n_eproc", $event.target.value)
            }
          }
        })
      ]),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { label: "ano_eproc", title: "Eproc (Ano)" } },
        [
          _c("v-ano", {
            model: {
              value: _vm.registro.ano_eproc,
              callback: function($$v) {
                _vm.$set(_vm.registro, "ano_eproc", $$v)
              },
              expression: "registro.ano_eproc"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-label",
        { attrs: { label: "relato_enc", title: "Conclusão do encarregado" } },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.relato_enc,
                expression: "registro.relato_enc"
              }
            ],
            staticClass: "form-control ",
            attrs: { type: "text" },
            domProps: { value: _vm.registro.relato_enc },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "relato_enc", $event.target.value)
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
            label: "sintese_txt",
            title: "Sintese",
            lg: "12",
            md: "12",
            error: _vm.error.sintese_txt
          }
        },
        [
          _vm._v(
            "\n\n        {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}\n    "
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-xs-12" }, [
        _vm.registro.id_ipm
          ? _c(
              "a",
              {
                staticClass: "btn btn-success btn-block",
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    return _vm.update(_vm.registro.id_ipm)
                  }
                }
              },
              [_vm._v("Editar")]
            )
          : _c(
              "a",
              {
                staticClass: "btn btn-success btn-block",
                on: { click: _vm.create }
              },
              [_vm._v("Inserir")]
            )
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
    require("vue-hot-reload-api")      .rerender("data-v-31228446", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3f7019fa", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Form.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Form.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Procedimentos/IPM/Form.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31228446\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-31228446\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Procedimentos/IPM/Form.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-31228446"
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
Component.options.__file = "resources/assets/js/components/Procedimentos/IPM/Form.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-31228446", Component.options)
  } else {
    hotAPI.reload("data-v-31228446", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});