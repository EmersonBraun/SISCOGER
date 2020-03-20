webpackJsonp([2,40,41],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator__ = __webpack_require__("./node_modules/babel-runtime/regenerator/index.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Checkbox__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Checkbox.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Checkbox___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Vuestrap_Checkbox__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Datepicker__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Datepicker.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Datepicker___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__Vuestrap_Datepicker__);


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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { Checkbox: __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Checkbox__["Checkbox"], Datepicker: __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Datepicker__["Datepicker"] },
    props: {
        qtdMB: { type: Number, default: 5 },
        title: { type: String },
        name: { type: String },
        dproc: { type: String },
        idp: { type: String },
        ext: { type: Array, default: ['pdf'] },
        unique: { type: Boolean, default: true },
        show: { type: Boolean, default: false }
    },
    data: function data() {
        return {
            registro: {},
            file: '',
            uploaded: [],
            old: [],
            apagados: [],
            forUpload: false,
            error: [],
            progressBar: false,
            width: 0,
            only: false,
            headers: { 'Content-Type': 'multipart/form-data' },
            countup: 0,
            countap: 0,
            filetype: '',
            action: 'fileupload',
            data_arquivo: '',
            rg: '',
            nome_original: true,
            obs: '',
            mode: 'active'
        };
    },
    beforeMount: function beforeMount() {
        this.list();
        this.data_arquivo = this.$root.today;
    },

    watch: {
        countup: function countup() {
            this.verifyOnly;
        }
    },
    filters: {
        toMB: function toMB(value) {
            if (!value) return '';
            value = value / 1048576;
            return value.toFixed(2);
        },
        hasObs: function hasObs(value) {
            if (!value) return 'Não há';
            return value;
        }
    },
    computed: {
        // verificar se é upload unico
        verifyOnly: function verifyOnly() {
            this.only = this.unique == true && this.countup > 0 ? true : false;
        },
        verifyType: function verifyType() {
            this.filetype = this.file.type.split('/')[1];
            if (!this.ext.includes(this.filetype)) {
                this.error.push('Exten\xE7\xE3o inv\xE1lida! deve ser: ' + this.ext.join(', '));
                return false;
            } else {
                return true;
            }
        },
        verifySize: function verifySize() {
            var fileSize = this.file.size;
            var maxSize = 1048576 * this.qtdMB;
            if (fileSize > maxSize) {
                this.error.push('Tamanho excedido! deve ser menor que ' + this.qtdMB + 'MB ');
                return false;
            } else {
                return true;
            }
        },
        canDelete: function canDelete() {
            return this.$root.hasRole('admin');
        }
    },
    methods: {
        verifyFile: function verifyFile() {
            this.error = [];
            this.file = this.$refs.file.files[0];
            var type = this.verifyType;
            var size = this.verifySize;
            this.registro.name = this.file.name;
            this.forUpload = type && size ? true : false;
            if (!this.forUpload) this.file = '';
        },
        validateProps: function validateProps() {
            if (!this.name) console.warn('File: ???', 'Falta o nome do arquivo');else {
                if (!this.dproc) console.warn('File: ' + name, 'Falta o procedimento (dproc)');
                if (!this.idp) console.warn('File: ' + name, 'Falta o id do procedimento (idp)');
            }
        },
        createFile: function () {
            var _ref = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee() {
                var urlCreate, formData, url, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee$(_context) {
                    while (1) {
                        switch (_context.prev = _context.next) {
                            case 0:
                                urlCreate = this.$root.baseUrl + 'api/' + this.action + '/store';
                                formData = new FormData();

                                formData.append('file', this.file);
                                formData.append('name', this.name);
                                formData.append('rg', this.$root.dadoSession('rg'));
                                formData.append('id_proc', this.idp);
                                formData.append('proc', this.dproc);
                                formData.append('ext', this.filetype);
                                formData.append('nome_original', this.nome_original);
                                formData.append('data_arquivo', this.data_arquivo);
                                formData.append('obs', this.obs);

                                url = this.$root.baseUrl + 'api/' + this.module + '/create';
                                _context.prev = 12;
                                _context.next = 15;
                                return axios.post(urlCreate, formData, { headers: this.headers });

                            case 15:
                                response = _context.sent;

                                this.progress();
                                this.transation(response.data.success, 'create');
                                _context.next = 23;
                                break;

                            case 20:
                                _context.prev = 20;
                                _context.t0 = _context['catch'](12);

                                console.log(_context.t0);

                            case 23:
                            case 'end':
                                return _context.stop();
                        }
                    }
                }, _callee, this, [[12, 20]]);
            }));

            function createFile() {
                return _ref.apply(this, arguments);
            }

            return createFile;
        }(),
        create: function () {
            var _ref2 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee2() {
                var url, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee2$(_context2) {
                    while (1) {
                        switch (_context2.prev = _context2.next) {
                            case 0:
                                url = this.$root.baseUrl + 'api/' + this.module + '/create';
                                _context2.prev = 1;
                                _context2.next = 4;
                                return axios.post(url, this.registro);

                            case 4:
                                response = _context2.sent;
                                _context2.next = 10;
                                break;

                            case 7:
                                _context2.prev = 7;
                                _context2.t0 = _context2['catch'](1);

                                console.log(_context2.t0);

                            case 10:
                            case 'end':
                                return _context2.stop();
                        }
                    }
                }, _callee2, this, [[1, 7]]);
            }));

            function create() {
                return _ref2.apply(this, arguments);
            }

            return create;
        }(),
        list: function () {
            var _ref3 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee3() {
                var url, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee3$(_context3) {
                    while (1) {
                        switch (_context3.prev = _context3.next) {
                            case 0:
                                this.validateProps();

                                if (!(this.dproc && this.idp && this.name)) {
                                    _context3.next = 13;
                                    break;
                                }

                                url = this.$root.baseUrl + 'api/' + this.action + '/list/' + this.dproc + '/' + this.idp + '/' + this.name;
                                _context3.prev = 3;
                                _context3.next = 6;
                                return axios.get(url);

                            case 6:
                                response = _context3.sent;

                                if (response) {
                                    this.uploaded = response.data.list;
                                    this.old = response.data.old;
                                    this.apagados = response.data.apagados;
                                    this.countup = response.data.list.length;
                                    this.countap = response.data.list.length;
                                }
                                _context3.next = 13;
                                break;

                            case 10:
                                _context3.prev = 10;
                                _context3.t0 = _context3['catch'](3);

                                console.log(_context3.t0);

                            case 13:
                            case 'end':
                                return _context3.stop();
                        }
                    }
                }, _callee3, this, [[3, 10]]);
            }));

            function list() {
                return _ref3.apply(this, arguments);
            }

            return list;
        }(),
        showFile: function showFile(hash) {
            var urlShow = this.$root.baseUrl + 'api/' + this.action + '/show/' + this.dproc + '/' + this.idp + '/' + this.name + '/' + hash;
            window.open(urlShow, "_blank");
        },
        downloadFile: function downloadFile(id) {
            var urlIndex = this.$root.baseUrl + 'api/' + this.action + '/download/' + id;
            window.open(urlIndex, "_blank");
        },
        deleteFile: function () {
            var _ref4 = _asyncToGenerator( /*#__PURE__*/__WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.mark(function _callee4(id) {
                var forceDelete = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
                var action, url, response;
                return __WEBPACK_IMPORTED_MODULE_0_babel_runtime_regenerator___default.a.wrap(function _callee4$(_context4) {
                    while (1) {
                        switch (_context4.prev = _context4.next) {
                            case 0:
                                if (!confirm('Tem certeza?')) {
                                    _context4.next = 13;
                                    break;
                                }

                                action = forceDelete ? 'destroy' : 'delete';
                                url = this.$root.baseUrl + 'api/' + this.action + '/' + action + '/' + id;
                                _context4.prev = 3;
                                _context4.next = 6;
                                return axios.delete(url);

                            case 6:
                                response = _context4.sent;

                                if (response) this.transation(response.data.success, 'delete');
                                _context4.next = 13;
                                break;

                            case 10:
                                _context4.prev = 10;
                                _context4.t0 = _context4['catch'](3);

                                console.log(_context4.t0);

                            case 13:
                            case 'end':
                                return _context4.stop();
                        }
                    }
                }, _callee4, this, [[3, 10]]);
            }));

            function deleteFile(_x2) {
                return _ref4.apply(this, arguments);
            }

            return deleteFile;
        }(),
        cancelFile: function cancelFile() {
            this.file = '';
            this.forUpload = false;
        },
        transation: function transation(happen, type) {
            var msg = this.words(type);
            if (happen) {
                // se deu certo
                this.list();
                this.$root.msg(msg.success, 'success');
            } else {
                // se falhou
                this.$root.msg(msg.fail, 'danger');
            }
        },
        words: function words(type) {
            if (type == 'create') return { success: 'Inserido com sucesso', fail: 'Erro ao inserir' };
            if (type == 'delete') return { success: 'Apagado com sucesso', fail: 'Erro ao apagar' };
        },
        progress: function progress() {
            var _this = this;

            this.progressBar = true;
            setTimeout(function () {
                if (_this.width < 100) {
                    _this.width += 5;
                    _this.progress();
                } else {
                    _this.width = 0;
                    _this.cancelFile();
                    _this.progressBar = false;
                }
            }, 25);
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
    value: { default: false },
    check: { type: Boolean, default: false }
  },
  data: function data() {
    return {
      checked: this.value === this.trueValue || this.check
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

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue":
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

// import $ from './utils/NodeList.js'
// import {TheMask} from 'vue-the-mask'
/* harmony default export */ __webpack_exports__["default"] = ({
  // components: {TheMask},
  props: {
    value: { type: String, default: '' },
    format: { default: 'dd/MM/yyyy' },
    disabledDaysOfWeek: { type: Array, default: function _default() {
        return [0, 6];
      }
    },
    width: { type: String, default: '200px' },
    clearButton: { type: Boolean, default: false },
    lang: { type: String, default: navigator.language },
    placeholder: { type: String, default: 'Selecione' },
    name: { type: String, default: null }
  },
  data: function data() {
    return {
      currDate: new Date(),
      dateRange: [],
      decadeRange: [],
      displayDayView: false,
      displayMonthView: false,
      displayYearView: false,
      val: this.value
    };
  },

  watch: {
    val: function val(_val) {
      this.$emit('input', _val);
    },
    currDate: function currDate() {
      this.getDateRange();
    }
  },
  computed: {
    text: function text() {
      return this.translations(this.lang);
    }
  },
  methods: {
    translations: function translations() {
      var lang = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'en';

      var text = {
        daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sa'],
        limit: 'Limite atingido ({{limit}} itens máximo).',
        loading: 'Carregando...',
        minLength: 'Min. comprimento',
        months: ['Janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
        notSelected: 'Nada selecionado',
        required: 'Obrigatório',
        search: 'Busca'
      };
      return window.VueStrapLang ? window.VueStrapLang(lang) : text;
    },
    changeToToday: function changeToToday() {
      this.val = this.today();
    },
    cleanVal: function cleanVal() {
      this.val = '';
    },
    today: function today() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = dd + '/' + mm + '/' + yyyy;
      return today;
    },
    close: function close() {
      this.displayDayView = this.displayMonthView = this.displayYearView = false;
    },
    inputClick: function inputClick() {
      this.currDate = this.parse(this.val) || this.parse(new Date());
      if (this.displayMonthView || this.displayYearView) {
        this.displayDayView = false;
      } else {
        this.displayDayView = !this.displayDayView;
      }
    },
    preNextDecadeClick: function preNextDecadeClick(flag) {
      var year = this.currDate.getFullYear();
      var months = this.currDate.getMonth();
      var date = this.currDate.getDate();
      if (flag === 0) {
        this.currDate = new Date(year - 10, months, date);
      } else {
        this.currDate = new Date(year + 10, months, date);
      }
    },
    preNextMonthClick: function preNextMonthClick(flag) {
      var year = this.currDate.getFullYear();
      var month = this.currDate.getMonth();
      var date = this.currDate.getDate();
      if (flag === 0) {
        var preMonth = this.getYearMonth(year, month - 1);
        this.currDate = new Date(preMonth.year, preMonth.month, date);
      } else {
        var nextMonth = this.getYearMonth(year, month + 1);
        this.currDate = new Date(nextMonth.year, nextMonth.month, date);
      }
    },
    preNextYearClick: function preNextYearClick(flag) {
      var year = this.currDate.getFullYear();
      var months = this.currDate.getMonth();
      var date = this.currDate.getDate();
      if (flag === 0) {
        this.currDate = new Date(year - 1, months, date);
      } else {
        this.currDate = new Date(year + 1, months, date);
      }
    },
    yearSelect: function yearSelect(year) {
      this.displayYearView = false;
      this.displayMonthView = true;
      this.currDate = new Date(year, this.currDate.getMonth(), this.currDate.getDate());
    },
    daySelect: function daySelect(date, el) {
      if (this.$el.classList[0] === 'datepicker-item-disable') {
        return false;
      } else {
        this.currDate = date;
        this.val = this.stringify(this.currDate);
        this.displayDayView = false;
      }
    },
    switchMonthView: function switchMonthView() {
      this.displayDayView = false;
      this.displayMonthView = true;
    },
    switchDecadeView: function switchDecadeView() {
      this.displayMonthView = false;
      this.displayYearView = true;
    },
    monthSelect: function monthSelect(index) {
      this.displayMonthView = false;
      this.displayDayView = true;
      this.currDate = new Date(this.currDate.getFullYear(), index, this.currDate.getDate());
    },
    getYearMonth: function getYearMonth(year, month) {
      if (month > 11) {
        year++;
        month = 0;
      } else if (month < 0) {
        year--;
        month = 11;
      }
      return { year: year, month: month };
    },
    stringifyDecadeHeader: function stringifyDecadeHeader(date) {
      var yearStr = date.getFullYear().toString();
      var firstYearOfDecade = yearStr.substring(0, yearStr.length - 1) + 0;
      var lastYearOfDecade = parseInt(firstYearOfDecade, 10) + 10;
      return firstYearOfDecade + '-' + lastYearOfDecade;
    },
    stringifyDayHeader: function stringifyDayHeader(date) {
      return this.text.months[date.getMonth()] + ' ' + date.getFullYear();
    },
    parseMonth: function parseMonth(date) {
      return this.text.months[date.getMonth()];
    },
    stringifyYearHeader: function stringifyYearHeader(date) {
      return date.getFullYear();
    },
    stringify: function stringify(date) {
      var format = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.format;

      if (!date) date = this.parse();
      if (!date) return '';
      var year = date.getFullYear();
      var month = date.getMonth() + 1;
      var day = date.getDate();
      var monthName = this.parseMonth(date);
      return format.replace(/yyyy/g, year).replace(/MMMM/g, monthName).replace(/MMM/g, monthName.substring(0, 3)).replace(/MM/g, ('0' + month).slice(-2)).replace(/dd/g, ('0' + day).slice(-2)).replace(/yy/g, year).replace(/M(?!a)/g, month).replace(/d/g, day);
    },
    parse: function parse() {
      var str = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.val;

      var date = void 0;
      if (str.length === 10 && (this.format === 'dd-MM-yyyy' || this.format === 'dd/MM/yyyy')) {
        date = new Date(str.substring(6, 10), str.substring(3, 5), str.substring(0, 2));
      } else {
        date = new Date(str);
      }
      return isNaN(date.getFullYear()) ? new Date() : date;
    },
    getDayCount: function getDayCount(year, month) {
      var dict = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
      if (month === 1) {
        if (year % 400 === 0 || year % 4 === 0 && year % 100 !== 0) {
          return 29;
        }
      }
      return dict[month];
    },
    getDateRange: function getDateRange() {
      var _this = this;

      this.dateRange = [];
      this.decadeRange = [];
      var time = {
        year: this.currDate.getFullYear(),
        month: this.currDate.getMonth(),
        day: this.currDate.getDate()
      };
      var yearStr = time.year.toString();
      var firstYearOfDecade = yearStr.substring(0, yearStr.length - 1) + 0 - 1;
      for (var i = 0; i < 12; i++) {
        this.decadeRange.push({
          text: firstYearOfDecade + i
        });
      }
      var currMonthFirstDay = new Date(time.year, time.month, 1);
      var firstDayWeek = currMonthFirstDay.getDay() + 1;
      if (firstDayWeek === 0) {
        firstDayWeek = 7;
      }
      var dayCount = this.getDayCount(time.year, time.month);
      if (firstDayWeek > 1) {
        var preMonth = this.getYearMonth(time.year, time.month - 1);
        var prevMonthDayCount = this.getDayCount(preMonth.year, preMonth.month);
        for (var _i = 1; _i < firstDayWeek; _i++) {
          var dayText = prevMonthDayCount - firstDayWeek + _i + 1;
          this.dateRange.push({
            text: dayText,
            date: new Date(preMonth.year, preMonth.month, dayText),
            sclass: 'datepicker-item-gray'
          });
        }
      }

      var _loop = function _loop(_i2) {
        var date = new Date(time.year, time.month, _i2);
        var week = date.getDay();
        var sclass = '';
        _this.disabledDaysOfWeek.forEach(function (el) {
          if (week === parseInt(el, 10)) sclass = 'datepicker-item-disable';
        });
        if (_i2 === time.day) {
          if (_this.val) {
            var valueDate = _this.parse(_this.val);
            if (valueDate) {
              if (valueDate.getFullYear() === time.year && valueDate.getMonth() === time.month) {
                sclass = 'datepicker-dateRange-item-active';
              }
            }
          }
        }
        _this.dateRange.push({
          text: _i2,
          date: date,
          sclass: sclass
        });
      };

      for (var _i2 = 1; _i2 <= dayCount; _i2++) {
        _loop(_i2);
      }
      if (this.dateRange.length < 42) {
        var nextMonthNeed = 42 - this.dateRange.length;
        var nextMonth = this.getYearMonth(time.year, time.month + 1);
        for (var _i3 = 1; _i3 <= nextMonthNeed; _i3++) {
          this.dateRange.push({
            text: _i3,
            date: new Date(nextMonth.year, nextMonth.month, _i3),
            sclass: 'datepicker-item-gray'
          });
        }
      }
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    var el = this.$el;
    this._blur = function (e) {
      if (!el.contains(e.target)) _this2.close();
    };
    this.$emit('child-created', this);
    this.currDate = this.parse(this.val) || this.parse(new Date());
    window.addEventListener('click', this._blur);
  },
  beforeDestroy: function beforeDestroy() {
    window.removeEventListner('click', this._blur);
  }
});

/***/ }),

/***/ "./node_modules/babel-runtime/regenerator/index.js":
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./node_modules/regenerator-runtime/runtime-module.js");


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00ba1cd1\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Checkbox.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\nlabel.checkbox[data-v-00ba1cd1] {\n  position: relative;\n  padding-left: 18px;\n}\nlabel.checkbox > input[data-v-00ba1cd1] {\n  box-sizing: border-box;\n  position: absolute;\n  z-index: -1;\n  padding: 0;\n  opacity: 0;\n  margin: 0;\n}\nlabel.checkbox > .icon[data-v-00ba1cd1] {\n  position: absolute;\n  top: .2rem;\n  left: 0;\n  display: block;\n  width: 1.4rem;\n  height: 1.4rem;\n  line-height:1rem;\n  text-align: center;\n  user-select: none;\n  border-radius: .35rem;\n  background-repeat: no-repeat;\n  background-position: center center;\n  background-size: 50% 50%;\n}\nlabel.checkbox:not(.active) > .icon[data-v-00ba1cd1] {\n  background-color: #ddd;\n  border: 1px solid #bbb;\n}\nlabel.checkbox > input:focus ~ .icon[data-v-00ba1cd1] {\n  outline: 0;\n  border: 1px solid #66afe9;\n  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);\n}\nlabel.checkbox.active > .icon[data-v-00ba1cd1] {\n  background-size: 1rem 1rem;\n  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNyIgaGVpZ2h0PSI3Ij48cGF0aCBmaWxsPSIjZmZmIiBkPSJtNS43MywwLjUybC0zLjEyNDIyLDMuMzQxNjFsLTEuMzM4OTUsLTEuNDMyMTJsLTEuMjQ5NjksMS4zMzY2NWwyLjU4ODYzLDIuNzY4NzZsNC4zNzM5LC00LjY3ODI2bC0xLjI0OTY5LC0xLjMzNjY1bDAsMGwwLjAwMDAyLDAuMDAwMDF6Ii8+PC9zdmc+);\n}\nlabel.checkbox.active .btn-default[data-v-00ba1cd1] { filter: brightness(75%);\n}\nlabel.checkbox.disabled[data-v-00ba1cd1],\nlabel.checkbox.readonly[data-v-00ba1cd1],\n.btn.readonly[data-v-00ba1cd1] {\n  filter: alpha(opacity=65);\n  box-shadow: none;\n  opacity: .65;\n}\nlabel.btn > input[type=checkbox][data-v-00ba1cd1] {\n  position: absolute;\n  clip: rect(0,0,0,0);\n  pointer-events: none;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.bgicon{\n    color: white;\n}\n.align-self-end {\n    -ms-flex-item-align: end !important;\n    align-self: flex-end !important;\n}\n.col {\n    -ms-flex-preferred-size: 0;\n    flex-basis: 0;\n    -ms-flex-positive: 1;\n    flex-grow: 1;\n    max-width: 100%;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.datepicker[data-v-56b234ca] {\n  position: relative;\n  display: inline-block;\n}\ninput.datepicker-input.with-reset-button[data-v-56b234ca] {\n  padding-right: 25px;\n}\n.datepicker > button.close[data-v-56b234ca] {\n  position: absolute;\n  top: 0;\n  right: 0;\n  outline: none;\n  z-index: 2;\n  display: block;\n  width: 34px;\n  height: 34px;\n  line-height: 34px;\n  text-align: center;\n}\n.datepicker > button.close[data-v-56b234ca]:focus {\n  opacity: .2;\n}\n.datepicker-popup[data-v-56b234ca] {\n  position: absolute;\n  border: 1px solid #ccc;\n  border-radius: 5px;\n  background: #fff;\n  margin-top: 2px;\n  z-index: 1000;\n  box-shadow: 0 6px 12px rgba(0,0,0,0.175);\n}\n.datepicker-inner[data-v-56b234ca] {\n  width: 218px;\n}\n.datepicker-body[data-v-56b234ca] {\n  padding: 10px 10px;\n}\n.datepicker-ctrl p[data-v-56b234ca],\n.datepicker-ctrl span[data-v-56b234ca],\n.datepicker-body span[data-v-56b234ca] {\n  display: inline-block;\n  width: 28px;\n  line-height: 28px;\n  height: 28px;\n  border-radius: 4px;\n}\n.datepicker-ctrl p[data-v-56b234ca] {\n  width: 65%;\n}\n.datepicker-ctrl span[data-v-56b234ca] {\n  position: absolute;\n}\n.datepicker-body span[data-v-56b234ca] {\n  text-align: center;\n}\n.datepicker-monthRange span[data-v-56b234ca] {\n  width: 48px;\n  height: 50px;\n  line-height: 45px;\n}\n.datepicker-item-disable[data-v-56b234ca] {\n  background-color: white!important;\n  cursor: not-allowed!important;\n}\n.decadeRange span[data-v-56b234ca]:first-child,\n.decadeRange span[data-v-56b234ca]:last-child,\n.datepicker-item-disable[data-v-56b234ca],\n.datepicker-item-gray[data-v-56b234ca] {\n  color: #999;\n}\n.datepicker-dateRange-item-active[data-v-56b234ca]:hover,\n.datepicker-dateRange-item-active[data-v-56b234ca] {\n  background: rgb(50, 118, 177)!important;\n  color: white!important;\n}\n.datepicker-monthRange[data-v-56b234ca] {\n  margin-top: 10px\n}\n.datepicker-monthRange span[data-v-56b234ca],\n.datepicker-ctrl span[data-v-56b234ca],\n.datepicker-ctrl p[data-v-56b234ca],\n.datepicker-dateRange span[data-v-56b234ca] {\n  cursor: pointer;\n}\n.datepicker-monthRange span[data-v-56b234ca]:hover,\n.datepicker-ctrl p[data-v-56b234ca]:hover,\n.datepicker-ctrl i[data-v-56b234ca]:hover,\n.datepicker-dateRange span[data-v-56b234ca]:hover,\n.datepicker-dateRange-item-hover[data-v-56b234ca] {\n  background-color : #eeeeee;\n}\n.datepicker-weekRange span[data-v-56b234ca] {\n  font-weight: bold;\n}\n.datepicker-label[data-v-56b234ca] {\n  background-color: #f8f8f8;\n  font-weight: 700;\n  padding: 7px 0;\n  text-align: center;\n}\n.datepicker-ctrl[data-v-56b234ca] {\n  position: relative;\n  height: 30px;\n  line-height: 30px;\n  font-weight: bold;\n  text-align: center;\n}\n.month-btn[data-v-56b234ca] {\n  font-weight: bold;\n  -webkit-user-select:none;\n  -moz-user-select:none;\n  -ms-user-select:none;\n  user-select:none;\n}\n.datepicker-preBtn[data-v-56b234ca] {\n  left: 2px;\n}\n.datepicker-nextBtn[data-v-56b234ca] {\n  right: 2px;\n}\n.btne[data-v-56b234ca]{\n    cursor: pointer;\n    display: flex;\n    align-items: center;\n    margin-bottom: 0;\n    font-size: 1rem;\n    font-weight: 400;\n    line-height: 1.5;\n    color: #495057;\n    text-align: center;\n    white-space: nowrap;\n    background-color: #e9ecef;\n    border: 1px solid #ced4da;\n    padding: 5px;\n}\n.caixa[data-v-56b234ca]{\n    width: 100%;\n    display: flex;\n    flex-flow: column;\n    z-index: 1;\n}\n.append[data-v-56b234ca]{\n    display: flex;\n    align-self: flex-end;\n    position: absolute;\n    z-index: 2;\n}\n\n", ""]);

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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-14c5409f\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      { staticClass: "card bordaform" },
      [
        _vm.title
          ? _c("div", { staticClass: "card-header" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-sm-10" }, [
                  _c("h4", [_vm._v(_vm._s(_vm.title))])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col align-self-end" }, [
                  _c("div", { staticClass: "btn-group" }, [
                    _c(
                      "a",
                      {
                        staticClass: "btn",
                        class: _vm.mode == "old" ? "btn-info" : "btn-default",
                        on: {
                          click: function($event) {
                            _vm.mode = "old"
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                            Antigos\n                        "
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass: "btn",
                        class:
                          _vm.mode == "active" ? "btn-info" : "btn-default",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            _vm.mode = "active"
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                            Ativos\n                        "
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _vm.canDelete
                      ? _c(
                          "a",
                          {
                            staticClass: "btn",
                            class:
                              _vm.mode == "deleted"
                                ? "btn-info"
                                : "btn-default",
                            on: {
                              click: function($event) {
                                _vm.mode = "deleted"
                              }
                            }
                          },
                          [
                            _vm._v(
                              "\n                            Apagados\n                        "
                            )
                          ]
                        )
                      : _vm._e()
                  ])
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        !_vm.only && !_vm.show
          ? _c("div", { staticClass: "card-body" }, [
              !_vm.forUpload && !_vm.show
                ? _c(
                    "label",
                    {
                      staticClass: "btn btn-primary btn-block bgicon",
                      attrs: { for: _vm.name }
                    },
                    [
                      _vm._v(
                        "\n                Selecionar arquivo\n                "
                      ),
                      _c("input", {
                        ref: "file",
                        staticStyle: { display: "none" },
                        attrs: { id: _vm.name, name: _vm.name, type: "file" },
                        on: { change: _vm.verifyFile }
                      })
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.forUpload
                ? _c("div", { staticClass: "row" }, [
                    _c(
                      "div",
                      { staticClass: "col-sm-3" },
                      [
                        _c("label", { attrs: { for: "data_arquivo" } }, [
                          _vm._v("Data do documento")
                        ]),
                        _c("br"),
                        _vm._v(" "),
                        _c("v-datepicker", {
                          attrs: {
                            name: "data_arquivo",
                            placeholder: "dd/mm/aaaa",
                            "clear-button": ""
                          },
                          model: {
                            value: _vm.data_arquivo,
                            callback: function($$v) {
                              _vm.data_arquivo = $$v
                            },
                            expression: "data_arquivo"
                          }
                        })
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("label", { attrs: { for: "data" } }, [
                        _vm._v("Observações")
                      ]),
                      _c("br"),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.obs,
                            expression: "obs"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { name: "obs", type: "text" },
                        domProps: { value: _vm.obs },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.obs = $event.target.value
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("label", { attrs: { for: "data" } }, [
                        _vm._v("Nome Original:")
                      ]),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.registro.name,
                            expression: "registro.name"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { name: "obs", type: "text" },
                        domProps: { value: _vm.registro.name },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.registro, "name", $event.target.value)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("label", { attrs: { for: "data" } }, [
                        _vm._v("Ações")
                      ]),
                      _c("br"),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass: "btn btn-danger bgicon",
                          staticStyle: { color: "white" },
                          on: {
                            click: function($event) {
                              return _vm.cancelFile()
                            }
                          }
                        },
                        [
                          _c("i", { staticClass: "fa fa-undo" }),
                          _vm._v(" Cancelar\n                    ")
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass: "btn btn-primary bgicon",
                          staticStyle: { color: "white" },
                          on: {
                            click: function($event) {
                              return _vm.createFile()
                            }
                          }
                        },
                        [
                          _c("i", { staticClass: "fa fa-cloud-upload" }),
                          _vm._v(" Upload\n                    ")
                        ]
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.error.length
                ? _c(
                    "div",
                    { staticStyle: { color: "red" } },
                    _vm._l(_vm.error, function(e, index) {
                      return _c("p", { key: index }, [_vm._v(_vm._s(e))])
                    }),
                    0
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.progressBar
                ? _c(
                    "div",
                    {
                      staticClass: "progress",
                      staticStyle: { "padding-top": "3px" }
                    },
                    [
                      _c("div", {
                        staticClass: "progress-bar",
                        style: { width: _vm.width + "%" },
                        attrs: {
                          role: "progressbar",
                          "aria-valuenow": _vm.width,
                          "aria-valuemin": "0",
                          "aria-valuemax": "100"
                        }
                      })
                    ]
                  )
                : _vm._e()
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.mode == "old"
          ? [
              _c("div", { staticClass: "card-footer" }, [
                _vm.old.length
                  ? _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _c("thead", [
                            _c("tr", [
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Nome aquivo")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Ref/Ano")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Tamanho - Ext.")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Data")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-3" }, [
                                _vm._v("Obs.")
                              ]),
                              _vm._v(" "),
                              !_vm.show
                                ? _c("th", { staticClass: "col-sm-2" }, [
                                    _vm._v("Ações")
                                  ])
                                : _vm._e()
                            ])
                          ]),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.old, function(o, index) {
                              return _c("tr", { key: index }, [
                                _c("td", [_vm._v(_vm._s(o.name))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(o.sjd_ref) +
                                      "/" +
                                      _vm._s(o.sjd_ref_ano)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm._f("toMB")(o.size)) +
                                      " MB - " +
                                      _vm._s(o.mime)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(o.data_arquivo))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("hasObs")(o.obs)))
                                ]),
                                _vm._v(" "),
                                !_vm.show
                                  ? _c("td", [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "btn-group",
                                          attrs: {
                                            role: "group",
                                            "aria-label": "First group"
                                          }
                                        },
                                        [
                                          _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-primary",
                                              staticStyle: { color: "white" },
                                              attrs: {
                                                type: "button",
                                                href: o.path,
                                                target: "_black"
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-eye"
                                              }),
                                              _vm._v(
                                                " Ver\n                                            "
                                              )
                                            ]
                                          )
                                        ]
                                      )
                                    ])
                                  : _vm._e()
                              ])
                            }),
                            0
                          )
                        ])
                      ])
                    ])
                  : _c("div", { staticClass: "row" }, [_vm._m(0)])
              ])
            ]
          : _vm._e(),
        _vm._v(" "),
        _vm.mode == "active"
          ? [
              _c("div", { staticClass: "card-footer" }, [
                _vm.uploaded.length
                  ? _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _c("thead", [
                            _c("tr", [
                              !_vm.only
                                ? _c("th", { staticClass: "col-sm-1" }, [
                                    _vm._v("#")
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Nome aquivo")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Ref/Ano")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-2" }, [
                                _vm._v("Tamanho - Ext.")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-1" }, [
                                _vm._v("Data")
                              ]),
                              _vm._v(" "),
                              _c("th", { staticClass: "col-sm-3" }, [
                                _vm._v("Obs.")
                              ]),
                              _vm._v(" "),
                              !_vm.show
                                ? _c("th", { staticClass: "col-sm-2" }, [
                                    _vm._v("Ações")
                                  ])
                                : _vm._e()
                            ])
                          ]),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.uploaded, function(u, index) {
                              return _c("tr", { key: index }, [
                                !_vm.only
                                  ? _c("td", [_vm._v(_vm._s(u.id))])
                                  : _vm._e(),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.name))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(u.sjd_ref) +
                                      "/" +
                                      _vm._s(u.sjd_ref_ano)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm._f("toMB")(u.size)) +
                                      " MB - " +
                                      _vm._s(u.mime)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(u.data_arquivo))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("hasObs")(u.obs)))
                                ]),
                                _vm._v(" "),
                                !_vm.show
                                  ? _c("td", [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "btn-group",
                                          attrs: {
                                            role: "group",
                                            "aria-label": "First group"
                                          }
                                        },
                                        [
                                          _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-primary",
                                              staticStyle: { color: "white" },
                                              attrs: {
                                                type: "button",
                                                target: "_black"
                                              },
                                              on: {
                                                click: function($event) {
                                                  return _vm.showFile(u.hash)
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-eye"
                                              }),
                                              _vm._v(
                                                " Ver\n                                            "
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-success",
                                              staticStyle: { color: "white" },
                                              attrs: {
                                                type: "button",
                                                target: "_black"
                                              },
                                              on: {
                                                click: function($event) {
                                                  return _vm.downloadFile(u.id)
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-download"
                                              }),
                                              _vm._v(
                                                " Download\n                                            "
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          u.deleted_at == null
                                            ? _c(
                                                "a",
                                                {
                                                  staticClass: "btn btn-danger",
                                                  staticStyle: {
                                                    color: "white"
                                                  },
                                                  attrs: { type: "button" },
                                                  on: {
                                                    click: function($event) {
                                                      return _vm.deleteFile(
                                                        u.id,
                                                        false
                                                      )
                                                    }
                                                  }
                                                },
                                                [
                                                  _c("i", {
                                                    staticClass: "fa fa-trash"
                                                  }),
                                                  _vm._v(
                                                    " Apagar\n                                            "
                                                  )
                                                ]
                                              )
                                            : _vm._e()
                                        ]
                                      )
                                    ])
                                  : _vm._e()
                              ])
                            }),
                            0
                          )
                        ])
                      ])
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm._m(1)
              ])
            ]
          : _vm._e(),
        _vm._v(" "),
        _vm.mode == "deleted"
          ? [
              _c("div", { staticClass: "card-footer" }, [
                _vm.apagados.length
                  ? _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("table", { staticClass: "table table-hover" }, [
                          _vm._m(2),
                          _vm._v(" "),
                          _c(
                            "tbody",
                            _vm._l(_vm.apagados, function(a, i) {
                              return _c("tr", { key: i }, [
                                _c("td", [_vm._v(_vm._s(a.id))]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.name))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(a.sjd_ref) +
                                      "/" +
                                      _vm._s(a.sjd_ref_ano)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm._f("toMB")(a.size)) +
                                      " MB - " +
                                      _vm._s(a.mime)
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(a.data_arquivo))]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm._f("hasObs")(a.obs)))
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _c(
                                    "div",
                                    {
                                      staticClass: "btn-group",
                                      attrs: {
                                        role: "group",
                                        "aria-label": "First group"
                                      }
                                    },
                                    [
                                      _c(
                                        "a",
                                        {
                                          staticClass: "btn btn-primary",
                                          staticStyle: { color: "white" },
                                          attrs: {
                                            type: "button",
                                            target: "_black"
                                          },
                                          on: {
                                            click: function($event) {
                                              return _vm.showFile(a.hash)
                                            }
                                          }
                                        },
                                        [
                                          _c("i", { staticClass: "fa fa-eye" }),
                                          _vm._v(
                                            " Ver\n                                            "
                                          )
                                        ]
                                      ),
                                      _vm._v(" "),
                                      !_vm.show
                                        ? _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-success",
                                              staticStyle: { color: "white" },
                                              attrs: {
                                                type: "button",
                                                target: "_black"
                                              },
                                              on: {
                                                click: function($event) {
                                                  return _vm.downloadFile(
                                                    _vm.u.id
                                                  )
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-download"
                                              }),
                                              _vm._v(
                                                " Download\n                                            "
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      !_vm.show
                                        ? _c(
                                            "a",
                                            {
                                              staticClass: "btn btn-danger",
                                              staticStyle: { color: "white" },
                                              attrs: { type: "button" },
                                              on: {
                                                click: function($event) {
                                                  return _vm.deleteFile(
                                                    a.id,
                                                    true
                                                  )
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-trash"
                                              }),
                                              _vm._v(
                                                " Destruir\n                                            "
                                              )
                                            ]
                                          )
                                        : _vm._e()
                                    ]
                                  )
                                ])
                              ])
                            }),
                            0
                          )
                        ])
                      ])
                    ])
                  : _c("div", { staticClass: "row" }, [_vm._m(3)])
              ])
            ]
          : _vm._e()
      ],
      2
    ),
    _vm._v(" "),
    _c("br")
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-12" }, [
      _c("h4", [_vm._v("Não há arquivo")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-sm-12" }, [
        _c("h4", [_vm._v("Não há arquivo")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Nome aquivo")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("Ref/Ano")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Tamanho - Ext.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-1" }, [_vm._v("Data")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-3" }, [_vm._v("Obs.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-sm-2" }, [_vm._v("Ações")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-12" }, [
      _c("h4", [_vm._v("Não há arquivo")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-14c5409f", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-56b234ca\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "input-group caixa" }, [
      _c("input", {
        staticClass: "form-control",
        class: { "with-reset-button": _vm.clearButton },
        staticStyle: { width: "100%" },
        attrs: {
          type: "text",
          placeholder: _vm.placeholder,
          readonly: "",
          name: _vm.name
        },
        domProps: { value: _vm.val },
        on: {
          click: _vm.inputClick,
          input: function($event) {
            return this.$emit("update:" + _vm.name, $event.target.val)
          }
        }
      }),
      _vm._v(" "),
      _c("div", { staticClass: "append" }, [
        !_vm.val
          ? _c(
              "span",
              { staticClass: "btne", on: { click: _vm.changeToToday } },
              [_vm._v("Hoje ")]
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.clearButton && _vm.val
          ? _c("span", { staticClass: "btne", on: { click: _vm.cleanVal } }, [
              _vm._v("   X   ")
            ])
          : _vm._e()
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.displayDayView,
            expression: "displayDayView"
          }
        ],
        staticClass: "datepicker-popup"
      },
      [
        _c("div", { staticClass: "datepicker-inner" }, [
          _c("div", { staticClass: "datepicker-body" }, [
            _c("div", { staticClass: "datepicker-ctrl" }, [
              _c("span", {
                staticClass: "datepicker-preBtn fa fa-angle-left",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextMonthClick(0)
                  }
                }
              }),
              _vm._v(" "),
              _c("span", {
                staticClass: "datepicker-nextBtn fa fa-angle-right",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextMonthClick(1)
                  }
                }
              }),
              _vm._v(" "),
              _c("p", { on: { click: _vm.switchMonthView } }, [
                _vm._v(_vm._s(_vm.stringifyDayHeader(_vm.currDate)))
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "datepicker-weekRange" },
              _vm._l(_vm.text.daysOfWeek, function(w, index) {
                return _c("span", { key: index }, [_vm._v(_vm._s(w))])
              }),
              0
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "datepicker-dateRange" },
              _vm._l(_vm.dateRange, function(d, index) {
                return _c(
                  "span",
                  {
                    key: index,
                    class: d.sclass,
                    on: {
                      click: function($event) {
                        return _vm.daySelect(d.date, this)
                      }
                    }
                  },
                  [_vm._v(_vm._s(d.text))]
                )
              }),
              0
            )
          ])
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.displayMonthView,
            expression: "displayMonthView"
          }
        ],
        staticClass: "datepicker-popup"
      },
      [
        _c("div", { staticClass: "datepicker-inner" }, [
          _c("div", { staticClass: "datepicker-body" }, [
            _c("div", { staticClass: "datepicker-ctrl" }, [
              _c("span", {
                staticClass: "datepicker-preBtn fa fa-angle-left",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextYearClick(0)
                  }
                }
              }),
              _vm._v(" "),
              _c("span", {
                staticClass: "datepicker-nextBtn fa fa-angle-right",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextYearClick(1)
                  }
                }
              }),
              _vm._v(" "),
              _c("p", { on: { click: _vm.switchDecadeView } }, [
                _vm._v(_vm._s(_vm.stringifyYearHeader(_vm.currDate)))
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "datepicker-monthRange" },
              [
                _vm._l(_vm.text.months, function(m, index) {
                  return [
                    _c(
                      "span",
                      {
                        key: index,
                        class: {
                          "datepicker-dateRange-item-active":
                            _vm.text.months[_vm.parse(_vm.val).getMonth()] ===
                              m &&
                            _vm.currDate.getFullYear() ===
                              _vm.parse(_vm.val).getFullYear()
                        },
                        on: {
                          click: function($event) {
                            return _vm.monthSelect(index)
                          }
                        }
                      },
                      [_vm._v(_vm._s(m.substr(0, 3)))]
                    )
                  ]
                })
              ],
              2
            )
          ])
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.displayYearView,
            expression: "displayYearView"
          }
        ],
        staticClass: "datepicker-popup"
      },
      [
        _c("div", { staticClass: "datepicker-inner" }, [
          _c("div", { staticClass: "datepicker-body" }, [
            _c("div", { staticClass: "datepicker-ctrl" }, [
              _c("span", {
                staticClass: "datepicker-preBtn fa fa-angle-left",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextDecadeClick(0)
                  }
                }
              }),
              _vm._v(" "),
              _c("span", {
                staticClass: "datepicker-nextBtn fa fa-angle-right",
                attrs: { "aria-hidden": "true" },
                on: {
                  click: function($event) {
                    return _vm.preNextDecadeClick(1)
                  }
                }
              }),
              _vm._v(" "),
              _c("p", [_vm._v(_vm._s(_vm.stringifyDecadeHeader(_vm.currDate)))])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "datepicker-monthRange decadeRange" },
              [
                _vm._l(_vm.decadeRange, function(decade, index) {
                  return [
                    _c(
                      "span",
                      {
                        key: index,
                        class: {
                          "datepicker-dateRange-item-active":
                            _vm.parse(this.val).getFullYear() === decade.text
                        },
                        on: {
                          click: function($event) {
                            $event.stopPropagation()
                            return _vm.yearSelect(decade.text)
                          }
                        }
                      },
                      [_vm._v(_vm._s(decade.text))]
                    )
                  ]
                })
              ],
              2
            )
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-56b234ca", module.exports)
  }
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

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("3e1a8df1", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FileUpload.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FileUpload.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("5c179de4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Datepicker.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Datepicker.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/Arquivos/FileUpload.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-14c5409f\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-14c5409f\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Arquivos/FileUpload.vue")
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
Component.options.__file = "resources/assets/js/components/Arquivos/FileUpload.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-14c5409f", Component.options)
  } else {
    hotAPI.reload("data-v-14c5409f", Component.options)
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


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Datepicker.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-56b234ca\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-56b234ca"
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Datepicker.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-56b234ca", Component.options)
  } else {
    hotAPI.reload("data-v-56b234ca", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});