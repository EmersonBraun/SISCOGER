webpackJsonp([69],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/ToggleButton.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/utils/utils.js");
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
    disabled: { default: null },
    falseType: { default: null },
    name: null,
    readonly: { default: null },
    trueType: { default: 'primary' },
    value: false
  },
  data: function data() {
    return {
      active: __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["a" /* coerce */].boolean(this.value),
      types: {
        danger: 'btn-danger',
        info: 'btn-info',
        primary: 'btn-primary',
        success: 'btn-success',
        warning: 'btn-warning'
      }
    };
  },

  watch: {
    active: function active(val, old) {
      if (val !== old) {
        this.$emit('changed', val);
        this.$emit(val ? 'enabled' : 'disabled');
        this.$emit('input', val);
      }
    },
    value: function value(val, old) {
      if (val !== old) {
        this.active = __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["a" /* coerce */].boolean(this.value);
      }
    }
  },
  computed: {
    boolDisabled: function boolDisabled() {
      return __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["a" /* coerce */].boolean(this.disabled);
    },
    boolReadonly: function boolReadonly() {
      return __WEBPACK_IMPORTED_MODULE_0__utils_utils_js__["a" /* coerce */].boolean(this.readonly);
    },
    type: function type() {
      return this.types[this.value ? this.trueType : this.falseType] || 'btn-default';
    }
  },
  methods: {
    toggle: function toggle() {
      if (this.boolDisabled || this.boolReadonly) {
        return;
      }
      this.active = !this.active;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-b7e72798\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/ToggleButton.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "a",
    {
      class: ["btn", _vm.type, { readonly: _vm.boolReadonly }],
      attrs: { href: "javascript:void(0)", disabled: _vm.boolDisabled },
      on: { click: _vm.toggle }
    },
    [
      _c("span", {
        class: ["glyphicon", "glyphicon-" + (_vm.value ? "ok" : "remove")]
      }),
      _vm._v(" "),
      _vm._t("default"),
      _vm._v(" "),
      _vm.name
        ? _c("input", {
            attrs: { type: "hidden", name: _vm.name },
            domProps: { value: _vm.active ? 1 : 0 }
          })
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
    require("vue-hot-reload-api")      .rerender("data-v-b7e72798", module.exports)
  }
}

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/ToggleButton.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/ToggleButton.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-b7e72798\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/ToggleButton.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
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
Component.options.__file = "resources/assets/js/components/Vuestrap/ToggleButton.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b7e72798", Component.options)
  } else {
    hotAPI.reload("data-v-b7e72798", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


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