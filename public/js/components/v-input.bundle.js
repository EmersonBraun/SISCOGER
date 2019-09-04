webpackJsonp([12],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Input.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/utils/utils.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__utils_NodeList_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/utils/NodeList.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




var DELAY = 300;

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    clearButton: { type: Boolean, default: false },
    cols: { type: Number, default: null },
    datalist: { type: Array, default: null },
    disabled: { type: Boolean, default: false },
    enterSubmit: { type: Boolean, default: false },
    error: { type: String, default: null },
    help: { type: String, default: null },
    hideHelp: { type: Boolean, default: true },
    icon: { type: Boolean, default: false },
    label: { type: String, default: null },
    lang: { type: String, default: navigator.language },
    mask: null,
    maskDelay: { type: Number, default: 100 },
    match: { type: String, default: null },
    max: { type: String, default: null },
    maxlength: { type: Number, default: null },
    min: { type: String, default: null },
    minlength: { type: Number, default: 0 },
    name: { type: String, default: null },
    pattern: { default: null },
    placeholder: { type: String, default: null },
    readonly: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    rows: { type: Number, default: 3 },
    step: { type: Number, default: null },
    type: { type: String, default: 'text' },
    url: { type: String, default: null },
    urlMap: { type: Function, default: null },
    validationDelay: { type: Number, default: 250 },
    value: { default: null }
  },
  data: function data() {
    var val = this.value;
    return {
      options: this.datalist,
      val: val,
      valid: null,
      timeout: null
    };
  },

  computed: {
    canValidate: function canValidate() {
      return !this.disabled && !this.readonly && (this.required || this.regex || this.nativeValidate || this.match !== null);
    },
    errorText: function errorText() {
      var value = this.value;
      var error = [this.error];
      if (!value && this.required) error.push('(' + this.text.required.toLowerCase() + ')');
      if (value && value.length < this.minlength) error.push('(' + this.text.minLength.toLowerCase() + ': ' + this.minlength + ')');
      return error.join(' ');
    },
    id_datalist: function id_datalist() {
      if (this.type !== 'textarea' && this.datalist instanceof Array) {
        if (!this._id_datalist) {
          if (!this.$root.id_datalist) {
            this.$root.id_datalist = 0;
          }
          this._id_datalist = 'input-datalist' + this.$root.id_datalist++;
        }
        return this._id_datalist;
      }
      return null;
    },
    input: function input() {
      return this.$refs.input;
    },
    nativeValidate: function nativeValidate() {
      return (this.input || {}).checkValidity && (~['url', 'email'].indexOf(this.type.toLowerCase()) || this.min || this.max);
    },
    regex: function regex() {
      return __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["a" /* coerce */].pattern(this.pattern);
    },
    showError: function showError() {
      return this.error && this.valid === false;
    },
    showHelp: function showHelp() {
      return this.help && (!this.showError || !this.hideHelp);
    },
    text: function text() {
      return Object(__WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["e" /* translations */])(this.lang);
    },
    title: function title() {
      return this.errorText || this.help || '';
    }
  },
  watch: {
    datalist: function datalist(val, old) {
      if (val !== old && val instanceof Array) {
        this.options = val;
      }
    },
    match: function match(val) {
      this.eval();
    },
    options: function options(val, old) {
      if (val !== old) this.$emit('options', val);
    },
    url: function url(val) {
      this._url();
    },
    val: function val(_val, old) {
      var _this = this;

      this.$emit('input', _val);
      if (_val !== old) {
        if (this.mask instanceof Function) {
          _val = this.mask(_val || '');
          if (this.val !== _val) {
            if (this._timeout.mask) clearTimeout(this._timeout.mask);
            this._timeout.mask = setTimeout(function () {
              _this.val = _val;
            }, isNaN(this.maskDelay) ? 0 : this.maskDelay);
          }
        }
        this.eval();
      }
    },
    valid: function valid(val, old) {
      this.$emit('isvalid', val);
      this.$emit(!val ? 'invalid' : 'valid');
      if (this._parent) this._parent.validate();
    },
    value: function value(val) {
      if (this.val !== val) {
        this.val = val;
      }
    }
  },
  methods: {
    attr: function attr(value) {
      return ~['', null, undefined].indexOf(value) || value instanceof Function ? null : value;
    },
    emit: function emit(e) {
      this.$emit(e.type, e.type == 'input' ? e.target.value : e);
      if (e.type === 'blur' && this.canValidate) {
        this.valid = this.validate();
      }
    },
    eval: function _eval() {
      var _this2 = this;

      if (this._timeout.eval) clearTimeout(this._timeout.eval);
      if (!this.canValidate) {
        this.valid = true;
      } else {
        this._timeout.eval = setTimeout(function () {
          _this2.valid = _this2.validate();
          _this2._timeout.eval = null;
        }, this.validationDelay);
      }
    },
    focus: function focus() {
      this.input.focus();
    },
    submit: function submit() {
      if (this.$parent._formValidator) {
        return this.$parent.validate();
      }
      if (this.input.form) {
        var invalids = Object(__WEBPACK_IMPORTED_MODULE_1__utils_NodeList_js__["a" /* default */])('.form-group.validate:not(.has-success)', this.input.form);
        if (invalids.length) {
          invalids.find('input,textarea,select')[0].focus();
        } else {
          this.input.form.submit();
        }
      }
    },
    validate: function validate() {
      if (!this.canValidate) {
        return true;
      }
      var value = (this.val || '').trim();
      if (!value) {
        return !this.required;
      }
      if (this.match !== null) {
        return this.match === value;
      }
      if (value.length < this.minlength) {
        return false;
      }
      if (this.nativeValidate && !this.input.checkValidity()) {
        return false;
      }
      if (this.regex) {
        if (!(this.regex instanceof Function ? this.regex(this.val) : this.regex.test(this.val))) {
          return false;
        }
      }
      return true;
    },
    reset: function reset() {
      this.value = '';
      this.valid = null;
      if (this._timeout.mask) clearTimeout(this._timeout.mask);
      if (this._timeout.eval) clearTimeout(this._timeout.eval);
    }
  },
  created: function created() {
    this._input = true;
    this._timeout = {};
    var parent = this.$parent;
    while (parent && !parent._formValidator) {
      parent = parent.$parent;
    }
    if (parent && parent._formValidator) {
      parent.children.push(this);
      this._parent = parent;
    }
    this._url = Object(__WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["b" /* delayer */])(function () {
      var _this3 = this;

      if (!this.url || !this.$http || this._loading) {
        return;
      }
      this._loading = true;
      this.$http.get(this.url).then(function (response) {
        var data = response.data instanceof Array ? response.data : [];
        try {
          data = JSON.parse(data);
        } catch (e) {}
        if (_this3.urlMap) {
          data = data.map(_this3.urlMap);
        }
        _this3.options = data;
        _this3.loading = false;
      }, function (response) {
        _this3.loading = false;
      });
    }, DELAY);
    if (this.url) this._url();
  },
  mounted: function mounted() {
    // $(this.input).on('focus', e => { this.$emit('focus', e) }).on('blur', e => {
    //   if (this.canValidate) { this.valid = this.validate() }
    //   this.$emit('blur', e)
    // })
  },
  beforeDestroy: function beforeDestroy() {
    // $(this.input).off()
    if (this._parent) {
      var index = this._parent.children.indexOf(this);
      this._parent.children.splice(index, 1);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Input.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.form-group[data-v-8911bda8] {\n  position: relative;\n}\nlabel~.close[data-v-8911bda8] {\n  top: 25px;\n}\n.input-group>.icon[data-v-8911bda8] {\n  position: relative;\n  display: table-cell;\n  width:0;\n  z-index: 3;\n}\n.close[data-v-8911bda8] {\n  position: absolute;\n  top: 0;\n  right: 0;\n  z-index: 2;\n  display: block;\n  width: 34px;\n  height: 34px;\n  line-height: 34px;\n  text-align: center;\n}\n.has-feedback .close[data-v-8911bda8] {\n  right: 20px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-8911bda8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Input.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "form-group",
      class: {
        validate: _vm.canValidate,
        "has-feedback": _vm.icon,
        "has-error": _vm.canValidate && _vm.valid === false,
        "has-success": _vm.canValidate && _vm.valid
      }
    },
    [
      _vm._t("label", [
        _vm.label
          ? _c(
              "label",
              { staticClass: "control-label", on: { click: _vm.focus } },
              [_vm._v(_vm._s(_vm.label))]
            )
          : _vm._e()
      ]),
      _vm._v(" "),
      _vm.$slots.before || _vm.$slots.after
        ? _c(
            "div",
            { staticClass: "input-group" },
            [
              _vm._t("before"),
              _vm._v(" "),
              _c(_vm.type == "textarea" ? _vm.type : "input", {
                ref: "input",
                tag: "textarea",
                staticClass: "form-control",
                attrs: {
                  cols: _vm.cols,
                  disabled: _vm.disabled,
                  list: _vm.id_datalist,
                  max: _vm.attr(_vm.max),
                  maxlength: _vm.maxlength,
                  min: _vm.attr(_vm.min),
                  name: _vm.name,
                  placeholder: _vm.placeholder,
                  readonly: _vm.readonly,
                  required: _vm.required,
                  rows: _vm.rows,
                  step: _vm.step,
                  title: _vm.attr(_vm.title),
                  type: _vm.type == "textarea" ? null : _vm.type
                },
                on: {
                  blur: _vm.emit,
                  focus: _vm.emit,
                  input: _vm.emit,
                  keyup: function($event) {
                    if (
                      !$event.type.indexOf("key") &&
                      _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                    ) {
                      return null
                    }
                    _vm.type != "textarea" && _vm.enterSubmit && _vm.submit()
                  }
                },
                model: {
                  value: _vm.val,
                  callback: function($$v) {
                    _vm.val = $$v
                  },
                  expression: "val"
                }
              }),
              _vm._v(" "),
              _vm.clearButton && _vm.value
                ? _c("div", { class: { icon: _vm.icon } }, [
                    _c(
                      "span",
                      {
                        staticClass: "close",
                        on: {
                          click: function($event) {
                            _vm.value = ""
                          }
                        }
                      },
                      [_vm._v("×")]
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.icon
                ? _c("div", { staticClass: "icon" }, [
                    _vm.icon && _vm.valid !== null
                      ? _c("span", {
                          class: [
                            "form-control-feedback glyphicon",
                            "glyphicon-" + (_vm.valid ? "ok" : "remove")
                          ],
                          attrs: { "aria-hidden": "true" }
                        })
                      : _vm._e()
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm._t("after")
            ],
            2
          )
        : [
            _c(_vm.type == "textarea" ? _vm.type : "input", {
              ref: "input",
              tag: "textarea",
              staticClass: "form-control",
              attrs: {
                cols: _vm.cols,
                disabled: _vm.disabled,
                list: _vm.id_datalist,
                max: _vm.attr(_vm.max),
                maxlength: _vm.maxlength,
                min: _vm.attr(_vm.min),
                name: _vm.name,
                placeholder: _vm.placeholder,
                readonly: _vm.readonly,
                required: _vm.required,
                rows: _vm.rows,
                step: _vm.step,
                title: _vm.attr(_vm.title),
                type: _vm.type == "textarea" ? null : _vm.type
              },
              on: {
                blur: _vm.emit,
                focus: _vm.emit,
                input: _vm.emit,
                keyup: function($event) {
                  if (
                    !$event.type.indexOf("key") &&
                    _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                  ) {
                    return null
                  }
                  _vm.type != "textarea" && _vm.enterSubmit && _vm.submit()
                }
              },
              model: {
                value: _vm.val,
                callback: function($$v) {
                  _vm.val = $$v
                },
                expression: "val"
              }
            }),
            _vm._v(" "),
            _vm.clearButton && _vm.val
              ? _c(
                  "span",
                  {
                    staticClass: "close",
                    on: {
                      click: function($event) {
                        _vm.val = ""
                      }
                    }
                  },
                  [_vm._v("×")]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.icon && _vm.valid !== null
              ? _c("span", {
                  class: [
                    "form-control-feedback glyphicon",
                    "glyphicon-" + (_vm.valid ? "ok" : "remove")
                  ],
                  attrs: { "aria-hidden": "true" }
                })
              : _vm._e()
          ],
      _vm._v(" "),
      _vm.id_datalist
        ? _c(
            "datalist",
            { attrs: { id: _vm.id_datalist } },
            _vm._l(_vm.options, function(opc) {
              return _c("option", { domProps: { value: opc } })
            }),
            0
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.showHelp
        ? _c("div", { staticClass: "help-block", on: { click: _vm.focus } }, [
            _vm._v(_vm._s(_vm.help))
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm.showError
        ? _c(
            "div",
            { staticClass: "help-block with-errors", on: { click: _vm.focus } },
            [_vm._v(_vm._s(_vm.errorText))]
          )
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
    require("vue-hot-reload-api")      .rerender("data-v-8911bda8", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Input.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Input.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("6de5ecb8", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Input.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Input.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Input.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8911bda8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Input.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Input.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-8911bda8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Input.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-8911bda8"
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Input.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-8911bda8", Component.options)
  } else {
    hotAPI.reload("data-v-8911bda8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/utils/NodeList.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

__webpack_require__("./resources/assets/js/components/Vuestrap/utils/PolyFills.js");

var ArrayProto = Array.prototype;
var nodeError = new Error('Passed arguments must be of Node');
var blurEvent;
var blurList = [];
var Events = [];

function isNode(val) {
  return val instanceof window.Node;
}
function isNodeList(val) {
  return val instanceof window.NodeList || val instanceof NodeList || val instanceof window.HTMLCollection || val instanceof Array;
}

var NodeList = function () {
  function NodeList(args) {
    _classCallCheck(this, NodeList);

    var nodes = args;
    if (args[0] === window) {
      nodes = [window];
    } else if (typeof args[0] === 'string') {
      nodes = (args[1] || document).querySelectorAll(args[0]);
      if (args[1]) {
        this.owner = args[1];
      }
    } else if (0 in args && !isNode(args[0]) && args[0] && 'length' in args[0]) {
      nodes = args[0];
      if (args[1]) {
        this.owner = args[1];
      }
    }
    if (nodes) {
      for (var i in nodes) {
        this[i] = nodes[i];
      }
      this.length = nodes.length;
    } else {
      this.length = 0;
    }
    window.prueba = this;
  }

  _createClass(NodeList, [{
    key: 'concat',
    value: function concat() {
      var nodes = ArrayProto.slice.call(this);
      function flatten(arr) {
        ArrayProto.forEach.call(arr, function (el) {
          if (isNode(el)) {
            if (!~nodes.indexOf(el)) nodes.push(el);
          } else if (isNodeList(el)) {
            flatten(el);
          }
        });
      }

      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      ArrayProto.forEach.call(args, function (arg) {
        if (isNode(arg)) {
          if (!~nodes.indexOf(arg)) nodes.push(arg);
        } else if (isNodeList(arg)) {
          flatten(arg);
        } else {
          throw Error('Concat arguments must be of a Node, NodeList, HTMLCollection, or Array of (Node, NodeList, HTMLCollection, Array)');
        }
      });
      return NodeListJS(nodes, this);
    }
  }, {
    key: 'delete',
    value: function _delete() {
      var notRemoved = flatten(this).filter(function (el) {
        if (el.remove) {
          el.remove();
        } else if (el.parentNode) {
          el.parentNode.removeChild(el);
        }
        return document.body.contains(el);
      });
      if (notRemoved.length) console.warn('NodeList: Some nodes could not be deleted.');
      return notRemoved;
    }
  }, {
    key: 'each',
    value: function each() {
      for (var _len2 = arguments.length, args = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      ArrayProto.forEach.apply(this, args);
      return this;
    }
  }, {
    key: 'filter',
    value: function filter() {
      for (var _len3 = arguments.length, args = Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
        args[_key3] = arguments[_key3];
      }

      return NodeListJS(ArrayProto.filter.apply(this, args), this);
    }
  }, {
    key: 'find',
    value: function find(element) {
      var nodes = [];
      if (typeof element === 'string') flatten(this).forEach(function (node) {
        nodes.push(node.querySelectorAll(element));
      });
      if (isNode(element)) flatten(this).forEach(function (node) {
        if (node !== element && node.contains(element)) nodes.push(element);
      });
      if (isNodeList(element)) {
        var els = flatten(element);
        flatten(this).forEach(function (node) {
          els.forEach(function (el) {
            if (node !== el && node.contains(el)) nodes.push(el);
          });
        });
      }
      return flatten(nodes, this.owner);
    }
  }, {
    key: 'forEach',
    value: function forEach() {
      for (var _len4 = arguments.length, args = Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
        args[_key4] = arguments[_key4];
      }

      ArrayProto.forEach.apply(this, args);
      return this;
    }
  }, {
    key: 'includes',
    value: function includes(element, index) {
      return ~this.indexOf(element, index);
    }
  }, {
    key: 'map',
    value: function map() {
      for (var _len5 = arguments.length, args = Array(_len5), _key5 = 0; _key5 < _len5; _key5++) {
        args[_key5] = arguments[_key5];
      }

      var mapped = ArrayProto.map.apply(this, args);
      return mapped.some(function (el) {
        return isNode(el) || isNodeList(el);
      }) ? flatten(mapped, this) : mapped;
    }
  }, {
    key: 'parent',
    value: function parent() {
      return flatten(this.map(function (el) {
        return el.parentNode;
      }), this);
    }
  }, {
    key: 'pop',
    value: function pop(amount) {
      if (typeof amount !== 'number') {
        amount = 1;
      }
      var nodes = [];
      var pop = ArrayProto.pop.bind(this);
      while (amount--) {
        nodes.push(pop());
      }return NodeListJS(nodes, this);
    }
  }, {
    key: 'push',
    value: function push() {
      var _this = this;

      for (var _len6 = arguments.length, args = Array(_len6), _key6 = 0; _key6 < _len6; _key6++) {
        args[_key6] = arguments[_key6];
      }

      ArrayProto.forEach.call(args, function (arg) {
        if (!isNode(arg)) throw nodeError;
        if (!~_this.indexOf(arg)) ArrayProto.push.call(_this, arg);
      });
      return this;
    }
  }, {
    key: 'shift',
    value: function shift(amount) {
      if (typeof amount !== 'number') {
        amount = 1;
      }
      var nodes = [];
      while (amount--) {
        nodes.push(ArrayProto.shift.call(this));
      }return nodes.length == 1 ? nodes[0] : NodeListJS(nodes, this);
    }
  }, {
    key: 'slice',
    value: function slice() {
      for (var _len7 = arguments.length, args = Array(_len7), _key7 = 0; _key7 < _len7; _key7++) {
        args[_key7] = arguments[_key7];
      }

      return NodeListJS(ArrayProto.slice.apply(this, args), this);
    }
  }, {
    key: 'splice',
    value: function splice() {
      for (var _len8 = arguments.length, args = Array(_len8), _key8 = 0; _key8 < _len8; _key8++) {
        args[_key8] = arguments[_key8];
      }

      for (var i = 2, l = args.length; i < l; i++) {
        if (!isNode(args[i])) throw nodeError;
      }
      ArrayProto.splice.apply(this, args);
      return this;
    }
  }, {
    key: 'unshift',
    value: function unshift() {
      var _this2 = this;

      var unshift = ArrayProto.unshift.bind(this);

      for (var _len9 = arguments.length, args = Array(_len9), _key9 = 0; _key9 < _len9; _key9++) {
        args[_key9] = arguments[_key9];
      }

      ArrayProto.forEach.call(args, function (arg) {
        if (!isNode(arg)) throw nodeError;
        if (!~_this2.indexOf(arg)) unshift(arg);
      });
      return this;
    }
  }, {
    key: 'addClass',
    value: function addClass(classes) {
      return this.toggleClass(classes, true);
    }
  }, {
    key: 'removeClass',
    value: function removeClass(classes) {
      return this.toggleClass(classes, false);
    }
  }, {
    key: 'toggleClass',
    value: function toggleClass(classes) {
      var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

      var method = value === undefined || value === null ? 'toggle' : value ? 'add' : 'remove';
      if (typeof classes === 'string') {
        classes = classes.trim().replace(/\s+/, ' ').split(' ');
      }
      return this.each(function (el) {
        return classes.forEach(function (c) {
          return el.classList[method](c);
        });
      });
    }
  }, {
    key: 'get',
    value: function get(prop) {
      var arr = [];
      this.each(function (el) {
        if (el !== null) {
          el = el[prop];
        }
        arr.push(el);
      });
      return flatten(arr, this);
    }
  }, {
    key: 'set',
    value: function set(prop, value) {
      if (prop.constructor === Object) {
        this.each(function (el) {
          if (el) {
            for (var key in prop) {
              if (key in el) {
                el[key] = prop[key];
              }
            }
          }
        });
      } else {
        this.each(function (el) {
          if (prop in el) {
            el[prop] = value;
          }
        });
      }
      return this;
    }
  }, {
    key: 'call',
    value: function call() {
      for (var _len10 = arguments.length, args = Array(_len10), _key10 = 0; _key10 < _len10; _key10++) {
        args[_key10] = arguments[_key10];
      }

      var method = ArrayProto.shift.call(args);
      var arr = [];
      var returnThis = true;
      this.each(function (el) {
        if (el && el[method] instanceof Function) {
          el = el[method].apply(el, args);
          arr.push(el);
          if (returnThis && el !== undefined) {
            returnThis = false;
          }
        } else {
          arr.push(undefined);
        }
      });
      return returnThis ? this : flatten(arr, this);
    }
  }, {
    key: 'item',
    value: function item(index) {
      return NodeListJS([this[index]], this);
    }
  }, {
    key: 'on',


    // event handlers
    value: function on(events, selector, callback) {
      if (typeof events === 'string') {
        events = events.trim().replace(/\s+/, ' ').split(' ');
      }
      if (!this || !this.length) return this;
      if (callback === undefined) {
        callback = selector;
        selector = null;
      }
      if (!callback) return this;
      var fn = callback;
      callback = selector ? function (e) {
        var els = NodeListJS(selector, this);
        if (!els.length) {
          return;
        }
        els.some(function (el) {
          var target = el.contains(e.target);
          if (target) fn.call(el, e, el);
          return target;
        });
      } : function (e) {
        fn.apply(this, [e, this]);
      };
      this.each(function (el) {
        events.forEach(function (event) {
          if (el === window || isNode(el)) {
            el.addEventListener(event, callback, false);
            Events.push({
              el: el,
              event: event,
              callback: callback
            });
          }
        });
      });
      return this;
    }
  }, {
    key: 'off',
    value: function off(events, callback) {
      if (events instanceof Function) {
        callback = events;
        events = null;
      }
      events = events instanceof Array ? events : typeof events === 'string' ? events.trim().replace(/\s+/, ' ').split(' ') : null;
      this.each(function (el) {
        Events = Events.filter(function (e) {
          if (e && e.el === el && (!callback || callback === e.callback) && (!events || ~events.indexOf(e.event))) {
            e.el.removeEventListener(e.event, e.callback);
            return false;
          }
          return true;
        });
      });
      return this;
    }
  }, {
    key: 'onBlur',
    value: function onBlur(callback) {
      if (!this || !this.length) return this;
      if (!callback) return this;
      this.each(function (el) {
        blurList.push({ el: el, callback: callback });
      });
      if (!blurEvent) {
        blurEvent = function blurEvent(e) {
          blurList.forEach(function (item) {
            var target = item.el.contains(e.target) || item.el === e.target;
            if (!target) item.callback.call(item.el, e, item.el);
          });
        };
        document.addEventListener('click', blurEvent, false);
        document.addEventListener('touchstart', blurEvent, false);
      }
      return this;
    }
  }, {
    key: 'offBlur',
    value: function offBlur(callback) {
      this.each(function (el) {
        blurList = blurList.filter(function (blur) {
          if (blur && blur.el === el && (!callback || blur.callback === callback)) {
            return false;
          }
          return el;
        });
      });
      return this;
    }
  }, {
    key: 'asArray',
    get: function get() {
      return ArrayProto.slice.call(this);
    }
  }]);

  return NodeList;
}();

var NL = NodeList.prototype;

function flatten(arr, owner) {
  var list = [];
  ArrayProto.forEach.call(arr, function (el) {
    if (isNode(el)) {
      if (!~list.indexOf(el)) list.push(el);
    } else if (isNodeList(el)) {
      for (var id in el) {
        if (!~list.indexOf(el[id])) list.push(el[id]);
      }
    } else if (el !== null) {
      arr.get = NL.get;
      arr.set = NL.set;
      arr.call = NL.call;
      arr.owner = owner;
      return arr;
    }
  });
  return NodeListJS(list, owner);
}

var exceptions = ['join', 'copyWithin', 'fill', 'find', 'forEach'];
Object.getOwnPropertyNames(ArrayProto).forEach(function (key) {
  if (!~exceptions.indexOf(key) && NL[key] === undefined) {
    NL[key] = ArrayProto[key];
  }
});
if (window.Symbol && Symbol.iterator) {
  NL[Symbol.iterator] = NL.values = ArrayProto[Symbol.iterator];
}
var div = document.createElement('div');
function setterGetter(prop) {
  var _this3 = this;

  if (NL[prop]) return;
  if (div[prop] instanceof Function) {
    NL[prop] = function () {
      for (var _len11 = arguments.length, args = Array(_len11), _key11 = 0; _key11 < _len11; _key11++) {
        args[_key11] = arguments[_key11];
      }

      var arr = [];
      var returnThis = true;
      for (var i in NL) {
        var el = NL[i];
        if (el && el[prop] instanceof Function) {
          el = el[prop].apply(el, args);
          arr.push(el);
          if (returnThis && el !== undefined) {
            returnThis = false;
          }
        } else {
          arr.push(undefined);
        }
      }
      return returnThis ? _this3 : flatten(arr, _this3);
    };
  } else {
    Object.defineProperty(NL, prop, {
      get: function get() {
        var arr = [];
        this.each(function (el) {
          if (el !== null) {
            el = el[prop];
          }
          arr.push(el);
        });
        return flatten(arr, this);
      },
      set: function set(value) {
        this.each(function (el) {
          if (el && prop in el) {
            el[prop] = value;
          }
        });
      }
    });
  }
}
for (var prop in div) {
  setterGetter(prop);
}function NodeListJS() {
  for (var _len12 = arguments.length, args = Array(_len12), _key12 = 0; _key12 < _len12; _key12++) {
    args[_key12] = arguments[_key12];
  }

  return new NodeList(args);
}
window.NL = NodeListJS;

/* harmony default export */ __webpack_exports__["a"] = (NodeListJS);

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/utils/PolyFills.js":
/***/ (function(module, exports) {

/**
 * Array.find
 */
if (!Array.prototype.find) {
  Array.prototype.find = function (predicate) {
    'use strict';

    if (this == null) {
      throw new TypeError('Array.prototype.find called on null or undefined');
    }
    if (typeof predicate !== 'function') {
      throw new TypeError('predicate must be a function');
    }
    var list = Object(this);
    var length = list.length >>> 0;
    var thisArg = arguments[1];
    var value;

    for (var i = 0; i < length; i++) {
      value = list[i];
      if (predicate.call(thisArg, value, i, list)) {
        return value;
      }
    }
    return undefined;
  };
}

/*
 * classList.js: Cross-browser full element.classList implementation.
 * 1.1.20150312
 *
 * By Eli Grey, http://eligrey.com
 * License: Dedicated to the public domain.
 *   See https://github.com/eligrey/classList.js/blob/master/LICENSE.md
 */
/*global self, document, DOMException */
/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js */
if ("document" in self) {
  // Full polyfill for browsers with no classList support
  // Including IE < Edge missing SVGElement.classList
  if (!("classList" in document.createElement("_")) || document.createElementNS && !("classList" in document.createElementNS("http://www.w3.org/2000/svg", "g"))) {

    (function (view) {

      "use strict";

      if (!('Element' in view)) return;

      var classListProp = "classList",
          protoProp = "prototype",
          elemCtrProto = view.Element[protoProp],
          objCtr = Object,
          strTrim = String[protoProp].trim || function () {
        return this.replace(/^\s+|\s+$/g, "");
      },
          arrIndexOf = Array[protoProp].indexOf || function (item) {
        var i = 0,
            len = this.length;
        for (; i < len; i++) {
          if (i in this && this[i] === item) {
            return i;
          }
        }
        return -1;
      }
      // Vendors: please allow content code to instantiate DOMExceptions
      ,
          DOMEx = function DOMEx(type, message) {
        this.name = type;
        this.code = DOMException[type];
        this.message = message;
      },
          checkTokenAndGetIndex = function checkTokenAndGetIndex(classList, token) {
        if (token === "") {
          throw new DOMEx("SYNTAX_ERR", "An invalid or illegal string was specified");
        }
        if (/\s/.test(token)) {
          throw new DOMEx("INVALID_CHARACTER_ERR", "String contains an invalid character");
        }
        return arrIndexOf.call(classList, token);
      },
          ClassList = function ClassList(elem) {
        var trimmedClasses = strTrim.call(elem.getAttribute("class") || ""),
            classes = trimmedClasses ? trimmedClasses.split(/\s+/) : [],
            i = 0,
            len = classes.length;
        for (; i < len; i++) {
          this.push(classes[i]);
        }
        this._updateClassName = function () {
          elem.setAttribute("class", this.toString());
        };
      },
          classListProto = ClassList[protoProp] = [],
          classListGetter = function classListGetter() {
        return new ClassList(this);
      };
      // Most DOMException implementations don't allow calling DOMException's toString()
      // on non-DOMExceptions. Error's toString() is sufficient here.
      DOMEx[protoProp] = Error[protoProp];
      classListProto.item = function (i) {
        return this[i] || null;
      };
      classListProto.contains = function (token) {
        token += "";
        return checkTokenAndGetIndex(this, token) !== -1;
      };
      classListProto.add = function () {
        var tokens = arguments,
            i = 0,
            l = tokens.length,
            token,
            updated = false;
        do {
          token = tokens[i] + "";
          if (checkTokenAndGetIndex(this, token) === -1) {
            this.push(token);
            updated = true;
          }
        } while (++i < l);

        if (updated) {
          this._updateClassName();
        }
      };
      classListProto.remove = function () {
        var tokens = arguments,
            i = 0,
            l = tokens.length,
            token,
            updated = false,
            index;
        do {
          token = tokens[i] + "";
          index = checkTokenAndGetIndex(this, token);
          while (index !== -1) {
            this.splice(index, 1);
            updated = true;
            index = checkTokenAndGetIndex(this, token);
          }
        } while (++i < l);

        if (updated) {
          this._updateClassName();
        }
      };
      classListProto.toggle = function (token, force) {
        token += "";

        var result = this.contains(token),
            method = result ? force !== true && "remove" : force !== false && "add";

        if (method) {
          this[method](token);
        }

        if (force === true || force === false) {
          return force;
        } else {
          return !result;
        }
      };
      classListProto.toString = function () {
        return this.join(" ");
      };

      if (objCtr.defineProperty) {
        var classListPropDesc = {
          get: classListGetter,
          enumerable: true,
          configurable: true
        };
        try {
          objCtr.defineProperty(elemCtrProto, classListProp, classListPropDesc);
        } catch (ex) {
          // IE 8 doesn't support enumerable:true
          if (ex.number === -0x7FF5EC54) {
            classListPropDesc.enumerable = false;
            objCtr.defineProperty(elemCtrProto, classListProp, classListPropDesc);
          }
        }
      } else if (objCtr[protoProp].__defineGetter__) {
        elemCtrProto.__defineGetter__(classListProp, classListGetter);
      }
    })(self);
  } else {
    // There is full or partial native classList support, so just check if we need
    // to normalize the add/remove and toggle APIs.

    (function () {
      "use strict";

      var testElement = document.createElement("_");

      testElement.classList.add("c1", "c2");

      // Polyfill for IE 10/11 and Firefox <26, where classList.add and
      // classList.remove exist but support only one argument at a time.
      if (!testElement.classList.contains("c2")) {
        var createMethod = function createMethod(method) {
          var original = DOMTokenList.prototype[method];

          DOMTokenList.prototype[method] = function (token) {
            var i,
                len = arguments.length;

            for (i = 0; i < len; i++) {
              token = arguments[i];
              original.call(this, token);
            }
          };
        };
        createMethod('add');
        createMethod('remove');
      }

      testElement.classList.toggle("c3", false);

      // Polyfill for IE 10 and Firefox <24, where classList.toggle does not
      // support the second argument.
      if (testElement.classList.contains("c3")) {
        var _toggle = DOMTokenList.prototype.toggle;

        DOMTokenList.prototype.toggle = function (token, force) {
          if (1 in arguments && !this.contains(token) === !force) {
            return force;
          } else {
            return _toggle.call(this, token);
          }
        };
      }

      testElement = null;
    })();
  }
}

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/utils/utils.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return coerce; });
/* harmony export (immutable) */ __webpack_exports__["c"] = getJSON;
/* harmony export (immutable) */ __webpack_exports__["d"] = getScrollBarWidth;
/* harmony export (immutable) */ __webpack_exports__["e"] = translations;
/* harmony export (immutable) */ __webpack_exports__["b"] = delayer;
/* unused harmony export VueFixer */
// coerce convert som types of data into another type
var coerce = {
  // Convert a string to booleam. Otherwise, return the value without modification, so if is not boolean, Vue throw a warning.
  boolean: function boolean(val) {
    return typeof val === 'string' ? val === '' || val === 'true' ? true : val === 'false' || val === 'null' || val === 'undefined' ? false : val : val;
  },
  // Attempt to convert a string value to a Number. Otherwise, return 0.
  number: function number(val) {
    var alt = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    return typeof val === 'number' ? val : val === undefined || val === null || isNaN(Number(val)) ? alt : Number(val);
  },
  // Attempt to convert to string any value, except for null or undefined.
  string: function string(val) {
    return val === undefined || val === null ? '' : val + '';
  },
  // Pattern accept RegExp, function, or string (converted to RegExp). Otherwise return null.
  pattern: function pattern(val) {
    return val instanceof Function || val instanceof RegExp ? val : typeof val === 'string' ? new RegExp(val) : null;
  }
};

function getJSON(url) {
  var request = new window.XMLHttpRequest();
  var data = {};
  // p (-simulated- promise)
  var p = {
    then: function then(fn1, fn2) {
      return p.done(fn1).fail(fn2);
    },
    catch: function _catch(fn) {
      return p.fail(fn);
    },
    always: function always(fn) {
      return p.done(fn).fail(fn);
    }
  };
  ['done', 'fail'].forEach(function (name) {
    data[name] = [];
    p[name] = function (fn) {
      if (fn instanceof Function) data[name].push(fn);
      return p;
    };
  });
  p.done(JSON.parse);
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      var e = { status: request.status };
      if (request.status === 200) {
        try {
          var response = request.responseText;
          for (var i in data.done) {
            var value = data.done[i](response);
            if (value !== undefined) {
              response = value;
            }
          }
        } catch (err) {
          data.fail.forEach(function (fail) {
            return fail(err);
          });
        }
      } else {
        data.fail.forEach(function (fail) {
          return fail(e);
        });
      }
    }
  };
  request.open('GET', url);
  request.setRequestHeader('Accept', 'application/json');
  request.send();
  return p;
}

function getScrollBarWidth() {
  if (document.documentElement.scrollHeight <= document.documentElement.clientHeight) {
    return 0;
  }
  var inner = document.createElement('p');
  inner.style.width = '100%';
  inner.style.height = '200px';

  var outer = document.createElement('div');
  outer.style.position = 'absolute';
  outer.style.top = '0px';
  outer.style.left = '0px';
  outer.style.visibility = 'hidden';
  outer.style.width = '200px';
  outer.style.height = '150px';
  outer.style.overflow = 'hidden';
  outer.appendChild(inner);

  document.body.appendChild(outer);
  var w1 = inner.offsetWidth;
  outer.style.overflow = 'scroll';
  var w2 = inner.offsetWidth;
  if (w1 === w2) w2 = outer.clientWidth;

  document.body.removeChild(outer);

  return w1 - w2;
}

// return all the translations or the default language (english)
function translations() {
  var lang = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'en';

  var text = {
    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    limit: 'Limit reached ({{limit}} items max).',
    loading: 'Loading...',
    minLength: 'Min. Length',
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    notSelected: 'Nothing Selected',
    required: 'Required',
    search: 'Search',
    selected: '{{count}} selected'
  };
  return window.VueStrapLang ? window.VueStrapLang(lang) : text;
}

// delayer: set a function that execute after a delay
// @params (function, delay_prop or value, default_value)
function delayer(fn, varTimer) {
  var ifNaN = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 100;

  function toInt(el) {
    return (/^[0-9]+$/.test(el) ? Number(el) || 1 : null
    );
  }
  var timerId;
  return function () {
    var _this = this;

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    if (timerId) clearTimeout(timerId);
    timerId = setTimeout(function () {
      fn.apply(_this, args);
    }, toInt(varTimer) || toInt(this[varTimer]) || ifNaN);
  };
}

// Fix a vue instance Lifecycle to vue 1/2 (just the basic elements, is not a real parser, so this work only if your code is compatible with both)
// (Waiting for testing)
function VueFixer(vue) {
  var vue2 = !window.Vue || !window.Vue.partial;
  var mixin = {
    computed: {
      vue2: function vue2() {
        return !this.$dispatch;
      }
    }
  };
  if (!vue2) {
    //translate vue2 attributes to vue1
    if (vue.beforeCreate) {
      mixin.create = vue.beforeCreate;
      delete vue.beforeCreate;
    }
    if (vue.beforeMount) {
      vue.beforeCompile = vue.beforeMount;
      delete vue.beforeMount;
    }
    if (vue.mounted) {
      vue.ready = vue.mounted;
      delete vue.mounted;
    }
  } else {
    //translate vue1 attributes to vue2
    if (vue.beforeCompile) {
      vue.beforeMount = vue.beforeCompile;
      delete vue.beforeCompile;
    }
    if (vue.compiled) {
      mixin.compiled = vue.compiled;
      delete vue.compiled;
    }
    if (vue.ready) {
      vue.mounted = vue.ready;
      delete vue.ready;
    }
  }
  if (!vue.mixins) {
    vue.mixins = [];
  }
  vue.mixins.unshift(mixin);
  return vue;
}

/***/ })

});