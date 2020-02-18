webpackJsonp([58],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Sai.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['rg'],
    data: function data() {
        return {
            sai: [],
            canCreate: false,
            canEdit: false
        };
    },
    mounted: function mounted() {
        this.listsai();
        this.canCreate = this.$root.hasPermission('criar-sai');
        this.canEdit = this.$root.hasPermission('editar-sai');
    },

    computed: {
        urlCreate: function urlCreate() {
            var urlBase = this.$root.baseUrl;
            return urlBase + 'sai/criar';
        },
        urlEdit: function urlEdit(id) {
            var urlBase = this.$root.baseUrl;
            return urlBase + 'sai/editar/' + id;
        }
    },
    methods: {
        listsai: function listsai() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/fdi/sai/' + this.rg;
            if (this.rg) {
                axios.get(urlIndex).then(function (response) {
                    _this.sai = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Sai.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-b84598a0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Sai.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "SAI", badge: _vm.sai.lenght } },
    [
      _c("table", { staticClass: "table table-striped" }, [
        _c(
          "tbody",
          [
            _vm.sai.lenght
              ? [
                  _c("tr", [
                    _c("th", [_vm._v("N° SAI")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Motivo abertura")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Síntese do fato")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Situação")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Resultado")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Digitaror")]),
                    _vm._v(" "),
                    _c("th", [_vm._v("Ações")])
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.sai, function(s) {
                    return _c("tr", { key: s.id_sai }, [
                      _c(
                        "td",
                        [
                          s.sjd_ref !== 0
                            ? [
                                _vm._v(
                                  _vm._s(s.sjd_ref) +
                                    "/" +
                                    _vm._s(s.sjd_ref_ano)
                                )
                              ]
                            : [_vm._v(_vm._s(s.id_sai))]
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(s.motivo_principal) + " ")]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(s.sintese_txt) + " ")]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(s.situacao) + " ")]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(s.origem_proc) +
                            "-" +
                            _vm._s(s.origem_sjd_ref) +
                            "/" +
                            _vm._s(s.origem_sjd_ref_ano) +
                            " "
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(s.digitador) + " ")]),
                      _vm._v(" "),
                      _c("td", [
                        _c("span", [
                          _c(
                            "a",
                            {
                              staticClass: "btn btn-info",
                              attrs: { href: _vm.urlEdit(s.id_sai) }
                            },
                            [_c("i", { staticClass: "fa fa-fw fa-edit " })]
                          )
                        ])
                      ])
                    ])
                  })
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
              "a",
              {
                staticClass: "btn btn-primary btn-block",
                attrs: { href: _vm.urlCreate }
              },
              [
                _c("i", { staticClass: "fa fa-fw fa-plus " }),
                _vm._v("Adicionar SAI\n    ")
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
    require("vue-hot-reload-api")      .rerender("data-v-b84598a0", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Sai.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Sai.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("c300e35c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Sai.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Sai.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FDI/Sai.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b84598a0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Sai.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Sai.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-b84598a0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Sai.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-b84598a0"
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
Component.options.__file = "resources/assets/js/components/FDI/Sai.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b84598a0", Component.options)
  } else {
    hotAPI.reload("data-v-b84598a0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});