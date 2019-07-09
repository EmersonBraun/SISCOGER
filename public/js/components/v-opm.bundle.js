webpackJsonp([19],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/OPM.vue":
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
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['cdopm'],
    data: function data() {
        return {
            opm: this.cdopm
        };
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/OPM.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/lib/css-base.js":
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/vue-loader/lib/component-normalizer.js":
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-6599cb78\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/OPM.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "select",
      {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.cdopm,
            expression: "cdopm"
          }
        ],
        staticClass: "form-control",
        attrs: { name: "cdopm" },
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
            _vm.cdopm = $event.target.multiple
              ? $$selectedVal
              : $$selectedVal[0]
          }
        }
      },
      [
        _c("option", { attrs: { value: "" } }, [_vm._v("Todas as OPM")]),
        _vm._v(" "),
        _vm._m(0),
        _vm._v(" "),
        _vm._m(1),
        _vm._v(" "),
        _vm._m(2),
        _vm._v(" "),
        _vm._m(3),
        _vm._v(" "),
        _vm._m(4),
        _vm._v(" "),
        _vm._m(5),
        _vm._v(" "),
        _vm._m(6),
        _vm._v(" "),
        _vm._m(7),
        _vm._v(" "),
        _vm._m(8),
        _vm._v(" "),
        _vm._m(9)
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "CG" } }, [
      _c("option", { attrs: { value: "0" } }, [_vm._v("CG (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "001" } }, [_vm._v("CG/GAB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "001013" } }, [_vm._v("AG/CCS")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "002" } }, [_vm._v("CG/CJ")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "006" } }, [_vm._v("CM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "SUBCG" } }, [
      _c("option", { attrs: { value: "010" } }, [_vm._v("SUBCG (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "020" } }, [_vm._v("COGER")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "030" } }, [_vm._v("BPRV")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "031" } }, [_vm._v("BPAMBFV")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "036" } }, [_vm._v("BPEC")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "037" } }, [_vm._v("BOPE")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "038" } }, [_vm._v("COPOM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "039" } }, [_vm._v("BPM OA")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "040" } }, [_vm._v("COORTERRA")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "EM" } }, [
      _c("option", { attrs: { value: "1" } }, [_vm._v("EM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "101" } }, [_vm._v("PM1")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "102" } }, [_vm._v("PM2")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "103" } }, [_vm._v("PM3")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "104" } }, [_vm._v("PM4")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "105" } }, [_vm._v("PM5")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "106" } }, [_vm._v("PM6")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "110" } }, [_vm._v("DP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11000009" } }, [_vm._v("DP/SESP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "111" } }, [_vm._v("APMG")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105403" } }, [_vm._v("APMG/ESO")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105404" } }, [_vm._v("APMG/1ESFAEP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105405" } }, [_vm._v("APMG/2ESFAEP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11108" } }, [_vm._v("2COLEGIO/PMPR")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "112" } }, [_vm._v("DAL")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "113" } }, [_vm._v("DF")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "114" } }, [_vm._v("DDTQ")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "115" } }, [_vm._v("DS")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11502" } }, [_vm._v("HPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "1CRPM" } }, [
      _c("option", { attrs: { value: "2" } }, [_vm._v("1CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "212" } }, [_vm._v("12BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "213" } }, [_vm._v("13BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "220" } }, [_vm._v("RPMON")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "221" } }, [_vm._v("CIPG")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "223" } }, [_vm._v("20BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "225" } }, [_vm._v("BPTRAN")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "233" } }, [_vm._v("23BPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "2CRPM" } }, [
      _c("option", { attrs: { value: "3" } }, [_vm._v("2CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "302" } }, [_vm._v("2BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "305" } }, [_vm._v("5BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "306" } }, [_vm._v("6CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "307" } }, [_vm._v("7CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "310" } }, [_vm._v("10BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "315" } }, [_vm._v("15BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "318" } }, [_vm._v("18BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "335" } }, [_vm._v("4CIPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "3CRPM" } }, [
      _c("option", { attrs: { value: "4" } }, [_vm._v("3CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "404" } }, [_vm._v("4BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "407" } }, [_vm._v("7BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "408" } }, [_vm._v("8BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "411" } }, [_vm._v("11BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "438" } }, [_vm._v("5CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "439" } }, [_vm._v("9CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "440" } }, [_vm._v("25BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "443" } }, [_vm._v("3CIPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "4CRPM" } }, [
      _c("option", { attrs: { value: "5" } }, [_vm._v("4CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "501" } }, [_vm._v("1BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "516" } }, [_vm._v("16BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "526" } }, [_vm._v("26BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "527" } }, [_vm._v("27BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "532" } }, [_vm._v("1CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "535" } }, [_vm._v("8CIPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "545" } }, [_vm._v("28BPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "5CRPM" } }, [
      _c("option", { attrs: { value: "6" } }, [_vm._v("5CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "603" } }, [_vm._v("3BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "606" } }, [_vm._v("6BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "614" } }, [_vm._v("14BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "619" } }, [_vm._v("19BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "621" } }, [_vm._v("21BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "624" } }, [_vm._v("BPFRON")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "6CRPM" } }, [
      _c("option", { attrs: { value: "7" } }, [_vm._v("6CRPM (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "701" } }, [_vm._v("OPVMATINHOS")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "702" } }, [_vm._v("OPVPONTAL")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "703" } }, [_vm._v("OPVGUARA")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "705" } }, [_vm._v("BPGD")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "709" } }, [_vm._v("9BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "717" } }, [_vm._v("17BPM")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "722" } }, [_vm._v("22BPM")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "CCB" } }, [
      _c("option", { attrs: { value: "9" } }, [_vm._v("CCB (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "90000008" } }, [_vm._v("GOST")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "901" } }, [_vm._v("1GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "902" } }, [_vm._v("2GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "903" } }, [_vm._v("3GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "904" } }, [_vm._v("4GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "905" } }, [_vm._v("5GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "906" } }, [_vm._v("6GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "907" } }, [_vm._v("7GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "908" } }, [_vm._v("8GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "909" } }, [_vm._v("9GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "921" } }, [_vm._v("1SGBI")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "922" } }, [_vm._v("2SGBI")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "926" } }, [_vm._v("6SGBI")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6599cb78", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/OPM.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/OPM.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("b87a34a6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./OPM.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./OPM.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/lib/addStylesClient.js":
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__("./node_modules/vue-style-loader/lib/listToStyles.js")

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ "./node_modules/vue-style-loader/lib/listToStyles.js":
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ "./resources/assets/js/components/Form/OPM.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/OPM.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/OPM.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-6599cb78\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/OPM.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-6599cb78"
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
Component.options.__file = "resources/assets/js/components/Form/OPM.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6599cb78", Component.options)
  } else {
    hotAPI.reload("data-v-6599cb78", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});