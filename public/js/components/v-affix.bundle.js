webpackJsonp([77],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Affix.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__directives_Scroll_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/directives/Scroll.js");
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  directives: {
    Scroll: __WEBPACK_IMPORTED_MODULE_0__directives_Scroll_js__["a" /* default */]
  },
  props: {
    offset: {
      type: Number,
      default: 0
    }
  },
  data: function data() {
    return {
      affixed: false
    };
  },

  computed: {
    top: function top() {
      return this.offset > 0 ? this.offset + 'px' : null;
    }
  },
  methods: {
    // from https://github.com/ant-design/ant-design/blob/master/components/affix/index.jsx#L20
    checkScroll: function checkScroll() {
      // if is hidden don't calculate anything
      if (!(this.$el.offsetWidth || this.$el.offsetHeight || this.$el.getClientRects().length)) {
        return;
      }
      // get window scroll and element position to detect if have to be normal or affixed
      var scroll = {};
      var element = {};
      var rect = this.$el.getBoundingClientRect();
      var body = document.body;
      var _arr = ['Top', 'Left'];
      for (var _i = 0; _i < _arr.length; _i++) {
        var type = _arr[_i];
        var t = type.toLowerCase();
        var ret = window['page' + (type === 'Top' ? 'Y' : 'X') + 'Offset'];
        var method = 'scroll' + type;
        if (typeof ret !== 'number') {
          // ie6,7,8 standard mode
          ret = document.documentElement[method];
          if (typeof ret !== 'number') {
            // quirks mode
            ret = document.body[method];
          }
        }
        scroll[t] = ret;
        element[t] = scroll[t] + rect[t] - (this.$el['client' + type] || body['client' + type] || 0);
      }
      var fix = scroll.top > element.top - this.offset;
      if (this.affixed !== fix) {
        this.affixed = fix;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-95ebaf9c\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Affix.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "hidden-print hidden-xs hidden-sm" }, [
    _c(
      "nav",
      {
        directives: [
          {
            name: "scroll",
            rawName: "v-scroll",
            value: _vm.checkScroll,
            expression: "checkScroll"
          }
        ],
        staticClass: "bs-docs-sidebar",
        class: { affix: _vm.affixed },
        style: { marginTop: _vm.top }
      },
      [_vm._t("default")],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-95ebaf9c", module.exports)
  }
}

/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Affix.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Affix.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-95ebaf9c\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Affix.vue")
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Affix.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-95ebaf9c", Component.options)
  } else {
    hotAPI.reload("data-v-95ebaf9c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/directives/Scroll.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * Click outside directive
 */
var HANDLER = '_vue_scroll_handler';
var events = ['resize', 'scroll'];

function bind(el, binding) {
  unbind(el);

  var callback = binding.value;
  if (typeof callback !== 'function') {
    if (true) {
      Vue.util.warn('ClickOutside only work with a function value, received: v-' + binding.name + '="' + binding.expression + '"');
    }
  } else {
    el[HANDLER] = function (e) {
      callback(e);
    };
    events.forEach(function (e) {
      window.addEventListener(e, el[HANDLER], false);
    });
    document.addEventListener('load', el[HANDLER], false);
    setTimeout(function () {
      el[HANDLER]();
    }, 0);
  }
}

function unbind(el) {
  events.forEach(function (e) {
    window.removeEventListener(e, el[HANDLER], false);
  });
  document.removeEventListener('load', el[HANDLER], false);
  delete el[HANDLER];
}

/* harmony default export */ __webpack_exports__["a"] = ({
  bind: bind,
  unbind: unbind,
  update: function update(el, binding) {
    if (binding.value !== binding.oldValue) bind(el, binding);
  }
});

/***/ })

});