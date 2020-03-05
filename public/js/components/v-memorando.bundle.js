webpackJsonp([16],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator__ = __webpack_require__("./node_modules/babel-runtime/regenerator/index.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator__);


function _asyncToGenerator(fn) { return function () { var gen = fn.apply(this, arguments); return new Promise(function (resolve, reject) { function step(key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { return Promise.resolve(value).then(function (value) { step("next", value); }, function (err) { step("throw", err); }); } } return step("next"); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        idp: {
            type: Number,
            default: null
        }
    },
    data: function data() {
        return {
            module: 'apresentacao',
            registro: {},
            opm_intermediaria: null,
            date: {},
            errors: [],
            pm: null,
            autoridades: [],
            autoridade: {},
            id_cadastroopmcoger: 0,
            vias: 2,
            check: null
        };
    },
    mounted: function mounted() {
        this.list();
    },

    computed: {
        baseUrl: function baseUrl() {
            return this.$root.baseUrl;
        }
    },
    methods: {
        list: function () {
            var _ref = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee() {
                var urlIndex, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee$(_context) {
                    while (1) {
                        switch (_context.prev = _context.next) {
                            case 0:
                                if (!this.idp) {
                                    _context.next = 12;
                                    break;
                                }

                                urlIndex = this.$root.baseUrl + 'api/' + this.module + '/memorando/' + this.idp;
                                _context.prev = 2;
                                _context.next = 5;
                                return axios.get(urlIndex);

                            case 5:
                                response = _context.sent;

                                if (response) {
                                    this.registro = response.data;
                                    this.checkErrors(response.data);
                                }
                                _context.next = 12;
                                break;

                            case 9:
                                _context.prev = 9;
                                _context.t0 = _context['catch'](2);

                                console.error(_context.t0);

                            case 12:
                            case 'end':
                                return _context.stop();
                        }
                    }
                }, _callee, this, [[2, 9]]);
            }));

            function list() {
                return _ref.apply(this, arguments);
            }

            return list;
        }(),
        checkErrors: function checkErrors(register) {
            if (!register.pessoa_unidade_lotacao_descricao) this.errors.push('UNIDADE LOTAÇÃO NÃO DEFINIDA');
            if (!register.comparecimento_data) this.errors.push('DATA DE COMPARECIMENTO NÃO DEFINIDA');
            if (!register.comparecimento_hora) this.errors.push('HORA DE COMPARECIMENTO NÃO DEFINIDA');
            if (!this.errors.lenght) {
                this.getPm(register.pessoa_rg);
                this.getAutoridade();
            }
        },
        getPm: function () {
            var _ref2 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee2(rg) {
                var searchUrl, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee2$(_context2) {
                    while (1) {
                        switch (_context2.prev = _context2.next) {
                            case 0:
                                searchUrl = this.$root.baseUrl + 'api/dados/pm/' + rg;
                                _context2.prev = 1;
                                _context2.next = 4;
                                return axios.get(searchUrl);

                            case 4:
                                response = _context2.sent;

                                if (response) {
                                    this.pm = response.data.pm;
                                    this.registro.pm = response.data.pm;
                                }
                                _context2.next = 11;
                                break;

                            case 8:
                                _context2.prev = 8;
                                _context2.t0 = _context2['catch'](1);

                                console.error(_context2.t0);

                            case 11:
                            case 'end':
                                return _context2.stop();
                        }
                    }
                }, _callee2, this, [[1, 8]]);
            }));

            function getPm(_x) {
                return _ref2.apply(this, arguments);
            }

            return getPm;
        }(),
        getAutoridade: function () {
            var _ref3 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee3() {
                var opm, urlIndex, response, res;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee3$(_context3) {
                    while (1) {
                        switch (_context3.prev = _context3.next) {
                            case 0:
                                opm = this.$root.dadoSession('cdopmbase');

                                if (!opm) this.login();
                                urlIndex = this.$root.baseUrl + 'api/cadastroopm/get/' + opm;
                                _context3.prev = 3;
                                _context3.next = 6;
                                return axios.get(urlIndex);

                            case 6:
                                response = _context3.sent;

                                if (response) {
                                    res = response.data[0];


                                    this.id_cadastroopmcoger = res.id_cadastroopmcoger;
                                    this.getOtherAutoridade(res.id_cadastroopmcoger);

                                    this.autoridades.push({
                                        nome: res.opm_autoridade_nome,
                                        funcao: res.opm_autoridade_funcao
                                    });
                                }
                                _context3.next = 13;
                                break;

                            case 10:
                                _context3.prev = 10;
                                _context3.t0 = _context3['catch'](3);

                                console.error(_context3.t0);

                            case 13:
                            case 'end':
                                return _context3.stop();
                        }
                    }
                }, _callee3, this, [[3, 10]]);
            }));

            function getAutoridade() {
                return _ref3.apply(this, arguments);
            }

            return getAutoridade;
        }(),
        getOtherAutoridade: function () {
            var _ref4 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee4(id) {
                var _this = this;

                var urlIndex, response, res;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee4$(_context4) {
                    while (1) {
                        switch (_context4.prev = _context4.next) {
                            case 0:
                                urlIndex = this.$root.baseUrl + 'api/cadastroopmautoridade/list/' + id;
                                _context4.prev = 1;
                                _context4.next = 4;
                                return axios.get(urlIndex);

                            case 4:
                                response = _context4.sent;

                                if (response) {
                                    res = response.data[0];

                                    res.forEach(function (e) {
                                        _this.autoridades.push({
                                            nome: e.nome,
                                            funcao: e.funcao
                                        });
                                    });
                                }
                                _context4.next = 11;
                                break;

                            case 8:
                                _context4.prev = 8;
                                _context4.t0 = _context4['catch'](1);

                                console.error(_context4.t0);

                            case 11:
                            case 'end':
                                return _context4.stop();
                        }
                    }
                }, _callee4, this, [[1, 8]]);
            }));

            function getOtherAutoridade(_x2) {
                return _ref4.apply(this, arguments);
            }

            return getOtherAutoridade;
        }(),
        changeAutoridade: function changeAutoridade(autoridade) {
            this.autoridade = autoridade;
            this.registro.autoridade = autoridade;
        },
        login: function login() {
            window.location.href = this.$root.baseUrl + 'login';
        },
        print: function print() {
            var nome = this.autoridade.nome.replace(/\s/g, "-");
            var funcao = this.autoridade.funcao.replace(/\s/g, "-");
            var urlPrint = this.$root.baseUrl + 'api/apresentacao/memorandogerar/' + this.idp + '/' + nome + '/' + funcao;
            console.log('url', urlPrint);
            window.open(urlPrint);
            console.log('print');
        }
    }
});

/***/ }),

/***/ "./node_modules/babel-runtime/regenerator/index.js":
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./node_modules/regenerator-runtime/runtime-module.js");


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* #printpage {\n    top: 10px;\n    margin: 10px;\n    padding: 20px;\n} */\n.body[data-v-23911582] {\n    font-family: Arial, Helvetica, sans-serif;\n    font-size: 12px;\n    line-height: 1 !important;\n    background-color: #f1f1f1;\n}\np[data-v-23911582] {\n    text-indent: 50px;\n    text-align: justify;\n}\n.a4[data-v-23911582] {\n    display: flex;\n    flex-direction: column;\n    width: 595px;\n    height: 841px;\n    padding: 20px;\n    border: 1px solid black;\n    page-break-before: always;\n}\n.header[data-v-23911582] {\n    margin: 82.8px 57px 10px 85px;\n    text-align: center;\n    padding-bottom: 10px;\n    border-bottom: 1px solid black;\n}\n.text-bold-g[data-v-23911582]{\n    font-size:14px;\n    font-weight:bold;\n    font-style:normal;\n    text-decoration: none;\n}\n.text-bold-m[data-v-23911582]{\n    font-size:12px;\n    font-weight:bold;\n    font-style:normal;\n    text-decoration: none;\n}\n.text-bold-s[data-v-23911582]{\n    font-size:8px;\n    font-weight:bold;\n    font-style:normal;\n    text-decoration: none;\n}\n.content-mem[data-v-23911582] {\n    margin: 10px 57px 10px 85px !important;\n    padding: 0 !important;\n}\n.ass[data-v-23911582] {\n    margin-top: 50px;\n    text-align: center;\n}\n.cert[data-v-23911582] {\n    display: flex;\n    align-items: flex-end !important;\n    margin: auto 57px 25px 85px; \n    font-size:8px;\n}\n.border-l[data-v-23911582] {\n    border-left: 1px solid black;\n}\n.border[data-v-23911582] {\n    border: 1px solid black;\n}\n.center[data-v-23911582] {\n    text-align: center;\n}\n.table-mem[data-v-23911582]  {\n    width: 100%;\n    height: 90px;\n    text-align: left;\n    text-indent: 5px;\n    padding: 0 10px 0 10px;\n}\n.text-red[data-v-23911582] {\n    font-size:12px;\n    font-weight:bold;\n    color: red;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime-module.js":
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

// This method of obtaining a reference to the global object needs to be
// kept identical to the way it is obtained in runtime.js
var g = (function() { return this })() || Function("return this")();

// Use `getOwnPropertyNames` because not all browsers support calling
// `hasOwnProperty` on the global `self` object in a worker. See #183.
var hadRuntime = g.regeneratorRuntime &&
  Object.getOwnPropertyNames(g).indexOf("regeneratorRuntime") >= 0;

// Save the old regeneratorRuntime in case it needs to be restored later.
var oldRuntime = hadRuntime && g.regeneratorRuntime;

// Force reevalutation of runtime.js.
g.regeneratorRuntime = undefined;

module.exports = __webpack_require__("./node_modules/regenerator-runtime/runtime.js");

if (hadRuntime) {
  // Restore the original runtime.
  g.regeneratorRuntime = oldRuntime;
} else {
  // Remove the global property added by runtime.js.
  try {
    delete g.regeneratorRuntime;
  } catch(e) {
    g.regeneratorRuntime = undefined;
  }
}


/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/***/ (function(module, exports) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

!(function(global) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  var inModule = typeof module === "object";
  var runtime = global.regeneratorRuntime;
  if (runtime) {
    if (inModule) {
      // If regeneratorRuntime is defined globally and we're in a module,
      // make the exports object identical to regeneratorRuntime.
      module.exports = runtime;
    }
    // Don't bother evaluating the rest of this file if the runtime was
    // already defined globally.
    return;
  }

  // Define the runtime globally (as expected by generated code) as either
  // module.exports (if we're in a module) or a new, empty object.
  runtime = global.regeneratorRuntime = inModule ? module.exports : {};

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  runtime.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunctionPrototype[toStringTagSymbol] =
    GeneratorFunction.displayName = "GeneratorFunction";

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      prototype[method] = function(arg) {
        return this._invoke(method, arg);
      };
    });
  }

  runtime.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  runtime.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      if (!(toStringTagSymbol in genFun)) {
        genFun[toStringTagSymbol] = "GeneratorFunction";
      }
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  runtime.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return Promise.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return Promise.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration. If the Promise is rejected, however, the
          // result for this iteration will be rejected with the same
          // reason. Note that rejections of yielded Promises are not
          // thrown back into the generator function, as is the case
          // when an awaited Promise is rejected. This difference in
          // behavior between yield and await is important, because it
          // allows the consumer to decide what to do with the yielded
          // rejection (swallow it and continue, manually .throw it back
          // into the generator, abandon iteration, whatever). With
          // await, by contrast, there is no opportunity to examine the
          // rejection reason outside the generator function, so the
          // only option is to throw it from the await expression, and
          // let the generator function handle the exception.
          result.value = unwrapped;
          resolve(result);
        }, reject);
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new Promise(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  runtime.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  runtime.async = function(innerFn, outerFn, self, tryLocsList) {
    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList)
    );

    return runtime.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        if (delegate.iterator.return) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  Gp[toStringTagSymbol] = "Generator";

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  runtime.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  runtime.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };
})(
  // In sloppy mode, unbound `this` refers to the global object, fallback to
  // Function constructor if we're in global strict mode. That is sadly a form
  // of indirect eval which violates Content Security Policy.
  (function() { return this })() || Function("return this")()
);


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-23911582\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "body" }, [
    _vm.errors.lenght
      ? _c(
          "div",
          { staticClass: "col-xs-12" },
          [
            _c("h4", [
              _vm._v(
                "Por favor adicione os dados informados para gerar o memorando:"
              )
            ]),
            _vm._v(" "),
            _vm._l(_vm.errors, function(error) {
              return _c(
                "v-alert",
                { key: error, attrs: { type: "danger", dismissable: "" } },
                [
                  _c("span", {
                    staticClass: "icon-ok-circled alert-icon-float-left"
                  }),
                  _vm._v("\n            " + _vm._s(error) + "\n        ")
                ]
              )
            }),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "btn btn-success btn-block",
                attrs: {
                  href:
                    _vm.baseUrl +
                    "/apresentacao/editar/" +
                    _vm.registro.id_apresentacao
                }
              },
              [_vm._v("Editar apresentação")]
            )
          ],
          2
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.errors.lenght
      ? _c(
          "div",
          { staticClass: "col-xs-12" },
          [
            _c(
              "v-label",
              { attrs: { lg: "6", md: "6", title: "Número memorando" } },
              [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.sjd_ref,
                      expression: "registro.sjd_ref"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: { type: "text" },
                  domProps: { value: _vm.registro.sjd_ref },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "sjd_ref", $event.target.value)
                    }
                  }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "v-label",
              { attrs: { lg: "6", md: "6", title: "Sigla Seção" } },
              [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.sigla,
                      expression: "registro.sigla"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: { type: "text" },
                  domProps: { value: _vm.registro.sigla },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "sigla", $event.target.value)
                    }
                  }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "v-label",
              {
                attrs: { label: "check", title: "Fecho: ", md: "12", lg: "12" }
              },
              _vm._l(_vm.autoridades, function(autoridade, index) {
                return _c("div", { key: index }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.check,
                        expression: "check"
                      }
                    ],
                    attrs: { type: "radio" },
                    domProps: {
                      value: index,
                      checked: _vm._q(_vm.check, index)
                    },
                    on: {
                      click: function($event) {
                        return _vm.changeAutoridade(autoridade)
                      },
                      change: function($event) {
                        _vm.check = index
                      }
                    }
                  }),
                  _vm._v(" " + _vm._s(autoridade.nome) + " "),
                  _c("b", [_vm._v(" " + _vm._s(autoridade.funcao) + " ")])
                ])
              }),
              0
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12" },
              [
                _c(
                  "v-tooltip",
                  {
                    attrs: {
                      effect: "scale",
                      placement: "top",
                      content: "Deve selecionar o Fecho"
                    }
                  },
                  [
                    _vm.registro.id_apresentacao
                      ? _c(
                          "a",
                          {
                            staticClass: "btn btn-success btn-block",
                            attrs: { disabled: _vm.autoridade.nome == null },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                return _vm.print()
                              }
                            }
                          },
                          [_vm._v("Imprimir")]
                        )
                      : _vm._e()
                  ]
                )
              ],
              1
            )
          ],
          1
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.errors.lenght
      ? _c(
          "section",
          { attrs: { id: "printpage" } },
          _vm._l(_vm.vias, function(via, index) {
            return _c("div", { key: index, staticClass: "a4 col-xs-6" }, [
              _c("div", { staticClass: "header" }, [
                _c("div", { staticClass: "text-bold-g" }, [
                  _vm._v("ESTADO DO PARANÁ")
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "text-bold-g" }, [
                  _vm._v("POLÍCIA MILITAR")
                ]),
                _vm._v(" "),
                _vm.opm_intermediaria
                  ? _c("div", { staticClass: "text-bold-m" }, [
                      _vm._v(_vm._s(_vm.opm_intermediaria))
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _c("div", { staticClass: "text-bold-m" }, [
                  _vm._v(_vm._s(_vm.registro.pessoa_unidade_lotacao_descricao))
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "content-mem" }, [
                _c("div", { staticClass: "col-xs-6 text-bold-m nopadding" }, [
                  _vm._v(
                    "Memorando nº " +
                      _vm._s(_vm.registro.sjd_ref) +
                      "/" +
                      _vm._s(_vm.registro.sigla)
                  )
                ]),
                _vm._v(" "),
                _vm.registro.data_ico
                  ? _c(
                      "div",
                      {
                        staticClass: "col-xs-6 text-bold-m text-right nopadding"
                      },
                      [
                        _vm._v(
                          "Em " +
                            _vm._s(_vm.registro.data_ico.dia) +
                            " de " +
                            _vm._s(_vm.registro.data_ico.mes_abr) +
                            " de " +
                            _vm._s(_vm.registro.data_ico.ano) +
                            "."
                        )
                      ]
                    )
                  : _c(
                      "div",
                      {
                        staticClass:
                          "col-xs-6 text-bold-m text-right nopadding text-red"
                      },
                      [_vm._v("DATA DE COMPARECIMENTO NÃO DEFINIDA")]
                    ),
                _vm._v(" "),
                _vm.pm
                  ? _c(
                      "div",
                      {
                        staticClass: "col-xs-12 text-bold-m nopadding",
                        staticStyle: { "padding-top": "10px !important" }
                      },
                      [
                        _vm._v(
                          "Ao " +
                            _vm._s(_vm.pm.cargo_ico) +
                            " " +
                            _vm._s(_vm.pm.quadro_ico) +
                            " " +
                            _vm._s(_vm.pm.nome_ico)
                        )
                      ]
                    )
                  : _vm._e(),
                _vm._v(" "),
                _vm._m(0, true),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "col-xs-12 nopadding",
                    staticStyle: { "padding-bottom": "25px !important" }
                  },
                  [
                    _c("span", { staticClass: "text-bold-m" }, [
                      _vm._v("Referência:")
                    ]),
                    _vm._v(
                      "  " + _vm._s(_vm.registro.documento_de_origem) + "."
                    )
                  ]
                ),
                _vm._v(" "),
                _c("p", [
                  _vm._v(
                    "\n                    Com fundamento no artigo 288,§ 3º do CPPM, \n                    determino o comparecimento de "
                  ),
                  _vm.pm
                    ? _c("span", [_vm._v(_vm._s(_vm.pm.tratamento_ico))])
                    : _vm._e(),
                  _vm._v(" em data de \n                    "),
                  _vm.registro.comparecimento_data
                    ? _c("span", [
                        _vm._v(
                          "\n                        " +
                            _vm._s(_vm.registro.comparecimento_data_ico.dia) +
                            "\n                        " +
                            _vm._s(_vm.registro.comparecimento_data_ico.mes) +
                            ". \n                        " +
                            _vm._s(
                              _vm.registro.comparecimento_data_ico.ano_abr
                            ) +
                            ", \n                    "
                        )
                      ])
                    : _c("span", { staticClass: "text-red" }, [
                        _vm._v("DATA DE COMPARECIMENTO NÃO DEFINIDA")
                      ]),
                  _vm._v(
                    "\n                    às " +
                      _vm._s(_vm.registro.comparecimento_hora_ico) +
                      ",\n                    no(a) " +
                      _vm._s(_vm.registro.comparecimento_local_txt) +
                      ",\n                    a fim de prestar depoimento em autos n° " +
                      _vm._s(_vm.registro.autos_numero) +
                      "\n                    na condição de " +
                      _vm._s(_vm.registro.condicao) +
                      ".\n                "
                  )
                ]),
                _vm._v(" "),
                _vm.registro.acusados
                  ? _c("div", [
                      _vm._v("Acusado(s): " + _vm._s(_vm.registro.acusados))
                    ])
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "ass" }, [
                _vm.autoridade
                  ? _c("div", [_vm._v(_vm._s(_vm.autoridade.nome) + ",")])
                  : _vm._e(),
                _vm._v(" "),
                _c("div", { staticClass: "text-bold-m" }, [
                  _vm._v(_vm._s(_vm.autoridade.funcao))
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row cert" }, [
                _c("div", { staticClass: "col-xs-6" }, [
                  _vm.registro.cod_notificacao
                    ? _c("table", { staticClass: "table-mem border" }, [
                        _c("tr", [
                          _c(
                            "td",
                            {
                              staticClass: "border text-bold-s center",
                              attrs: { colspan: "2" }
                            },
                            [
                              _vm._v(
                                "USO DO SJD (" +
                                  _vm._s(_vm.registro.cod_notificacao.base) +
                                  "/" +
                                  _vm._s(_vm.registro.data_ico.ano) +
                                  ")"
                              )
                            ]
                          )
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Notificado:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.notificado)
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Não notificado:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.naonotificado)
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Compareceu/Realizada:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.realizada)
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Compareceu/Cancelada:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.cancelada)
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Compareceu/Redesignada:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.redesignada)
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", { staticClass: "border text-bold-s" }, [
                            _vm._v("Não compareceu:")
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "border-l" }, [
                            _vm._v(
                              _vm._s(_vm.registro.cod_notificacao.naocompareceu)
                            )
                          ])
                        ])
                      ])
                    : _vm._e()
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-6" },
                  [via == 2 ? [_vm._m(1, true)] : [_vm._m(2, true)]],
                  2
                )
              ])
            ])
          }),
          0
        )
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "col-xs-12 nopadding",
        staticStyle: { "padding-bottom": "10px !important" }
      },
      [
        _c("span", { staticClass: "text-bold-m" }, [_vm._v("Assunto:")]),
        _vm._v("  Determinação para comparecimento.")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("table", { staticClass: "table-mem border" }, [
      _c("tr", [
        _c(
          "td",
          {
            staticClass: "border text-bold-m",
            staticStyle: { "text-align": "justify" },
            attrs: { colspan: "2" }
          },
          [
            _vm._v(
              "\n                                    ** Esta via deve ser carimbada no local da audiência e ser entregue no SJD após a apresentação do Militar Estadual\n                                "
            )
          ]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("table", { staticClass: "table-mem border" }, [
      _c("tr", [
        _c(
          "td",
          {
            staticClass: "border text-bold-s center",
            staticStyle: { height: "12px" },
            attrs: { colspan: "2" }
          },
          [_vm._v("CIENTE")]
        )
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Data:")]),
          _vm._v("  ______/______/__________")
        ])
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Horário:")]),
          _vm._v("  ______:______")
        ])
      ]),
      _vm._v(" "),
      _c("tr", [
        _c("td", [
          _c("span", { staticClass: "text-bold-s" }, [_vm._v("Ass.:")])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-23911582", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("075bf6e3", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Memorando.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Memorando.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Apresentacao/Memorando.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-23911582\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-23911582\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Apresentacao/Memorando.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-23911582"
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
Component.options.__file = "resources/assets/js/components/Apresentacao/Memorando.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-23911582", Component.options)
  } else {
    hotAPI.reload("data-v-23911582", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});