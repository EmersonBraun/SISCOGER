webpackJsonp([46],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/ItemUnique.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        title: { type: String, default: '' }, //titulo
        label: { type: String, default: '' },
        name: { type: String, default: '' },
        // error: '',
        idp: { type: String, default: '' },
        proc: { type: String, default: '' }

    },
    data: function data() {
        return {
            input: '',
            status: '',
            view: false
        };
    },
    beforeMount: function beforeMount() {
        this.dadoCampo();
    },

    computed: {
        getBaseUrl: function getBaseUrl() {
            // URL completa
            var getUrl = window.location;
            // dividir em array
            var pathname = getUrl.pathname.split('/');
            this.view = pathname[3] == 'ver' ? true : false;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1] + "/";

            return baseUrl;
        }
    },
    watch: {
        status: function status() {
            var _this = this;

            if (this.status !== '') {
                setTimeout(function () {
                    _this.status = '';
                }, 2000);
            }
        }
    },
    methods: {
        insert: function insert() {
            var _this2 = this;

            var urlInsert = this.getBaseUrl + 'api/proc/update/' + this.proc + '/' + this.idp + '/' + this.name;
            axios.post(urlInsert, {
                input: this.input
            }).then(this.status = 'ok').catch(function (error) {
                console.log(error);
                _this2.erro = "Erro ao enviar";
                _this2.status = 'error';
            });
        },
        remove: function remove() {
            this.input = '';
            this.insert();
        },
        dadoCampo: function dadoCampo() {
            var _this3 = this;

            var urlIndex = this.getBaseUrl + 'api/proc/dadocampo/' + this.proc + '/' + this.idp + '/' + this.name;
            axios.get(urlIndex).then(function (response) {
                _this3.input = response.data.input;
                // console.log(this.input)
            }).catch(function (error) {
                console.log(error);
                _this3.erro = "Erro ao enviar";
            });
        }
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItemUnique.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.input-group {\n    position: relative;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -ms-flex-wrap: wrap;\n    flex-wrap: wrap;\n    -webkit-box-align: stretch;\n    -ms-flex-align: stretch;\n    align-items: stretch;\n    width: 100%;\n}\n.input-group-append {\n    margin-left: -1px;\n}\n.input-group-append, .input-group-prepend {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n.input-group > .custom-select:not(:last-child), .input-group > .form-control:not(:last-child) {\n    border-top-right-radius: 0;\n    border-bottom-right-radius: 0;\n}\n.input-group > .custom-file, .input-group > .custom-select, .input-group > .form-control {\n    position: relative;\n    -webkit-box-flex: 1;\n    -ms-flex: 1 1 auto;\n    flex: 1 1 auto;\n    width: 1%;\n    margin-bottom: 0;\n}\n.form-control {\n    display: block;\n    width: 100%;\n    padding: .375rem .75rem;\n    font-size: 1rem;\n    line-height: 1.5;\n    color: #495057;\n    background-color: #fff;\n    background-clip: padding-box;\n    border: 1px solid #ced4da;\n    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;\n}\nbutton, input {\n    overflow: visible;\n}\nbutton, input, optgroup, select, textarea {\n    margin: 0;\n    margin-bottom: 0px;\n    font-family: inherit;\n    font-size: inherit;\n    line-height: inherit;\n}\n.input-group-text {\n    display: -ms-flexbox;\n    display: flex;\n    -ms-flex-align: center;\n    align-items: center;\n    padding: .375rem .75rem;\n    margin-bottom: 0;\n    font-size: 1rem;\n    font-weight: 400;\n    line-height: 1.5;\n    color: #495057;\n    text-align: center;\n    white-space: nowrap;\n    background-color: #e9ecef;\n    border: 1px solid #ced4da;\n    border-radius: .25rem;\n        border-top-right-radius: 0.25rem;\n        border-bottom-right-radius: 0.25rem;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-38a47ab0\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/ItemUnique.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "mb-12 form-group " }, [
    _c("label", { attrs: { for: _vm.label } }, [_vm._v(_vm._s(_vm.title))]),
    _c("br"),
    _vm._v(" "),
    !_vm.view
      ? _c("div", { staticClass: "input-group " }, [
          _vm.status
            ? _c("div", { staticClass: "input-group-prepend" }, [
                _vm.status == "ok"
                  ? _c("span", {
                      staticClass: "input-group-text fa fa-check",
                      staticStyle: { color: "green" }
                    })
                  : _c("span", {
                      staticClass: "input-group-text fa fa-times",
                      staticStyle: { color: "red" }
                    })
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.input,
                expression: "input"
              }
            ],
            staticClass: "form-control",
            attrs: { name: _vm.name, type: "text" },
            domProps: { value: _vm.input },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.input = $event.target.value
              }
            }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "input-group-append" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-success",
                attrs: { disabled: !_vm.input.length },
                on: {
                  click: function($event) {
                    return _vm.insert()
                  }
                }
              },
              [_vm._v("Inserir/ Alterar")]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-danger",
                attrs: { disabled: !_vm.input.length },
                on: {
                  click: function($event) {
                    return _vm.remove()
                  }
                }
              },
              [_vm._v("Apagar")]
            )
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c("p", [_vm._v(_vm._s(_vm.input || "Não Há "))])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-38a47ab0", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItemUnique.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItemUnique.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("6e1c4f85", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ItemUnique.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ItemUnique.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Form/ItemUnique.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-38a47ab0\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/ItemUnique.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/ItemUnique.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-38a47ab0\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/ItemUnique.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
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
Component.options.__file = "resources/assets/js/components/Form/ItemUnique.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-38a47ab0", Component.options)
  } else {
    hotAPI.reload("data-v-38a47ab0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});