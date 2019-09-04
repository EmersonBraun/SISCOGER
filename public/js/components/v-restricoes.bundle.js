webpackJsonp([53],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Restricoes.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['rg'],
    data: function data() {
        return {
            restricoes: [],
            canCreate: false,
            canRemove: false
        };
    },
    mounted: function mounted() {
        this.listrestricoes();
        this.canCreate = this.$root.hasPermission('criar-restricoes');
        this.canRemove = this.$root.hasPermission('editar-restricoes');
    },

    methods: {
        listrestricoes: function listrestricoes() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/restricaoCivil/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.restricoes = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Restricoes.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2b35f740\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Restricoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "Restrições", badge: _vm.restricoes.lenght } },
    [
      _c("table", { staticClass: "table table-striped" }, [
        _c(
          "tbody",
          [
            _vm.restricoes.lenght
              ? [
                  _c(
                    "tr",
                    [
                      _vm.restricao.arma_bl
                        ? _c("td", [
                            _c("b", [
                              _vm._v("Restricao de porte de arma de fogo.")
                            ])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.restricao.fardamento_bl
                        ? _c("td", [
                            _c("b", [_vm._v("Restricao de uso de fardamento.")])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c(
                        "td",
                        [
                          _c("b", [_vm._v("Inicio")]),
                          _vm._v(
                            ": " +
                              _vm._s(_vm.data_br(_vm.restricao.inicio_data)) +
                              " / \n                    "
                          ),
                          _c("b", [_vm._v("Fim")]),
                          _vm._v(":\n                    "),
                          _vm.restricao.retirada_data == "0000-00-00" &&
                          _vm.restricao.fim_data == "0000-00-00"
                            ? [_c("b", [_vm._v("Vigente")])]
                            : [
                                _vm._v(
                                  "\n                        " +
                                    _vm._s(
                                      _vm.data_br(_vm.restricao.retirada_data)
                                    ) +
                                    "\n                    "
                                )
                              ]
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _vm.canRemove
                        ? [
                            _vm.restricao.retirada_data == "0000-00-00" &&
                            _vm.restricao.fim_data == "0000-00-00"
                              ? _c("td", [
                                  _c(
                                    "button",
                                    {
                                      staticClass: "btn btn-default pull-right",
                                      attrs: { type: "button" }
                                    },
                                    [
                                      _c("i", { staticClass: "fa fa-minus" }),
                                      _vm._v(
                                        "Retirar restricao\n                        "
                                      )
                                    ]
                                  )
                                ])
                              : _vm._e()
                          ]
                        : _vm._e()
                    ],
                    2
                  )
                ]
              : [_c("tr", [_c("td", [_vm._v("Nada encontrado")])])]
          ],
          2
        )
      ]),
      _vm._v(" "),
      _vm.canCreate
        ? [
            _c(
              "button",
              {
                staticClass: "btn btn-primary btn-block",
                attrs: { type: "button" }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v("Adicionar Restrição\n    ")
              ]
            )
          ]
        : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-2b35f740", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Restricoes.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Restricoes.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("11077034", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Restricoes.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Restricoes.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Restricoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2b35f740\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Restricoes.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Restricoes.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2b35f740\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Restricoes.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-2b35f740"
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
Component.options.__file = "resources/assets/js/components/FDI/Restricoes.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2b35f740", Component.options)
  } else {
    hotAPI.reload("data-v-2b35f740", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});