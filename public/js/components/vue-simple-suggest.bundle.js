webpackJsonp([16,12],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_simple_suggest__ = __webpack_require__("./node_modules/vue-simple-suggest/dist/es6.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_simple_suggest_dist_styles_css__ = __webpack_require__("./node_modules/vue-simple-suggest/dist/styles.css");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_simple_suggest_dist_styles_css___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_vue_simple_suggest_dist_styles_css__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Checkbox__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Checkbox.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Checkbox___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__Vuestrap_Checkbox__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


 // Optional CSS

/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        VueSimpleSuggest: __WEBPACK_IMPORTED_MODULE_0_vue_simple_suggest__["a" /* default */]
    },
    data: function data() {
        return {
            rg: '',
            name: '',
            ativos: true,
            inativos: false,
            reserva: false,
            suggestionRG: [],
            suggestionName: []
        };
    },

    watch: {
        rg: function rg() {
            if (this.rg.length > 3) {
                this.searchRG();
            }
        },
        name: function name() {
            if (this.name.length > 3) {
                this.searchName();
            }
        }
    },
    computed: {
        getBaseUrl: function getBaseUrl() {
            var getUrl = window.location;
            var pathname = getUrl.pathname.split('/');
            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + pathname[1] + '/';

            return baseUrl;
        }
    },
    methods: {
        searchRG: function searchRG() {
            var _this = this;

            var urlSearch = this.getBaseUrl + 'api/dados/sugest/rg';
            var data = {
                rg: this.rg,
                ativos: this.ativos,
                inativos: this.inativos,
                reserva: this.reserva
            };

            axios.post(urlSearch, data).then(function (response) {
                return _this.suggestionRG = response.data;
            }).catch(function (error) {
                return console.log(error);
            });
        },
        searchName: function searchName() {
            var _this2 = this;

            var urlSearch = this.getBaseUrl + 'api/dados/sugest/nome';
            var data = {
                name: this.name,
                ativos: this.ativos,
                inativos: this.inativos,
                reserva: this.reserva
            };

            axios.post(urlSearch, data).then(function (response) {
                return _this2.suggestionName = response.data;
            }).catch(function (error) {
                return console.log(error);
            });
        }
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue":
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

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    button: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
    falseValue: { default: false },
    name: { type: String, default: null },
    text: { type: String, default: null },
    readonly: { type: Boolean, default: false },
    trueValue: { default: true },
    type: { type: String, default: null },
    value: { default: false }
  },
  data: function data() {
    return {
      checked: this.value === this.trueValue
    };
  },

  computed: {
    inGroup: function inGroup() {
      return this.$parent && this.$parent.btnGroup && !this.$parent._radioGroup;
    },
    isButton: function isButton() {
      return this.button || this.$parent && this.$parent.btnGroup && this.$parent.buttons;
    },
    isFalse: function isFalse() {
      return this.value === this.falseValue;
    },
    isTrue: function isTrue() {
      return this.value === this.trueValue;
    },
    parentValue: function parentValue() {
      return this.$parent.val;
    },
    typeColor: function typeColor() {
      return this.type || this.$parent && this.$parent.type || 'default';
    }
  },
  watch: {
    checked: function checked(val, old) {
      var value = val ? this.trueValue : this.falseValue;
      this.$emit('checked', val);
      this.$emit('input', value);
      this.updateParent();
    },
    parentValue: function parentValue(val) {
      this.updateFromParent();
    },
    value: function value(val, old) {
      var checked = val === this.trueValue;
      if (this.checked !== checked) {
        this.checked = checked;
      }
    }
  },
  created: function created() {
    if (this.inGroup) {
      var parent = this.$parent;
      parent._checkboxGroup = true;
      if (!(parent.val instanceof Array)) {
        parent.val = [];
      }
    }
  },
  mounted: function mounted() {
    this.updateFromParent();
  },

  methods: {
    // called @ mounted(), or whenever $parent.val changes
    // sync our state with the $parent.val
    updateFromParent: function updateFromParent() {
      if (this.inGroup) {
        var index = this.$parent.val.indexOf(this.trueValue);
        this.checked = ~index;
      }
    },

    // called when our checked state changes
    updateParent: function updateParent() {
      if (this.inGroup) {
        var index = this.$parent.val.indexOf(this.trueValue);
        if (this.checked && !~index) this.$parent.val.push(this.trueValue);
        if (!this.checked && ~index) this.$parent.val.splice(index, 1);
      }
    },
    toggle: function toggle() {
      if (this.disabled || this.readonly) {
        return;
      }
      this.checked = !this.checked;
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\nlabel.checkbox[data-v-00ba1cd1] {\n  position: relative;\n  padding-left: 18px;\n}\nlabel.checkbox > input[data-v-00ba1cd1] {\n  box-sizing: border-box;\n  position: absolute;\n  z-index: -1;\n  padding: 0;\n  opacity: 0;\n  margin: 0;\n}\nlabel.checkbox > .icon[data-v-00ba1cd1] {\n  position: absolute;\n  top: .2rem;\n  left: 0;\n  display: block;\n  width: 1.4rem;\n  height: 1.4rem;\n  line-height:1rem;\n  text-align: center;\n  user-select: none;\n  border-radius: .35rem;\n  background-repeat: no-repeat;\n  background-position: center center;\n  background-size: 50% 50%;\n}\nlabel.checkbox:not(.active) > .icon[data-v-00ba1cd1] {\n  background-color: #ddd;\n  border: 1px solid #bbb;\n}\nlabel.checkbox > input:focus ~ .icon[data-v-00ba1cd1] {\n  outline: 0;\n  border: 1px solid #66afe9;\n  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);\n}\nlabel.checkbox.active > .icon[data-v-00ba1cd1] {\n  background-size: 1rem 1rem;\n  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNyIgaGVpZ2h0PSI3Ij48cGF0aCBmaWxsPSIjZmZmIiBkPSJtNS43MywwLjUybC0zLjEyNDIyLDMuMzQxNjFsLTEuMzM4OTUsLTEuNDMyMTJsLTEuMjQ5NjksMS4zMzY2NWwyLjU4ODYzLDIuNzY4NzZsNC4zNzM5LC00LjY3ODI2bC0xLjI0OTY5LC0xLjMzNjY1bDAsMGwwLjAwMDAyLDAuMDAwMDF6Ii8+PC9zdmc+);\n}\nlabel.checkbox.active .btn-default[data-v-00ba1cd1] { filter: brightness(75%);\n}\nlabel.checkbox.disabled[data-v-00ba1cd1],\nlabel.checkbox.readonly[data-v-00ba1cd1],\n.btn.readonly[data-v-00ba1cd1] {\n  filter: alpha(opacity=65);\n  box-shadow: none;\n  opacity: .65;\n}\nlabel.btn > input[type=checkbox][data-v-00ba1cd1] {\n  position: absolute;\n  clip: rect(0,0,0,0);\n  pointer-events: none;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.suggestions {\n  opacity: 1;\n}\n.vue-simple-suggest-enter-active.suggestions,\n.vue-simple-suggest-leave-active.suggestions {\n  transition: opacity .2s;\n}\n.vue-simple-suggest-enter.suggestions,\n.vue-simple-suggest-leave-to.suggestions {\n  opacity: 0;\n}\n.default-input:focus {\n    border-color: #007bff;\n    box-shadow: 2px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-simple-suggest/dist/styles.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n.vue-simple-suggest > ul {\n  list-style: none;\n  margin: 0;\n  padding: 0;\n}\n\n.vue-simple-suggest.designed {\n  position: relative;\n}\n\n.vue-simple-suggest.designed, .vue-simple-suggest.designed * {\n  box-sizing: border-box;\n}\n\n.vue-simple-suggest.designed .input-wrapper input {\n  display: block;\n  width: 100%;\n  padding: 10px;\n  border: 1px solid #cde;\n  border-radius: 3px;\n  color: black;\n  background: white;\n  outline:none;\n  transition: all .1s;\n  transition-delay: .05s\n}\n\n.vue-simple-suggest.designed.focus .input-wrapper input {\n  border: 1px solid #aaa;\n}\n\n.vue-simple-suggest.designed .suggestions {\n  position: absolute;\n  left: 0;\n  right: 0;\n  top: 100%;\n  top: calc(100% + 5px);\n  border-radius: 3px;\n  border: 1px solid #aaa;\n  background-color: #fff;\n  opacity: 1;\n  z-index: 1000;\n}\n\n.vue-simple-suggest.designed .suggestions .suggest-item {\n  cursor: pointer;\n  user-select: none;\n}\n\n.vue-simple-suggest.designed .suggestions .suggest-item,\n.vue-simple-suggest.designed .suggestions .misc-item {\n  padding: 5px 10px;\n}\n\n.vue-simple-suggest.designed .suggestions .suggest-item.hover {\n  background-color: #2874D5 !important;\n  color: #fff !important;\n}\n\n.vue-simple-suggest.designed .suggestions .suggest-item.selected {\n  background-color: #2832D5;\n  color: #fff;\n}\n", ""]);

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

/***/ "./node_modules/style-loader/lib/addStyles.js":
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getElement = (function (fn) {
	var memo = {};

	return function(selector) {
		if (typeof memo[selector] === "undefined") {
			memo[selector] = fn.call(this, selector);
		}

		return memo[selector]
	};
})(function (target) {
	return document.querySelector(target)
});

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__("./node_modules/style-loader/lib/urls.js");

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton) options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
	if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else {
		throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	options.attrs.type = "text/css";

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	options.attrs.type = "text/css";
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = options.transform(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ "./node_modules/style-loader/lib/urls.js":
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00ba1cd1\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    _vm.isButton ? "a" : "label",
    {
      tag: "a",
      class: [
        _vm.isButton
          ? "btn btn-" + _vm.typeColor
          : "open checkbox " + _vm.typeColor,
        { active: _vm.checked, disabled: _vm.disabled, readonly: _vm.readonly }
      ],
      on: { click: _vm.toggle }
    },
    [
      _vm.name
        ? _c("input", {
            attrs: { type: "hidden", name: _vm.name },
            domProps: { value: _vm.checked ? _vm.trueValue : _vm.falseValue }
          })
        : _vm._e(),
      _vm._v(" "),
      !_vm.isButton
        ? _c("span", {
            staticClass: "icon dropdown-toggle",
            class: [
              _vm.checked ? "btn-" + _vm.typeColor : "",
              { bg: _vm.typeColor === "default" }
            ]
          })
        : _vm._e(),
      _vm._v(" "),
      !_vm.isButton && _vm.checked && _vm.typeColor === "default"
        ? _c("span", { staticClass: "icon" })
        : _vm._e(),
      _vm._v("\n   "),
      _vm.text
        ? _c("span", { staticStyle: { "font-size": "1rem" } }, [
            _vm._v(_vm._s(_vm.text))
          ])
        : _vm._e()
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-00ba1cd1", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2d5cb31a\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c(
      "div",
      { staticClass: "col-md-6 col-xs-12" },
      [
        _c("vue-simple-suggest", {
          attrs: {
            list: _vm.suggestionRG,
            "filter-by-query": true,
            placeholder: "RG"
          },
          model: {
            value: _vm.rg,
            callback: function($$v) {
              _vm.rg = $$v
            },
            expression: "rg"
          }
        })
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "col-md-6 col-xs-12" },
      [
        _c("vue-simple-suggest", {
          attrs: {
            list: _vm.suggestionName,
            "filter-by-query": true,
            placeholder: "Nome"
          },
          model: {
            value: _vm.name,
            callback: function($$v) {
              _vm.name = $$v
            },
            expression: "name"
          }
        })
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "col-md-12 col-xs-12" },
      [
        _c("v-checkbox", {
          attrs: { "true-value": true, "false-value": false, text: "Ativos" },
          model: {
            value: _vm.ativos,
            callback: function($$v) {
              _vm.ativos = $$v
            },
            expression: "ativos"
          }
        }),
        _vm._v(" "),
        _c("v-checkbox", {
          attrs: { "true-value": true, "false-value": false, text: "Inativos" },
          model: {
            value: _vm.inativos,
            callback: function($$v) {
              _vm.inativos = $$v
            },
            expression: "inativos"
          }
        }),
        _vm._v(" "),
        _c("v-checkbox", {
          attrs: { "true-value": true, "false-value": false, text: "Reserva" },
          model: {
            value: _vm.reserva,
            callback: function($$v) {
              _vm.reserva = $$v
            },
            expression: "reserva"
          }
        })
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
    require("vue-hot-reload-api")      .rerender("data-v-2d5cb31a", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-simple-suggest/dist/es6.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {const defaultControls = {
  selectionUp: [38],
  selectionDown: [40],
  select: [13],
  hideList: [27],
  autocomplete: [32, 13]
};

const modes = {
  input: String,
  select: Object
};

function fromPath(obj, path) {
  return path.split('.').reduce((o, i) => o === Object(o) ? o[i] : o, obj);
}

function hasKeyCode(arr, event) {
  if (arr.length <= 0) return false;

  const has = arr => arr.some(code => code === event.keyCode);
  if (Array.isArray(arr[0])) {
    return arr.some(array => has(array));
  } else {
    return has(arr);
  }
}

function _finally(body, finalizer) {
  try {
    var result = body();
  } catch (e) {
    return finalizer();
  }if (result && result.then) {
    return result.then(finalizer, finalizer);
  }
  return finalizer();
}function _catch(body, recover) {
  try {
    var result = body();
  } catch (e) {
    return recover(e);
  }if (result && result.then) {
    return result.then(void 0, recover);
  }return result;
}function _invokeIgnored(body) {
  var result = body();if (result && result.then) {
    return result.then(_empty);
  }
}function _await(value, then, direct) {
  if (direct) {
    return then ? then(value) : value;
  }value = Promise.resolve(value);return then ? value.then(then) : value;
}const _async = function () {
  try {
    if (isNaN.apply(null, {})) {
      return function (f) {
        return function () {
          try {
            return Promise.resolve(f.apply(this, arguments));
          } catch (e) {
            return Promise.reject(e);
          }
        };
      };
    }
  } catch (e) {}return function (f) {
    // Pre-ES5.1 JavaScript runtimes don't accept array-likes in Function.apply
    return function () {
      try {
        return Promise.resolve(f.apply(this, Array.prototype.slice.call(arguments)));
      } catch (e) {
        return Promise.reject(e);
      }
    };
  };
}();function _invoke(body, then) {
  var result = body();if (result && result.then) {
    return result.then(then);
  }return then(result);
}function _awaitIgnored(value, direct) {
  if (!direct) {
    return Promise.resolve(value).then(_empty);
  }
}function _empty() {}
var VueSimpleSuggest = {
  render: function () {
    var _vm = this;var _h = _vm.$createElement;var _c = _vm._self._c || _h;return _c('div', { staticClass: "vue-simple-suggest", class: [_vm.styles.vueSimpleSuggest, { designed: !_vm.destyled, focus: _vm.isInFocus }], on: { "keydown": function ($event) {
          if (!('button' in $event) && _vm._k($event.keyCode, "tab", 9, $event.key, "Tab")) {
            return null;
          }_vm.isTabbed = true;
        } } }, [_c('div', { ref: "inputSlot", staticClass: "input-wrapper", class: _vm.styles.inputWrapper, attrs: { "role": "combobox", "aria-haspopup": "listbox", "aria-owns": _vm.listId, "aria-expanded": !!_vm.listShown && !_vm.removeList ? 'true' : 'false' } }, [_vm._t("default", [_c('input', _vm._b({ staticClass: "default-input", class: _vm.styles.defaultInput, domProps: { "value": _vm.text || '' } }, 'input', _vm.$attrs, false))])], 2), _vm._v(" "), _c('transition', { attrs: { "name": "vue-simple-suggest" } }, [!!_vm.listShown && !_vm.removeList ? _c('ul', { staticClass: "suggestions", class: _vm.styles.suggestions, attrs: { "id": _vm.listId, "role": "listbox", "aria-labelledby": _vm.listId }, on: { "mouseenter": function ($event) {
          _vm.hoverList(true);
        }, "mouseleave": function ($event) {
          _vm.hoverList(false);
        } } }, [!!this.$scopedSlots['misc-item-above'] ? _c('li', [_vm._t("misc-item-above", null, { suggestions: _vm.suggestions, query: _vm.text })], 2) : _vm._e(), _vm._v(" "), _vm._l(_vm.suggestions, function (suggestion, index) {
      return _c('li', { key: _vm.getId(suggestion, index), staticClass: "suggest-item", class: [_vm.styles.suggestItem, {
          selected: _vm.isSelected(suggestion),
          hover: _vm.isHovered(suggestion)
        }], attrs: { "role": "option", "aria-selected": _vm.isHovered(suggestion) || _vm.isSelected(suggestion) ? 'true' : 'false', "id": _vm.getId(suggestion, index) }, on: { "mouseenter": function ($event) {
            _vm.hover(suggestion, $event.target);
          }, "mouseleave": function ($event) {
            _vm.hover(undefined);
          }, "click": function ($event) {
            _vm.suggestionClick(suggestion, $event);
          } } }, [_vm._t("suggestion-item", [_c('span', [_vm._v(_vm._s(_vm.displayProperty(suggestion)))])], { autocomplete: function () {
          return _vm.setText(_vm.displayProperty(suggestion));
        }, suggestion: suggestion, query: _vm.text })], 2);
    }), _vm._v(" "), !!this.$scopedSlots['misc-item-below'] ? _c('li', [_vm._t("misc-item-below", null, { suggestions: _vm.suggestions, query: _vm.text })], 2) : _vm._e()], 2) : _vm._e()])], 1);
  },
  staticRenderFns: [],
  name: 'vue-simple-suggest',
  inheritAttrs: false,
  model: {
    prop: 'value',
    event: 'input'
  },
  props: {
    styles: {
      type: Object,
      default: () => ({})
    },
    controls: {
      type: Object,
      default: () => defaultControls
    },
    minLength: {
      type: Number,
      default: 1
    },
    maxSuggestions: {
      type: Number,
      default: 10
    },
    displayAttribute: {
      type: String,
      default: 'title'
    },
    valueAttribute: {
      type: String,
      default: 'id'
    },
    list: {
      type: [Function, Array],
      default: () => []
    },
    removeList: {
      type: Boolean,
      default: false
    },
    destyled: {
      type: Boolean,
      default: false
    },
    preventSubmit: {
      type: Boolean,
      default: true
    },
    filterByQuery: {
      type: Boolean,
      default: false
    },
    filter: {
      type: Function,
      default(el, value) {
        return value ? ~this.displayProperty(el).toLowerCase().indexOf(value.toLowerCase()) : true;
      }
    },
    debounce: {
      type: Number,
      default: 0
    },
    nullableSelect: {
      type: Boolean,
      default: false
    },
    value: {},
    mode: {
      type: String,
      default: 'input',
      validator: value => !!~Object.keys(modes).indexOf(value.toLowerCase())
    }
  },
  // Handle run-time mode changes (now working):
  watch: {
    mode: {
      handler(current, old) {
        this.constructor.options.model.event = current;

        // Can be null if the component is root
        this.$parent && this.$parent.$forceUpdate();

        this.$nextTick(() => {
          if (current === 'input') {
            this.$emit('input', this.text);
          } else {
            this.$emit('select', this.selected);
          }
        });
      },
      immediate: true
    },
    value: {
      handler(current) {
        if (typeof current === 'string') {
          this.text = current;
        } else if (current) {
          this.text = this.displayProperty(current);
        }
      },
      immediate: true
    }
  },
  //
  data() {
    return {
      selected: null,
      hovered: null,
      suggestions: [],
      listShown: false,
      inputElement: null,
      canSend: true,
      timeoutInstance: null,
      text: this.value,
      isPlainSuggestion: false,
      isClicking: false,
      isOverList: false,
      isInFocus: false,
      isFalseFocus: false,
      isTabbed: false,
      controlScheme: {},
      listId: `${this._uid}-suggestions`
    };
  },
  computed: {
    listIsRequest() {
      return typeof this.list === 'function';
    },
    inputIsComponent() {
      return this.$slots.default && this.$slots.default.length > 0 && !!this.$slots.default[0].componentInstance;
    },
    input() {
      return this.inputIsComponent ? this.$slots.default[0].componentInstance : this.inputElement;
    },
    on() {
      return this.inputIsComponent ? '$on' : 'addEventListener';
    },
    off() {
      return this.inputIsComponent ? '$off' : 'removeEventListener';
    },
    hoveredIndex() {
      return this.suggestions.findIndex(el => this.hovered && this.valueProperty(this.hovered) == this.valueProperty(el));
    },
    textLength() {
      return this.text && this.text.length || this.inputElement.value.length || 0;
    },
    isSelectedUpToDate() {
      return !!this.selected && this.displayProperty(this.selected) === this.text;
    }
  },
  created() {
    this.controlScheme = Object.assign({}, defaultControls, this.controls);
  },
  mounted() {
    this.inputElement = this.$refs['inputSlot'].querySelector('input');

    this.setInputAriaAttributes();
    this.prepareEventHandlers(true);
  },
  beforeDestroy() {
    this.prepareEventHandlers(false);
  },
  methods: {
    isEqual(suggestion, item) {
      return item && this.valueProperty(suggestion) == this.valueProperty(item);
    },
    isSelected(suggestion) {
      return this.isEqual(suggestion, this.selected);
    },
    isHovered(suggestion) {
      return this.isEqual(suggestion, this.hovered);
    },
    onSubmit(e) {
      if (this.preventSubmit && e.key === 'Enter') {
        e.stopPropagation();
        e.preventDefault();
      }
    },
    setInputAriaAttributes() {
      this.inputElement.setAttribute('aria-activedescendant', '');
      this.inputElement.setAttribute('aria-autocomplete', 'list');
      this.inputElement.setAttribute('aria-controls', this.listId);
    },
    prepareEventHandlers(enable) {
      const binder = this[enable ? 'on' : 'off'];
      const keyEventsList = {
        click: this.showSuggestions,
        keydown: $event => (this.moveSelection($event), this.onAutocomplete($event)),
        keyup: this.onListKeyUp
      };
      const eventsList = Object.assign({
        blur: this.onBlur,
        focus: this.onFocus,
        input: this.onInput
      }, keyEventsList);

      for (const event in eventsList) {
        this.input[binder](event, eventsList[event]);
      }

      const listenerBinder = enable ? 'addEventListener' : 'removeEventListener';

      for (const event in keyEventsList) {
        this.inputElement[listenerBinder](event, keyEventsList[event]);
      }

      if (this.preventSubmit === true) {
        let form = this.$el.closest('form');
        if (form) {
          form[listenerBinder]('keydown', this.onSubmit);
        }
      }
    },
    isScopedSlotEmpty(slot) {
      if (slot) {
        const vNode = slot(this);
        return !(Array.isArray(vNode) || vNode && (vNode.tag || vNode.context || vNode.text || vNode.children));
      }

      return true;
    },
    miscSlotsAreEmpty() {
      const slots = ['misc-item-above', 'misc-item-below'].map(s => this.$scopedSlots[s]);

      if (slots.every(s => !!s)) {
        return slots.every(this.isScopedSlotEmpty.bind(this));
      }

      const slot = slots.find(s => !!s);

      return this.isScopedSlotEmpty.call(this, slot);
    },
    getPropertyByAttribute(obj, attr) {
      return this.isPlainSuggestion ? obj : typeof obj !== undefined ? fromPath(obj, attr) : obj;
    },
    displayProperty(obj) {
      if (this.isPlainSuggestion) {
        return obj;
      }

      let display = this.getPropertyByAttribute(obj, this.displayAttribute);

      if (typeof display === 'undefined') {
        display = JSON.stringify(obj);

        if (process && ~"development".indexOf('dev')) {
          console.warn('[vue-simple-suggest]: Please, provide `display-attribute` as a key or a dotted path for a property from your object.');
        }
      }

      return String(display);
    },
    valueProperty(obj) {
      if (this.isPlainSuggestion) {
        return obj;
      }

      const value = this.getPropertyByAttribute(obj, this.valueAttribute);

      if (typeof value === 'undefined') {
        console.error(`[vue-simple-suggest]: Please, check if you passed 'value-attribute' (default is 'id') and 'display-attribute' (default is 'title') props correctly.
        Your list objects should always contain a unique identifier.`);
      }

      return value;
    },

    /**
     * @deprecated remove on the next release
     */
    autocompleteText(text) {
      this.setText(text);
    },
    setText(text) {
      this.$nextTick(() => {
        this.$emit('input', text);
        this.inputElement.value = text;
        this.text = text;
      });
    },
    select(item) {
      if (this.selected !== item || this.nullableSelect && !item) {
        this.selected = item;
        this.$emit('select', item);

        if (item) {
          this.setText(this.displayProperty(item));
        }
      }

      this.hover(null);
    },
    hover(item, elem) {
      const elemId = !!item ? this.getId(item, this.hoveredIndex) : '';

      this.inputElement.setAttribute('aria-activedescendant', elemId);

      if (item && item !== this.hovered) {
        this.$emit('hover', item, elem);
      }

      this.hovered = item;
    },
    hoverList(isOverList) {
      this.isOverList = isOverList;
    },
    hideList() {
      if (this.listShown) {
        this.listShown = false;
        this.hover(null);
        this.$emit('hide-list');
      }
    },
    showList() {
      if (!this.listShown) {
        if (this.textLength >= this.minLength && (this.suggestions.length > 0 || !this.miscSlotsAreEmpty())) {
          this.listShown = true;
          this.$emit('show-list');
        }
      }
    },
    showSuggestions: _async(function () {
      var _this = this;

      return _invoke(function () {
        if (_this.suggestions.length === 0 && _this.minLength === _this.textLength) {
          return _awaitIgnored(_this.research());
        }
      }, function () {
        _this.showList();
      });
    }),

    moveSelection(e) {
      if (!this.listShown || !this.suggestions.length) return;
      if (hasKeyCode([this.controlScheme.selectionUp, this.controlScheme.selectionDown], e)) {
        e.preventDefault();
        this.showSuggestions();

        const isMovingDown = hasKeyCode(this.controlScheme.selectionDown, e);
        const direction = isMovingDown * 2 - 1;
        const listEdge = isMovingDown ? 0 : this.suggestions.length - 1;
        const hoversBetweenEdges = isMovingDown ? this.hoveredIndex < this.suggestions.length - 1 : this.hoveredIndex > 0;

        let item = null;

        if (!this.hovered) {
          item = this.selected || this.suggestions[listEdge];
        } else if (hoversBetweenEdges) {
          item = this.suggestions[this.hoveredIndex + direction];
        } else /* if hovers on edge */{
            item = this.suggestions[listEdge];
          }
        this.hover(item);
      }
    },
    onListKeyUp(e) {
      const select = this.controlScheme.select,
            hideList = this.controlScheme.hideList;

      if (hasKeyCode([select, hideList], e)) {
        e.preventDefault();
        if (this.listShown) {
          if (hasKeyCode(select, e)) {
            this.select(this.hovered);
          }

          this.hideList();
        } else if (hasKeyCode(select, e)) {
          this.research();
        }
      }
    },
    onAutocomplete(e) {
      if (hasKeyCode(this.controlScheme.autocomplete, e) && (e.ctrlKey || e.shiftKey) && this.suggestions.length > 0 && this.suggestions[0] && this.listShown) {
        e.preventDefault();
        this.hover(this.suggestions[0]);
        this.setText(this.displayProperty(this.suggestions[0]));
      }
    },
    suggestionClick(suggestion, e) {
      this.$emit('suggestion-click', suggestion, e);
      this.select(suggestion);

      /// Ensure, that all needed flags are off before finishing the click.
      this.isClicking = this.isOverList = false;

      this.$nextTick(() => {
        this.hideList();
      });
    },
    onBlur(e) {
      if (this.isInFocus) {

        /// Clicking starts here, because input's blur occurs before the suggestionClick
        /// and exactly when the user clicks the mouse button or taps the screen.
        this.isClicking = this.isOverList && !this.isTabbed;

        if (!this.isClicking) {
          this.isInFocus = false;
          this.hideList();

          this.$emit('blur', e);
        } else if (e && e.isTrusted && !this.isTabbed) {
          this.isFalseFocus = true;
          this.$nextTick(() => {
            this.inputElement.focus();
          });
        }
      } else {
        this.inputElement.blur();
        console.error(`This should never happen!
          If you encountered this error, please make sure that your input component emits 'focus' events properly.
          For more info see https://github.com/KazanExpress/vue-simple-suggest#custom-input.

          If your 'vue-simple-suggest' setup does not include a custom input component - please,
          report to https://github.com/KazanExpress/vue-simple-suggest/issues/new`);
      }

      this.isTabbed = false;
    },
    onFocus(e) {
      this.isInFocus = true;

      // Only emit, if it was a native input focus
      if (e && !this.isFalseFocus) {
        this.$emit('focus', e);
      }
      this.isFalseFocus = false;

      // Show list only if the item has not been clicked
      if (!this.isClicking) {
        this.showSuggestions();
      }
    },
    onInput(inputEvent) {
      const value = !inputEvent.target ? inputEvent : inputEvent.target.value;

      if (this.text === value) {
        return;
      }

      this.text = value;
      this.$emit('input', this.text);

      if (this.hovered) this.hover(null);

      if (this.debounce) {
        clearTimeout(this.timeoutInstance);
        this.timeoutInstance = setTimeout(this.research, this.debounce);
      } else {
        this.research();
      }
    },
    research: _async(function () {
      var _this2 = this;

      return _finally(function () {
        return _catch(function () {
          return _invokeIgnored(function () {
            if (_this2.canSend) {
              _this2.canSend = false;
              // @TODO: fix when promises will be cancelable (never :D)
              let textBeforeRequest = _this2.text;
              return _await(_this2.getSuggestions(_this2.text), function (newList) {
                if (textBeforeRequest === _this2.text) {
                  _this2.$set(_this2, 'suggestions', newList);
                }
              });
            }
          });
        }, function (e) {
          _this2.clearSuggestions();
          throw e;
        });
      }, function () {
        _this2.canSend = true;

        if (_this2.suggestions.length === 0 && _this2.miscSlotsAreEmpty()) {
          _this2.hideList();
        } else {
          _this2.showList();
        }

        return _this2.suggestions;
      });
    }),
    getSuggestions: _async(function (value) {
      var _this3 = this;

      value = value || '';

      if (value.length < _this3.minLength) {
        if (_this3.listShown) {
          _this3.hideList();
          return [];
        }

        return _this3.suggestions;
      }

      _this3.selected = null;

      // Start request if can
      if (_this3.listIsRequest) {
        _this3.$emit('request-start', value);

        if (_this3.suggestions.length > 0 || !_this3.miscSlotsAreEmpty()) {
          _this3.showList();
        }
      }

      let result = [];
      return _finally(function () {
        return _catch(function () {
          return _invoke(function () {
            if (_this3.listIsRequest) {
              return _await(_this3.list(value), function (_this3$list) {
                result = _this3$list || [];
              });
            } else {
              result = _this3.list;
            }
          }, function () {
            // IFF the result is not an array (just in case!) - make it an array
            if (!Array.isArray(result)) {
              result = [result];
            }

            _this3.isPlainSuggestion = typeof result[0] !== 'object' || Array.isArray(result[0]);

            if (_this3.filterByQuery) {
              result = result.filter(el => _this3.filter(el, value));
            }

            if (_this3.listIsRequest) {
              _this3.$emit('request-done', result);
            }
          });
        }, function (e) {
          if (_this3.listIsRequest) {
            _this3.$emit('request-failed', e);
          } else {
            throw e;
          }
        });
      }, function () {
        if (_this3.maxSuggestions) {
          result.splice(_this3.maxSuggestions);
        }

        return result;
      });
    }),

    clearSuggestions() {
      this.suggestions.splice(0);
    },
    getId(value, i) {
      return `${this.listId}-suggestion-${this.isPlainSuggestion ? i : this.valueProperty(value) || i}`;
    }
  }
};

/* harmony default export */ __webpack_exports__["a"] = (VueSimpleSuggest);

/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/process/browser.js")))

/***/ }),

/***/ "./node_modules/vue-simple-suggest/dist/styles.css":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-simple-suggest/dist/styles.css");
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__("./node_modules/style-loader/lib/addStyles.js")(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../css-loader/index.js!./styles.css", function() {
			var newContent = require("!!../../css-loader/index.js!./styles.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("1528a380", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Checkbox.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Checkbox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7d507394", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SugestRg.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SugestRg.vue");
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

/***/ "./resources/assets/js/components/Form/SugestRg.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d5cb31a\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/SugestRg.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/SugestRg.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2d5cb31a\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/SugestRg.vue")
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
Component.options.__file = "resources/assets/js/components/Form/SugestRg.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2d5cb31a", Component.options)
  } else {
    hotAPI.reload("data-v-2d5cb31a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Checkbox.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00ba1cd1\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-00ba1cd1"
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Checkbox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-00ba1cd1", Component.options)
  } else {
    hotAPI.reload("data-v-00ba1cd1", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});