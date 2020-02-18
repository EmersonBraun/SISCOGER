webpackJsonp([19],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Select.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_strap_src_utils_utils_js__ = __webpack_require__("./node_modules/vue-strap/src/utils/utils.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_strap_src_directives_ClickOutside_js__ = __webpack_require__("./node_modules/vue-strap/src/directives/ClickOutside.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




var timeout = {};
/* harmony default export */ __webpack_exports__["default"] = ({
  directives: {
    ClickOutside: __WEBPACK_IMPORTED_MODULE_1_vue_strap_src_directives_ClickOutside_js__["a" /* default */]
  },
  props: {
    title: { type: String, default: null },
    pre: { type: Boolean, default: false },
    //clearButton: {type: Boolean, default: false},
    clearButton: { type: Boolean, default: true },
    //closeOnSelect: {type: Boolean, default: false},
    closeOnSelect: { type: Boolean, default: true },
    disabled: { type: Boolean, default: false },
    lang: 'pt-br',
    limit: { type: Number, default: 1024 },
    minSearch: { type: Number, default: 0 },
    multiple: { type: Boolean, default: false },
    name: { type: String, default: null },
    options: { type: Array, default: function _default() {
        return [];
      }
    },
    optionsLabel: { type: String, default: 'label' },
    optionsValue: { type: String, default: 'val' },
    parent: { default: true },
    //placeholder: {type: String, default: null},
    placeholder: { type: String, default: 'Selecione' },
    readonly: { type: Boolean, default: null },
    required: { type: Boolean, default: null },
    //search: {type: Boolean, default: false},
    search: { type: Boolean, default: true },
    searchText: 'Buscar',
    countText: { type: String, default: null },
    showCount: { type: Boolean, default: false },
    url: { type: String, default: null },
    value: null
  },
  data: function data() {
    return {
      list: [],
      loading: null,
      searchValue: null,
      show: false,
      notify: false,
      val: null,
      valid: null
    };
  },

  computed: {
    canSearch: function canSearch() {
      return this.minSearch ? this.list.length >= this.minSearch : this.search;
    },
    classes: function classes() {
      return [{ open: this.show, disabled: this.disabled }, this.class, this.isLi ? 'dropdown' : this.inInput ? 'input-group-btn' : 'btn-group'];
    },
    filteredOptions: function filteredOptions() {
      var _this = this;

      var search = (this.searchValue || '').toLowerCase();
      return !search ? this.list : this.list.filter(function (el) {
        return ~el[_this.optionsLabel].toLowerCase().search(search);
      });
    },
    hasParent: function hasParent() {
      return this.parent instanceof Array ? this.parent.length : this.parent;
    },
    inInput: function inInput() {
      return this.$parent._input;
    },
    isLi: function isLi() {
      return this.$parent._navbar || this.$parent.menu || this.$parent._tabset;
    },
    limitText: function limitText() {
      return this.text.limit.replace('{{limit}}', this.limit);
    },
    selected: function selected() {
      var _this2 = this;

      if (this.list.length === 0) {
        return '';
      }
      var sel = this.values.map(function (val) {
        return (_this2.list.find(function (o) {
          return o[_this2.optionsValue] === val;
        }) || {})[_this2.optionsLabel];
      }).filter(function (val) {
        return val !== undefined;
      });
      this.$emit('selected', sel);
      return sel.join(', ');
    },
    selectedText: function selectedText() {
      return this.countText || this.text.selected.replace('{{count}}', this.values.length);
    },
    showPlaceholder: function showPlaceholder() {
      return this.values.length === 0 || !this.hasParent ? this.placeholder || this.text.notSelected : null;
    },
    text: function text() {
      return Object(__WEBPACK_IMPORTED_MODULE_0_vue_strap_src_utils_utils_js__["a" /* translations */])(this.lang);
    },
    values: function values() {
      return this.val instanceof Array ? this.val : ~[null, undefined].indexOf(this.val) ? [] : [this.val];
    },
    valOptions: function valOptions() {
      var _this3 = this;

      return this.list.map(function (el) {
        return el[_this3.optionsValue];
      });
    }
  },
  watch: {
    options: function options(_options) {
      if (_options instanceof Array) this.setOptions(_options);
    },
    show: function show(val) {
      if (val) {
        this.$refs.search ? this.$refs.search.focus() : this.$refs.btn.focus();
        // onBlur(this.$refs.select, e => { this.show = false })
      } else {
          // offBlur(this.$refs.select)
        }
    },
    url: function url() {
      this.urlChanged();
    },
    valid: function valid(val, old) {
      this.$emit('isvalid', val);
      this.$emit(!val ? 'invalid' : 'valid');
      if (val !== old && this._parent) this._parent.validate();
    },
    value: function value(val, old) {
      if (val !== old) {
        this.val = val;
      }
    },
    val: function val(_val, old) {
      var _this4 = this;

      if (_val === undefined) {
        this.val = _val = null;
      }
      if (_val !== old) {
        this.$emit('change', _val);
        this.$emit('input', _val);
      }
      if (_val instanceof Array && _val.length > this.limit) {
        this.val = _val.slice(0, this.limit);
        this.notify = true;
        if (timeout.limit) clearTimeout(timeout.limit);
        timeout.limit = setTimeout(function () {
          timeout.limit = false;
          _this4.notify = false;
        }, 1500);
      }
      this.valid = this.validate();
    }
  },
  methods: {
    close: function close() {
      this.show = false;
    },
    checkData: function checkData() {
      if (this.multiple) {
        if (this.limit < 1) {
          this.limit = 1;
        }
        if (!(this.val instanceof Array)) {
          this.val = this.val === null || this.val === undefined ? [] : [this.val];
        }
        var values = this.valOptions;
        this.val = this.val.filter(function (el) {
          return ~values.indexOf(el);
        });
        if (this.values.length > this.limit) {
          this.val = this.val.slice(0, this.limit);
        }
      } else {
        if (!~this.valOptions.indexOf(this.val)) {
          this.val = null;
        }
      }
    },
    clear: function clear() {
      if (this.disabled || this.readonly) {
        return;
      }
      this.val = this.val instanceof Array ? [] : null;
      this.toggle();
    },
    clearSearch: function clearSearch() {
      this.searchValue = '';
      this.$refs.search.focus();
    },
    isSelected: function isSelected(v) {
      return this.values.indexOf(v) > -1;
    },
    select: function select(v) {
      if (this.val instanceof Array) {
        var newVal = this.val.slice(0);
        if (~newVal.indexOf(v)) {
          newVal.splice(newVal.indexOf(v), 1);
        } else {
          newVal.push(v);
        }
        this.val = newVal;
        if (this.closeOnSelect) {
          this.toggle();
        }
      } else {
        this.val = v;
        this.toggle();
      }
    },
    setOptions: function setOptions(options) {
      var _this5 = this;

      this.list = options.map(function (el) {
        if (el instanceof Object) {
          return el;
        }
        var obj = {};
        obj[_this5.optionsLabel] = el;
        obj[_this5.optionsValue] = el;
        return obj;
      });
      this.$emit('options', this.list);
    },
    toggle: function toggle() {
      if (this.disabled && !this.show) return;
      this.show = !this.show;
      if (!this.show) this.$refs.btn.focus();
    },
    urlChanged: function urlChanged() {
      var _this6 = this;

      if (!this.url || !this.$http) {
        return;
      }
      this.loading = true;
      this.$http.get(this.url).then(function (response) {
        var data = response.data instanceof Array ? response.data : [];
        try {
          data = JSON.parse(data);
        } catch (e) {}
        _this6.setOptions(data);
        _this6.loading = false;
        _this6.checkData();
      }, function (response) {
        _this6.loading = false;
      });
    },
    validate: function validate() {
      return !this.required ? true : this.val instanceof Array ? this.val.length > 0 : this.val !== null;
    }
  },
  created: function created() {
    this.setOptions(this.options);
    this.val = this.value;
    this._select = true;
    if (this.val === undefined || !this.parent) {
      this.val = null;
    }
    if (!this.multiple && this.val instanceof Array) {
      this.val = this.val[0];
    }
    this.checkData();
    if (this.url) this.urlChanged();
    var parent = this.$parent;
    while (parent && !parent._formValidator) {
      parent = parent.$parent;
    }
    if (parent && parent._formValidator) {
      parent.children.push(this);
      this._parent = parent;
    }
  },
  mounted: function mounted() {
    if (this._parent) this._parent.children.push(this);
    this.setOptions(this.options);
    this.val = this.value;
    this.checkData();
  },
  beforeDestroy: function beforeDestroy() {
    if (this._parent) {
      var index = this._parent.children.indexOf(this);
      this._parent.children.splice(index, 1);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Select.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.form-control.dropdown-toggle[data-v-00b2770a]{\n  height: auto;\n  padding-right: 24px;\n}\n.form-control.dropdown-toggle[data-v-00b2770a]:after{\n  content: ' ';\n  position: absolute;\n  right: 13px;\n  top: 50%;\n  margin: -1px 0 0;\n  border-top: 4px dashed;\n  border-top: 4px solid \\9;\n  border-right: 4px solid transparent;\n  border-left: 4px solid transparent;\n}\n.bs-searchbox[data-v-00b2770a] {\n  position: relative;\n  margin: 4px 8px;\n}\n.bs-searchbox .close[data-v-00b2770a] {\n  position: absolute;\n  top: 0;\n  right: 0;\n  z-index: 2;\n  display: block;\n  width: 34px;\n  height: 34px;\n  line-height: 34px;\n  text-align: center;\n}\n.bs-searchbox input[data-v-00b2770a]:focus,\n.form-control.dropdown-toggle[data-v-00b2770a]:focus {\n  outline: 0;\n  border-color: #66afe9 !important;\n  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);\n}\n.secret[data-v-00b2770a] {\n  border: 0;\n  clip: rect(0 0 0 0);\n  height: 1px;\n  margin: -1px;\n  overflow: hidden;\n  padding: 0;\n  position: absolute;\n  width: 1px;\n}\n.form-control.dropdown-toggle>.close[data-v-00b2770a] { margin-left: 5px;\n}\n.notify.out[data-v-00b2770a] { position: relative;\n}\n.notify.in[data-v-00b2770a],\n.notify>div[data-v-00b2770a] {\n  position: absolute;\n  width: 96%;\n  margin: 0 2%;\n  min-height: 26px;\n  padding: 3px 5px;\n  background: #f5f5f5;\n  border: 1px solid #e3e3e3;\n  box-shadow: inset 0 1px 1px rgba(0,0,0,.05);\n  pointer-events: none;\n}\n.notify>div[data-v-00b2770a] {\n  top: 5px;\n  z-index: 1;\n}\n.notify.in[data-v-00b2770a] {\n  opacity: .9;\n  bottom: 5px;\n}\n.btn-group-justified .dropdown-toggle>span[data-v-00b2770a]:not(.close) {\n  width: calc(100% - 18px);\n  display: inline-block;\n  overflow: hidden;\n  white-space: nowrap;\n  text-overflow: ellipsis;\n  margin-bottom: -4px;\n}\n.btn-group-justified .dropdown-menu[data-v-00b2770a] { width: 100%;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00b2770a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Select.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-4 col-md-6 col-xs-12 form-group" }, [
    _vm.title
      ? _c("label", { attrs: { for: _vm.name } }, [_vm._v(_vm._s(_vm.title))])
      : _vm._e(),
    _c("br"),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "click-outside",
            rawName: "v-click-outside",
            value: _vm.close,
            expression: "close"
          }
        ],
        ref: "select",
        staticClass: "form-control",
        class: _vm.classes
      },
      [
        _c(
          "div",
          {
            ref: "btn",
            attrs: {
              tabindex: "1",
              disabled: _vm.disabled || !_vm.hasParent,
              readonly: _vm.readonly
            },
            on: {
              blur: function($event) {
                _vm.canSearch ? null : _vm.close()
              },
              click: function($event) {
                return _vm.toggle()
              },
              keydown: [
                function($event) {
                  if (
                    !$event.type.indexOf("key") &&
                    _vm._k($event.keyCode, "esc", 27, $event.key, [
                      "Esc",
                      "Escape"
                    ])
                  ) {
                    return null
                  }
                  $event.stopPropagation()
                  $event.preventDefault()
                  return _vm.close($event)
                },
                function($event) {
                  if (
                    !$event.type.indexOf("key") &&
                    _vm._k($event.keyCode, "space", 32, $event.key, [
                      " ",
                      "Spacebar"
                    ])
                  ) {
                    return null
                  }
                  $event.stopPropagation()
                  $event.preventDefault()
                  return _vm.toggle($event)
                },
                function($event) {
                  if (
                    !$event.type.indexOf("key") &&
                    _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                  ) {
                    return null
                  }
                  $event.stopPropagation()
                  $event.preventDefault()
                  return _vm.toggle($event)
                }
              ]
            }
          },
          [
            _c("span", {
              staticClass: "btn-content",
              domProps: {
                innerHTML: _vm._s(
                  _vm.loading
                    ? _vm.text.loading
                    : _vm.showPlaceholder ||
                        (_vm.multiple && _vm.showCount
                          ? _vm.selectedText
                          : _vm.selected)
                )
              }
            }),
            _vm._v(" "),
            _vm.clearButton && _vm.values.length
              ? _c(
                  "span",
                  {
                    staticClass: "close",
                    on: {
                      click: function($event) {
                        return _vm.clear()
                      }
                    }
                  },
                  [_vm._v("×")]
                )
              : _c("span", { staticClass: "close" }, [
                  _c("i", { staticClass: "fa fa-angle-double-down" })
                ])
          ]
        ),
        _vm._v(" "),
        _c(
          "select",
          {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.val,
                expression: "val"
              }
            ],
            ref: "sel",
            staticClass: "secret",
            attrs: {
              name: _vm.name,
              multiple: _vm.multiple,
              required: _vm.required,
              readonly: _vm.readonly,
              disabled: _vm.disabled
            },
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
                _vm.val = $event.target.multiple
                  ? $$selectedVal
                  : $$selectedVal[0]
              }
            }
          },
          [
            _vm.required ? _c("option", { attrs: { value: "" } }) : _vm._e(),
            _vm._v(" "),
            _vm._l(_vm.list, function(option) {
              return _c(
                "option",
                { domProps: { value: option[_vm.optionsValue] } },
                [_vm._v(_vm._s(option[_vm.optionsLabel]))]
              )
            })
          ],
          2
        ),
        _vm._v(" "),
        _c(
          "ul",
          { staticClass: "dropdown-menu" },
          [
            _vm.list.length
              ? [
                  _vm.canSearch
                    ? _c("li", { staticClass: "bs-searchbox" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.searchValue,
                              expression: "searchValue"
                            }
                          ],
                          ref: "search",
                          staticClass: "form-control",
                          attrs: {
                            type: "text",
                            placeholder: "Buscar",
                            autocomplete: "off"
                          },
                          domProps: { value: _vm.searchValue },
                          on: {
                            keyup: function($event) {
                              if (
                                !$event.type.indexOf("key") &&
                                _vm._k($event.keyCode, "esc", 27, $event.key, [
                                  "Esc",
                                  "Escape"
                                ])
                              ) {
                                return null
                              }
                              return _vm.close($event)
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.searchValue = $event.target.value
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c(
                          "span",
                          {
                            directives: [
                              {
                                name: "show",
                                rawName: "v-show",
                                value: _vm.searchValue,
                                expression: "searchValue"
                              }
                            ],
                            staticClass: "close",
                            on: { click: _vm.clearSearch }
                          },
                          [_vm._v("×")]
                        )
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.required && !_vm.clearButton
                    ? _c("li", [
                        _c(
                          "a",
                          {
                            on: {
                              mousedown: function($event) {
                                $event.preventDefault()
                                _vm.clear() && _vm.close()
                              }
                            }
                          },
                          [
                            _vm._v(
                              _vm._s(_vm.placeholder || _vm.text.notSelected)
                            )
                          ]
                        )
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _vm._l(_vm.filteredOptions, function(option) {
                    return _c(
                      "li",
                      { attrs: { id: option[_vm.optionsValue] } },
                      [
                        _c(
                          "a",
                          {
                            on: {
                              mousedown: function($event) {
                                $event.preventDefault()
                                return _vm.select(option[_vm.optionsValue])
                              }
                            }
                          },
                          [
                            _c("span", {
                              domProps: {
                                innerHTML: _vm._s(option[_vm.optionsLabel])
                              }
                            }),
                            _vm._v(" "),
                            _c("span", {
                              directives: [
                                {
                                  name: "show",
                                  rawName: "v-show",
                                  value: _vm.isSelected(
                                    option[_vm.optionsValue]
                                  ),
                                  expression: "isSelected(option[optionsValue])"
                                }
                              ],
                              staticClass: "glyphicon glyphicon-ok check-mark"
                            })
                          ]
                        )
                      ]
                    )
                  })
                ]
              : _vm._e(),
            _vm._v(" "),
            _vm._t("default"),
            _vm._v(" "),
            _vm.notify && !_vm.closeOnSelect
              ? _c("transition", { attrs: { name: "fadein" } }, [
                  _c("div", { staticClass: "notify in" }, [
                    _vm._v(_vm._s(_vm.limitText))
                  ])
                ])
              : _vm._e()
          ],
          2
        ),
        _vm._v(" "),
        _vm.notify && _vm.closeOnSelect
          ? _c("transition", { attrs: { name: "fadein" } }, [
              _c("div", { staticClass: "notify out" }, [
                _c("div", [_vm._v(_vm._s(_vm.limitText))])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.pre ? _c("pre", [_vm._v("Options: " + _vm._s(_vm.list))]) : _vm._e()
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-00b2770a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-strap/src/directives/ClickOutside.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * Click outside directive
 */
var binded = []

function handler (e) { binded.forEach(el => { if (!el.node.contains(e.target)) el.callback(e) }) }

function addListener (node, callback) {
  if (!binded.length) document.addEventListener('click', handler, false)
  binded.push({node, callback})
}

function removeListener (node, callback) {
  binded = binded.filter(el => el.node !== node ? true : !callback ? false : el.callback !== callback)
  if (!binded.length) document.removeEventListener('click', handler, false)
}

/* harmony default export */ __webpack_exports__["a"] = ({
  bind (el, binding) {
    removeListener(el, binding.value)
    if (typeof binding.value !== 'function') {
      if (true) {
        Vue.util.warn('ClickOutside only work with a function, received: v-' + binding.name + '="' + binding.expression + '"')
      }
    } else {
      addListener(el, binding.value)
    }
  },
  update (el, binding) {
    if (binding.value !== binding.oldValue){
      removeListener(el, binding.oldValue)
      addListener(el, binding.value)
    }
  },
  unbind (el, binding) {
    removeListener(el, binding.value)
  }
});


/***/ }),

/***/ "./node_modules/vue-strap/src/utils/utils.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* unused harmony export getJSON */
/* unused harmony export getScrollBarWidth */
/* harmony export (immutable) */ __webpack_exports__["a"] = translations;
/* unused harmony export delayer */
/* unused harmony export VueFixer */
// coerce convert som types of data into another type
const coerce = {
  // Convert a string to booleam. Otherwise, return the value without modification, so if is not boolean, Vue throw a warning.
  boolean: val => (typeof val === 'string' ? val === '' || val === 'true' ? true : (val === 'false' || val === 'null' || val === 'undefined' ? false : val) : val),
  // Attempt to convert a string value to a Number. Otherwise, return 0.
  number: (val, alt = null) => (typeof val === 'number' ? val : val === undefined || val === null || isNaN(Number(val)) ? alt : Number(val)),
  // Attempt to convert to string any value, except for null or undefined.
  string: val => (val === undefined || val === null ? '' : val + ''),
  // Pattern accept RegExp, function, or string (converted to RegExp). Otherwise return null.
  pattern: val => (val instanceof Function || val instanceof RegExp ? val : typeof val === 'string' ? new RegExp(val) : null)
}
/* unused harmony export coerce */


function getJSON (url) {
  var request = new window.XMLHttpRequest()
  var data = {}
  // p (-simulated- promise)
  var p = {
    then (fn1, fn2) { return p.done(fn1).fail(fn2) },
    catch (fn) { return p.fail(fn) },
    always (fn) { return p.done(fn).fail(fn) }
  };
  ['done', 'fail'].forEach(name => {
    data[name] = []
    p[name] = (fn) => {
      if (fn instanceof Function) data[name].push(fn)
      return p
    }
  })
  p.done(JSON.parse)
  request.onreadystatechange = () => {
    if (request.readyState === 4) {
      let e = {status: request.status}
      if (request.status === 200) {
        try {
          var response = request.responseText
          for (var i in data.done) {
            var value = data.done[i](response)
            if (value !== undefined) { response = value }
          }
        } catch (err) {
          data.fail.forEach(fail => fail(err))
        }
      } else {
        data.fail.forEach(fail => fail(e))
      }
    }
  }
  request.open('GET', url)
  request.setRequestHeader('Accept', 'application/json')
  request.send()
  return p
}

function getScrollBarWidth () {
  if (document.documentElement.scrollHeight <= document.documentElement.clientHeight) {
    return 0
  }
  let inner = document.createElement('p')
  inner.style.width = '100%'
  inner.style.height = '200px'

  let outer = document.createElement('div')
  outer.style.position = 'absolute'
  outer.style.top = '0px'
  outer.style.left = '0px'
  outer.style.visibility = 'hidden'
  outer.style.width = '200px'
  outer.style.height = '150px'
  outer.style.overflow = 'hidden'
  outer.appendChild(inner)

  document.body.appendChild(outer)
  let w1 = inner.offsetWidth
  outer.style.overflow = 'scroll'
  let w2 = inner.offsetWidth
  if (w1 === w2) w2 = outer.clientWidth

  document.body.removeChild(outer)

  return (w1 - w2)
}

// return all the translations or the default language (english)
function translations (lang = 'en') {
  let text = {
    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    limit: 'Limit reached ({{limit}} items max).',
    loading: 'Loading...',
    minLength: 'Min. Length',
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    notSelected: 'Nothing Selected',
    required: 'Required',
    search: 'Search',
    selected: '{{count}} selected'
  }
  return window.VueStrapLang ? window.VueStrapLang(lang) : text
}

// delayer: set a function that execute after a delay
// @params (function, delay_prop or value, default_value)
function delayer (fn, varTimer, ifNaN = 100) {
  function toInt (el) { return /^[0-9]+$/.test(el) ? Number(el) || 1 : null }
  var timerId
  return function (...args) {
    if (timerId) clearTimeout(timerId)
    timerId = setTimeout(() => {
      fn.apply(this, args)
    }, toInt(varTimer) || toInt(this[varTimer]) || ifNaN)
  }
}

// Fix a vue instance Lifecycle to vue 1/2 (just the basic elements, is not a real parser, so this work only if your code is compatible with both)
// (Waiting for testing)
function VueFixer (vue) {
  var vue2 = !window.Vue || !window.Vue.partial
  var mixin = {
    computed: {
      vue2 () { return !this.$dispatch }
    }
  }
  if (!vue2) {
    //translate vue2 attributes to vue1
    if (vue.beforeCreate) {
      mixin.create = vue.beforeCreate
      delete vue.beforeCreate
    }
    if (vue.beforeMount) {
      vue.beforeCompile = vue.beforeMount
      delete vue.beforeMount
    }
    if (vue.mounted) {
      vue.ready = vue.mounted
      delete vue.mounted
    }
  } else {
    //translate vue1 attributes to vue2
    if (vue.beforeCompile) {
      vue.beforeMount = vue.beforeCompile
      delete vue.beforeCompile
    }
    if (vue.compiled) {
      mixin.compiled = vue.compiled
      delete vue.compiled
    }
    if (vue.ready) {
      vue.mounted = vue.ready
      delete vue.ready
    }
  }
  if (!vue.mixins) { vue.mixins = [] }
  vue.mixins.unshift(mixin)
  return vue
}


/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Select.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Select.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("29371206", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Select.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Select.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Select.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00b2770a\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Select.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Select.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00b2770a\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Select.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-00b2770a"
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Select.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-00b2770a", Component.options)
  } else {
    hotAPI.reload("data-v-00b2770a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});