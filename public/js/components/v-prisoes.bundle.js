webpackJsonp([0,6,16,32,37,48],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Prisoes.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_the_mask__ = __webpack_require__("./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_the_mask___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue_the_mask__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Modal_vue__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Modal.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Modal_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Vuestrap_Modal_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Tooltip_vue__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Tooltip.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Tooltip_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__Vuestrap_Tooltip_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Vuestrap_Datepicker_vue__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Datepicker.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Vuestrap_Datepicker_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__Vuestrap_Datepicker_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__Form_Label_vue__ = __webpack_require__("./resources/assets/js/components/Form/Label.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__Form_Label_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__Form_Label_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__Form_OPM_vue__ = __webpack_require__("./resources/assets/js/components/Form/OPM.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__Form_OPM_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__Form_OPM_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { TheMask: __WEBPACK_IMPORTED_MODULE_0_vue_the_mask__["TheMask"], Modal: __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Modal_vue___default.a, Label: __WEBPACK_IMPORTED_MODULE_4__Form_Label_vue___default.a, Tooltip: __WEBPACK_IMPORTED_MODULE_2__Vuestrap_Tooltip_vue___default.a, Datepicker: __WEBPACK_IMPORTED_MODULE_3__Vuestrap_Datepicker_vue___default.a, Opm: __WEBPACK_IMPORTED_MODULE_5__Form_OPM_vue___default.a },
    props: ['pm'],
    data: function data() {
        return {
            module: 'preso',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false
        };
    },
    created: function created() {
        this.list();
        this.canCreate = this.$root.hasPermission('criar-prisoes');
        this.canEdit = this.$root.hasPermission('editar-prisoes');
        this.canDelete = this.$root.hasPermission('apagar-prisoes');
    },

    computed: {
        requireds: function requireds() {
            if (this.registro.local && this.registro.cdopm_quandopreso && this.registro.inicio_data) return false;
            return true;
        },
        lenght: function lenght() {
            if (this.registros) return Object.keys(this.registros).length;
            return 0;
        },
        msgRequired: function msgRequired() {
            return 'Para liberar este bot\xE3o os campos: LOCAL, QUARTEL ONDE EST\xC1 PRESO e DATA DE IN\xCDCIO deve estar preenchidos';
        }
    },
    methods: {
        list: function list() {
            var _this = this;

            var urlIndex = this.$root.baseUrl + 'api/' + this.module + '/list/' + this.pm.RG;
            if (this.pm.RG) {
                axios.get(urlIndex).then(function (response) {
                    _this.registros = response.data;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        toCreate: function toCreate() {
            this.showModal = true;
            this.registro.rg = this.pm.RG;
            this.registro.cargo = this.pm.CARGO;
            this.registro.nome = this.pm.NOME;
        },
        create: function create() {
            var _this2 = this;

            if (!this.requireds) {

                var urlCreate = this.$root.baseUrl + 'api/' + this.module + '/store';
                axios.post(urlCreate, this.registro).then(function (response) {
                    _this2.transation(response.data.success, 'create');
                }).catch(function (error) {
                    return console.log(error);
                });
                this.showModal = false;
            }
        },
        edit: function edit(registro) {
            this.registro = registro;
            this.showModal = true;
        },
        update: function update(id) {
            var _this3 = this;

            if (!this.requireds) {
                var urlUpdate = this.$root.baseUrl + 'api/' + this.module + '/update/' + id;
                axios.put(urlUpdate, this.registro).then(function (response) {
                    _this3.transation(response.data.success, 'edit');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        destroy: function destroy(id) {
            var _this4 = this;

            if (confirm('Você tem certeza?')) {
                var urlDelete = this.$root.baseUrl + 'api/' + this.module + '/destroy/' + id;
                axios.delete(urlDelete).then(function (response) {
                    _this4.transation(response.data.success, 'delete');
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        },
        transation: function transation(happen, type) {
            var msg = this.words(type);
            this.showModal = false;
            if (happen) {
                // se deu certo
                this.list();
                this.$root.msg(msg.success, 'success');
                this.registro = {};
            } else {
                // se falhou
                this.$root.msg(msg.fail, 'danger');
            }
        },
        words: function words(type) {
            if (type == 'create') return { success: 'Inserido com sucesso', fail: 'Erro ao inserir' };
            if (type == 'edit') return { success: 'Editado com sucesso', fail: 'Erro ao editar' };
            if (type == 'delete') return { success: 'Apagado com sucesso', fail: 'Erro ao apagar' };
        },
        searchProc: function searchProc() {
            var _this5 = this;

            if (this.registro.origem_proc && this.registro.origem_sjd_ref && this.registro.origem_sjd_ref_ano) {
                var proc = this.registro;
                var urlSearch = this.$root.baseUrl + 'api/dados/proc/' + proc.origem_proc + '/' + proc.origem_sjd_ref + '/' + proc.origem_sjd_ref_ano;
                axios.get(urlSearch).then(function (response) {
                    _this5.registro.origem_opm = response.data.opm;
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        }
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/Label.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Vuestrap_Tooltip__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Tooltip.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Vuestrap_Tooltip___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Vuestrap_Tooltip__);
//
//
//
//
//
//
//
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
    components: { tooltip: __WEBPACK_IMPORTED_MODULE_0__Vuestrap_Tooltip___default.a },
    props: {
        title: '',
        label: '',
        icon: '',
        link: '',
        lg: { default: '4' },
        md: { default: '6' },
        xs: { default: '12' },
        error: { type: String, default: '' },
        slim: { type: Boolean, default: false },
        tooltip: { type: String, default: '' }
    },
    computed: {
        classform: function classform() {
            var form = this.slim ? 'form-group2 form-group ' : 'form-group ';
            var lg = 'col-lg-' + this.lg;
            var md = 'col-md-' + this.md;
            var xs = 'col-xs-' + this.xs;
            var error = this.error.length > 0 ? 'has-error' : '';
            return form + ' ' + lg + ' ' + md + ' ' + xs + ' ' + error;
        }
    }
});

/***/ }),

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
//
//
//
//
//
//
//
//
//
//
//
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
        cdopm: { type: String, default: '' },
        name: { type: String, default: 'cdopm' },
        todas: { type: Boolean, default: false }
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
      this.value = this.val;
    },
    cleanVal: function cleanVal() {
      this.val = '';
      this.value = this.val;
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

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__util_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/util.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    backdrop: { type: Boolean, default: true },
    callback: { type: Function, default: null },
    cancelText: { type: String, default: 'Close' },
    effect: { type: String, default: null },
    large: { type: Boolean, default: false },
    okText: { type: String, default: 'Save changes' },
    small: { type: Boolean, default: false },
    title: { type: String, default: '' },
    value: { type: Boolean, required: true },
    width: { default: null }
  },
  data: function data() {
    return {
      transition: false,
      val: null
    };
  },

  computed: {
    optionalWidth: function optionalWidth() {
      if (this.width === null) {
        return null;
      } else if (Number.isInteger(this.width)) {
        return this.width + 'px';
      }
      return this.width;
    }
  },
  watch: {
    transition: function transition(val, old) {
      if (val === old) {
        return;
      }
      var el = this.$el;
      var body = document.body;
      if (val) {
        //starting
        if (this.val) {
          el.querySelector('.modal-content').focus();
          el.style.display = 'block';
          setTimeout(function () {
            return el.classList.add('in');
          }, 0);
          body.classList.add('modal-open');
          if (Object(__WEBPACK_IMPORTED_MODULE_0__util_js__["a" /* getScrollBarWidth */])() !== 0) {
            body.style.paddingRight = Object(__WEBPACK_IMPORTED_MODULE_0__util_js__["a" /* getScrollBarWidth */])() + 'px';
          }
        } else {
          el.classList.remove('in');
        }
      } else {
        //ending
        this.$emit(this.val ? 'opened' : 'closed');
        if (!this.val) {
          el.style.display = 'none';
          body.style.paddingRight = null;
          body.classList.remove('modal-open');
        }
      }
    },
    val: function val(_val, old) {
      this.$emit('input', _val);
      if (old === null ? _val === true : _val !== old) this.transition = true;
    },
    value: function value(val, old) {
      if (val !== old) this.val = val;
    }
  },
  methods: {
    action: function action(val, p) {
      if (val === null) {
        return;
      }
      if (val && this.callback instanceof Function) this.callback();
      this.$emit(val ? 'ok' : 'cancel', p);
      this.val = val || false;
    }
  },
  mounted: function mounted() {
    this.val = this.value;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__utils_popoverMixins_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/utils/popoverMixins.js");
//
//
//
//
//
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
  mixins: [__WEBPACK_IMPORTED_MODULE_0__utils_popoverMixins_js__["a" /* default */]],
  props: {
    effect: { type: String, default: 'scale' },
    trigger: { type: String, default: 'hover' }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Prisoes.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\ntd[data-v-32e23186] {\n  white-space: normal !important; \n  word-wrap: break-word;\n}\ntable[data-v-32e23186] {\n  table-layout: fixed;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.tooltip.top,\n.tooltip.left,\n.tooltip.right,\n.tooltip.bottom {\n  opacity: .9;\n}\n.fadein-enter {\n  animation:fadein-in 0.3s ease-in;\n}\n.fadein-leave-active {\n  animation:fadein-out 0.3s ease-out;\n}\n@keyframes fadein-in {\n0% {\n    opacity: 0;\n}\n100% {\n    opacity: .9;\n}\n}\n@keyframes fadein-out {\n0% {\n    opacity: .9;\n}\n100% {\n    opacity: 0;\n}\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/Label.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.form-group2[data-v-438bfec0] {\n    margin-bottom: 2px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.modal {\n  transition: all 0.3s ease;\n}\n.modal.in {\n  background-color: rgba(0,0,0,0.5);\n}\n.modal.zoom .modal-dialog {\n  -webkit-transform: scale(0.1);\n  -moz-transform: scale(0.1);\n  -ms-transform: scale(0.1);\n  transform: scale(0.1);\n  top: 300px;\n  opacity: 0;\n  -webkit-transition: all 0.3s;\n  -moz-transition: all 0.3s;\n  transition: all 0.3s;\n}\n.modal.zoom.in .modal-dialog {\n  -webkit-transform: scale(1);\n  -moz-transform: scale(1);\n  -ms-transform: scale(1);\n  transform: scale(1);\n  -webkit-transform: translate3d(0, -300px, 0);\n  transform: translate3d(0, -300px, 0);\n  opacity: 1;\n}\n", ""]);

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

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6599cb78\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/OPM.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-32e23186\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Prisoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-tab",
    { attrs: { header: "Prisões", badge: _vm.lenght } },
    [
      _c(
        "table",
        { staticClass: "table table-striped" },
        [
          _vm.lenght
            ? [
                _c("thead", [
                  _c("tr", [
                    _c("th", { staticClass: "col-xs-1" }, [_vm._v("Início")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-1" }, [_vm._v("Fim")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Processo")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [
                      _vm._v("Complemento")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Comarca")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Vara")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-xs-2" }, [_vm._v("Ações")])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.registros, function(registro) {
                    return _c("tr", { key: registro.id_preso }, [
                      _c("td", [
                        _vm._v(_vm._s(_vm._f("date_br")(registro.inicio_data)))
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(_vm._f("date_br")(registro.fim_data)))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.processo))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.complemento))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.comarca))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(registro.vara))]),
                      _vm._v(" "),
                      _c("td", [
                        _c(
                          "span",
                          [
                            _vm.canEdit
                              ? [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "btn btn-info",
                                      on: {
                                        click: function($event) {
                                          return _vm.edit(registro)
                                        }
                                      }
                                    },
                                    [
                                      _c("i", {
                                        staticClass: "fa fa-fw fa-edit "
                                      })
                                    ]
                                  )
                                ]
                              : _vm._e(),
                            _vm._v(" "),
                            _vm.canDelete
                              ? [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "btn btn-danger",
                                      on: {
                                        click: function($event) {
                                          return _vm.destroy(registro.id_preso)
                                        }
                                      }
                                    },
                                    [
                                      _c("i", {
                                        staticClass: "fa fa-fw fa-trash-o "
                                      })
                                    ]
                                  )
                                ]
                              : _vm._e()
                          ],
                          2
                        )
                      ])
                    ])
                  }),
                  0
                )
              ]
            : [_c("tr", [_c("td", [_vm._v("Nada encontrado")])])]
        ],
        2
      ),
      _vm._v(" "),
      _vm.canCreate
        ? [
            _c(
              "a",
              {
                staticClass: "btn btn-primary btn-block",
                on: { click: _vm.toCreate }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v("Adicionar Prisão\n        ")
              ]
            )
          ]
        : _vm._e(),
      _vm._v(" "),
      _c(
        "Modal",
        {
          attrs: { large: "", effect: "fade", width: "70%" },
          model: {
            value: _vm.showModal,
            callback: function($$v) {
              _vm.showModal = $$v
            },
            expression: "showModal"
          }
        },
        [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.registro.id_preso,
                expression: "registro.id_preso"
              }
            ],
            attrs: { type: "hidden", name: "id" },
            domProps: { value: _vm.registro.id_preso },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.registro, "id_preso", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "modal-header",
              attrs: { slot: "modal-header" },
              slot: "modal-header"
            },
            [
              _c("h4", { staticClass: "modal-title" }, [
                _vm.registro.id_preso
                  ? _c("b", [_vm._v("Editar prisão")])
                  : _c("b", [_vm._v("Inserir nova prisão")])
              ])
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            { attrs: { slot: "modal-body" }, slot: "modal-body" },
            [
              _c("Label", { attrs: { label: "rg", title: "RG" } }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.rg,
                      expression: "registro.rg"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: {
                    type: "text",
                    size: "12",
                    maxlength: "25",
                    readonly: ""
                  },
                  domProps: { value: _vm.registro.rg },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "rg", $event.target.value)
                    }
                  }
                })
              ]),
              _vm._v(" "),
              _c("Label", { attrs: { label: "cargo", title: "Posto/Grad." } }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.cargo,
                      expression: "registro.cargo"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: {
                    type: "text",
                    size: "6",
                    maxlength: "10",
                    readonly: ""
                  },
                  domProps: { value: _vm.registro.cargo },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "cargo", $event.target.value)
                    }
                  }
                })
              ]),
              _vm._v(" "),
              _c("Label", { attrs: { label: "nome", title: "Nome" } }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.registro.nome,
                      expression: "registro.nome"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: { type: "text", size: "40", readonly: "" },
                  domProps: { value: _vm.registro.nome },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.registro, "nome", $event.target.value)
                    }
                  }
                })
              ]),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "cdopm_quandopreso", title: "OPM" } },
                [
                  _c("Opm", {
                    attrs: {
                      name: "cdopm_quandopreso",
                      required: "",
                      cdopm: _vm.registro.cdopm_quandopreso
                    },
                    model: {
                      value: _vm.registro.cdopm_quandopreso,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "cdopm_quandopreso", $$v)
                      },
                      expression: "registro.cdopm_quandopreso"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: { label: "local", title: "Local de reclusão/detenção" }
                },
                [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.local,
                          expression: "registro.local"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { required: "" },
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
                          _vm.$set(
                            _vm.registro,
                            "local",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "quartel" } }, [
                        _vm._v("Quartel")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "civil" } }, [
                        _vm._v("Órgãos civis")
                      ])
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _vm.registro.local == "quartel"
                ? [
                    _c(
                      "v-label",
                      {
                        attrs: {
                          label: "cdopm_prisao",
                          title: "Quartel onde o policial está preso"
                        }
                      },
                      [
                        _c("Opm", {
                          attrs: {
                            name: "cdopm_prisao",
                            cdopm: _vm.registro.cdopm_prisao
                          },
                          model: {
                            value: _vm.registro.cdopm_prisao,
                            callback: function($$v) {
                              _vm.$set(_vm.registro, "cdopm_prisao", $$v)
                            },
                            expression: "registro.cdopm_prisao"
                          }
                        })
                      ],
                      1
                    )
                  ]
                : _vm._e(),
              _vm._v(" "),
              [
                _c(
                  "v-label",
                  {
                    attrs: {
                      label: "localreclusao",
                      title: "Local onde o policial está preso",
                      tooltip: "Ex: COCT II"
                    }
                  },
                  [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.localreclusao,
                          expression: "registro.localreclusao"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { type: "text" },
                      domProps: { value: _vm.registro.localreclusao },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.registro,
                            "localreclusao",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ]
                )
              ],
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "origem_proc",
                    title: "Procedimento vinculado"
                  }
                },
                [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.origem_proc,
                          expression: "registro.origem_proc"
                        }
                      ],
                      staticClass: "form-control",
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
                          _vm.$set(
                            _vm.registro,
                            "origem_proc",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "ipm" } }, [
                        _vm._v("IPM")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "sindicancia" } }, [
                        _vm._v("Sindicância")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "cd" } }, [_vm._v("CD")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "cj" } }, [_vm._v("CJ")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "apfdc" } }, [
                        _vm._v("APFDC")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "apfdm" } }, [
                        _vm._v("APDM")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "fatd" } }, [
                        _vm._v("FATD")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "iso" } }, [
                        _vm._v("ISO")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "desercao" } }, [
                        _vm._v("Deserção")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "it" } }, [_vm._v("IT")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "adl" } }, [
                        _vm._v("ADL")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "pad" } }, [
                        _vm._v("PAD")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "sai" } }, [
                        _vm._v("SAI")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "proc_outros" } }, [
                        _vm._v("Proc. Outros")
                      ])
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "origem_sjd_ref", title: "Referência" } },
                [
                  _c("the-mask", {
                    staticClass: "form-control",
                    attrs: {
                      mask: "###",
                      type: "text",
                      placeholder: "Só números"
                    },
                    nativeOn: {
                      keyup: function($event) {
                        return _vm.searchProc($event)
                      }
                    },
                    model: {
                      value: _vm.registro.origem_sjd_ref,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "origem_sjd_ref", $$v)
                      },
                      expression: "registro.origem_sjd_ref"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "origem_sjd_ref_ano", title: "Ano" } },
                [
                  _c("the-mask", {
                    staticClass: "form-control",
                    attrs: {
                      mask: "####",
                      type: "text",
                      placeholder: "Só números"
                    },
                    nativeOn: {
                      keyup: function($event) {
                        return _vm.searchProc($event)
                      }
                    },
                    model: {
                      value: _vm.registro.origem_sjd_ref_ano,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "origem_sjd_ref_ano", $$v)
                      },
                      expression: "registro.origem_sjd_ref_ano"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "origem_opm", title: "OPM de origem" } },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.origem_opm,
                        expression: "registro.origem_opm"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", readonly: "" },
                    domProps: { value: _vm.registro.origem_opm },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.registro,
                          "origem_opm",
                          $event.target.value
                        )
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "processo",
                    title: "Processo, Nº do processo - Comarca.",
                    tooltip:
                      "Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.processo,
                        expression: "registro.processo"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.registro.processo },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "processo", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "complemento",
                    title: "Artigos da Infração penal",
                    tooltip: "Ex: Art. 121 § 2º CP"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.complemento,
                        expression: "registro.complemento"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.registro.complemento },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.registro,
                          "complemento",
                          $event.target.value
                        )
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "numeromandado",
                    title: "Nº do mandado de prisão, se houver",
                    tooltip: "Ex: 000183216-55"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.numeromandado,
                        expression: "registro.numeromandado"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.registro.numeromandado },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.registro,
                          "numeromandado",
                          $event.target.value
                        )
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                { attrs: { label: "id_presotipo", title: "Tipo da prisão" } },
                [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.registro.id_presotipo,
                          expression: "registro.id_presotipo"
                        }
                      ],
                      staticClass: "form-control",
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
                          _vm.$set(
                            _vm.registro,
                            "id_presotipo",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { attrs: { value: "1" } }, [
                        _vm._v("Flagrante")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "2" } }, [
                        _vm._v("Preventiva")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "3" } }, [
                        _vm._v("Temporária")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "4" } }, [
                        _vm._v("Condenação")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "5" } }, [
                        _vm._v("Menagem")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "6" } }, [
                        _vm._v("Deserção")
                      ])
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "vara",
                    title: "Vara",
                    tooltip: "Ex: 3ª Vara Criminal"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.vara,
                        expression: "registro.vara"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.registro.vara },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "vara", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "comarca",
                    title: "Comarca",
                    tooltip: "Ex: Curitiba"
                  }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.comarca,
                        expression: "registro.comarca"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.registro.comarca },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "comarca", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "inicio_data",
                    title: "Data de entrada na prisão",
                    icon: "fa fa-calendar"
                  }
                },
                [
                  _c("Datepicker", {
                    attrs: {
                      placeholder: _vm.registro.inicio_data,
                      "clear-button": ""
                    },
                    model: {
                      value: _vm.registro.inicio_data,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "inicio_data", $$v)
                      },
                      expression: "registro.inicio_data"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "fim_data",
                    title: "Data da saída da prisão",
                    icon: "fa fa-calendar"
                  }
                },
                [
                  _c("Datepicker", {
                    attrs: {
                      placeholder: _vm.registro.fim_data,
                      "clear-button": ""
                    },
                    model: {
                      value: _vm.registro.fim_data,
                      callback: function($$v) {
                        _vm.$set(_vm.registro, "fim_data", $$v)
                      },
                      expression: "registro.fim_data"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-label",
                {
                  attrs: {
                    label: "obs_txt",
                    title: "Observações",
                    lg: "12",
                    md: "12"
                  }
                },
                [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.registro.obs_txt,
                        expression: "registro.obs_txt"
                      }
                    ],
                    attrs: {
                      id: "foco",
                      rows: "5",
                      cols: "105",
                      width: "100%"
                    },
                    domProps: { value: _vm.registro.obs_txt },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.registro, "obs_txt", $event.target.value)
                      }
                    }
                  })
                ]
              )
            ],
            2
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "modal-footer",
              attrs: { slot: "modal-footer" },
              slot: "modal-footer"
            },
            [
              _c("div", { staticClass: "col-xs-6" }, [
                _c(
                  "a",
                  {
                    staticClass: "btn btn-default btn-block",
                    on: {
                      click: function($event) {
                        _vm.showModal = false
                      }
                    }
                  },
                  [_vm._v("Cancelar")]
                )
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "col-xs-6" },
                [
                  _c(
                    "v-tooltip",
                    {
                      attrs: {
                        effect: "scale",
                        placement: "top",
                        content: _vm.msgRequired
                      }
                    },
                    [
                      _vm.registro.id_preso
                        ? _c(
                            "a",
                            {
                              staticClass: "btn btn-success btn-block",
                              attrs: { disabled: _vm.requireds },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  return _vm.update(_vm.registro.id_preso)
                                }
                              }
                            },
                            [_vm._v("Editar")]
                          )
                        : _c(
                            "a",
                            {
                              staticClass: "btn btn-success btn-block",
                              attrs: { disabled: _vm.requireds },
                              on: { click: _vm.create }
                            },
                            [_vm._v("Inserir")]
                          )
                    ]
                  )
                ],
                1
              )
            ]
          )
        ]
      )
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
    require("vue-hot-reload-api")      .rerender("data-v-32e23186", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3d5b0a65\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "span",
    { ref: "trigger" },
    [
      _vm._t("default"),
      _vm._v(" "),
      _c("transition", { attrs: { name: _vm.effect } }, [
        _vm.show
          ? _c("div", { ref: "popover", class: ["tooltip", _vm.placement] }, [
              _c("div", { staticClass: "tooltip-arrow" }),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "tooltip-inner" },
                [
                  _vm._t("content", [
                    _c("div", { domProps: { innerHTML: _vm._s(_vm.content) } })
                  ])
                ],
                2
              )
            ])
          : _vm._e()
      ])
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
    require("vue-hot-reload-api")      .rerender("data-v-3d5b0a65", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-438bfec0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/Label.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { class: _vm.classform },
    [
      _vm.icon && !_vm.link ? _c("i", { class: _vm.icon }) : _vm._e(),
      _vm._v(" "),
      _c("label", { attrs: { for: _vm.label } }, [_vm._v(_vm._s(_vm.title))]),
      _vm._v(" "),
      _vm.link
        ? _c("a", { attrs: { href: _vm.link, target: "_blank" } }, [
            _c("i", { class: _vm.icon })
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm.tooltip
        ? _c(
            "tooltip",
            {
              attrs: { effect: "scale", placement: "top", content: _vm.tooltip }
            },
            [_c("i", { staticClass: "fa fa-question-circle" })]
          )
        : _vm._e(),
      _vm._v(" "),
      _c("br"),
      _vm._v(" "),
      _vm._t("default"),
      _vm._v(" "),
      _vm.error
        ? _c("span", { staticClass: "help-block" }, [
            _c("strong", [_vm._v(_vm._s(_vm.error))])
          ])
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
    require("vue-hot-reload-api")      .rerender("data-v-438bfec0", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-51e4cae2\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      class: ["modal", _vm.effect],
      attrs: { role: "dialog" },
      on: {
        click: function($event) {
          _vm.backdrop && _vm.action(false, 1)
        },
        transitionend: function($event) {
          _vm.transition = false
        }
      }
    },
    [
      _c(
        "div",
        {
          class: [
            "modal-dialog",
            { "modal-lg": _vm.large, "modal-sm": _vm.small }
          ],
          style: { width: _vm.optionalWidth },
          attrs: { role: "document" },
          on: {
            click: function($event) {
              $event.stopPropagation()
              return _vm.action(null)
            }
          }
        },
        [
          _c(
            "div",
            { staticClass: "modal-content" },
            [
              _vm._t("modal-header", [
                _c("div", { staticClass: "modal-header" }, [
                  _c(
                    "button",
                    {
                      staticClass: "close",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(false, 2)
                        }
                      }
                    },
                    [_c("span", [_vm._v("×")])]
                  ),
                  _vm._v(" "),
                  _c(
                    "h4",
                    { staticClass: "modal-title" },
                    [_vm._t("title", [_vm._v(_vm._s(_vm.title))])],
                    2
                  )
                ])
              ]),
              _vm._v(" "),
              _vm._t("modal-body", [
                _c("div", { staticClass: "modal-body" }, [_vm._t("default")], 2)
              ]),
              _vm._v(" "),
              _vm._t("modal-footer", [
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-default",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(false, 3)
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.cancelText))]
                  ),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.action(true, 4)
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.okText))]
                  )
                ])
              ])
            ],
            2
          )
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-51e4cae2", module.exports)
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
        domProps: { value: _vm.val || _vm.value },
        on: {
          click: _vm.inputClick,
          input: function($event) {
            return this.$emit("input", $event.target.val)
          }
        }
      }),
      _vm._v(" "),
      _c("div", { staticClass: "append" }, [
        !_vm.value
          ? _c(
              "span",
              { staticClass: "btne", on: { click: _vm.changeToToday } },
              [_vm._v("Hoje ")]
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.clearButton && _vm.value
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
        staticClass: "form-control",
        attrs: { name: _vm.name },
        domProps: { value: _vm.cdopm },
        on: {
          click: function($event) {
            return _vm.$emit("input", $event.target.value)
          }
        }
      },
      [
        _vm.todas
          ? _c("option", { attrs: { value: "" } }, [_vm._v("Todas as OPM")])
          : _vm._e(),
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
        _vm._m(9),
        _vm._v(" "),
        _vm._m(10),
        _vm._v(" "),
        _vm._m(11),
        _vm._v(" "),
        _vm._m(12),
        _vm._v(" "),
        _vm._m(13)
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
    return _c("optgroup", { attrs: { label: "APMG" } }, [
      _c("option", { attrs: { value: "111" } }, [_vm._v("APMG (sede)")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105403" } }, [_vm._v("ESO")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105404" } }, [_vm._v("1ESFAEP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11105405" } }, [_vm._v("2ESFAEP")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11107" } }, [_vm._v("COLEGIO/PMPR")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11108" } }, [_vm._v("2COLEGIO/PMPR")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11109" } }, [_vm._v("3COLEGIO/PMPR")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "11120" } }, [_vm._v("4COLEGIO/PMPR")])
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
      _c("option", { attrs: { value: "90000008" } }, [_vm._v("GOST")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "1CRBM" } }, [
      _c("option", { attrs: { value: "9000000401" } }, [
        _vm._v("1CRBM (sede)")
      ]),
      _vm._v(" "),
      _c("option", { attrs: { value: "901" } }, [_vm._v("1GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "902" } }, [_vm._v("2GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "906" } }, [_vm._v("6GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "907" } }, [_vm._v("7GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "908" } }, [_vm._v("8GB")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "2CRBM" } }, [
      _c("option", { attrs: { value: "9000000501" } }, [
        _vm._v("2CRBM (sede)")
      ]),
      _vm._v(" "),
      _c("option", { attrs: { value: "903" } }, [_vm._v("3GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "905" } }, [_vm._v("5GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9002" } }, [_vm._v("11GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "921" } }, [_vm._v("1SGBI")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9004" } }, [_vm._v("7SGBI")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9005" } }, [_vm._v("8SGBI")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9006" } }, [_vm._v("9SGBI")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("optgroup", { attrs: { label: "3CRBM" } }, [
      _c("option", { attrs: { value: "9000000601" } }, [
        _vm._v("3CRBM (sede)")
      ]),
      _vm._v(" "),
      _c("option", { attrs: { value: "904" } }, [_vm._v("4GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "909" } }, [_vm._v("9GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9001" } }, [_vm._v("10GB")]),
      _vm._v(" "),
      _c("option", { attrs: { value: "9003" } }, [_vm._v("12GB")]),
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

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Prisoes.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Prisoes.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("2c5b3f56", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Prisoes.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Prisoes.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("d3ccbc82", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tooltip.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tooltip.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/Label.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/Label.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("06049b87", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Label.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Label.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("17a0604a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Modal.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Modal.vue");
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

/***/ "./resources/assets/js/components/FDI/Prisoes.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32e23186\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FDI/Prisoes.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FDI/Prisoes.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-32e23186\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FDI/Prisoes.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-32e23186"
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
Component.options.__file = "resources/assets/js/components/FDI/Prisoes.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-32e23186", Component.options)
  } else {
    hotAPI.reload("data-v-32e23186", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Form/Label.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-438bfec0\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Form/Label.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Form/Label.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-438bfec0\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Form/Label.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-438bfec0"
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
Component.options.__file = "resources/assets/js/components/Form/Label.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-438bfec0", Component.options)
  } else {
    hotAPI.reload("data-v-438bfec0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


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


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Modal.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-51e4cae2\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-51e4cae2\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Modal.vue")
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Modal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-51e4cae2", Component.options)
  } else {
    hotAPI.reload("data-v-51e4cae2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/Tooltip.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d5b0a65\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3d5b0a65\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/Vuestrap/Tooltip.vue")
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
Component.options.__file = "resources/assets/js/components/Vuestrap/Tooltip.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3d5b0a65", Component.options)
  } else {
    hotAPI.reload("data-v-3d5b0a65", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/js/components/Vuestrap/util.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* unused harmony export coerce */
/* unused harmony export getJSON */
/* harmony export (immutable) */ __webpack_exports__["a"] = getScrollBarWidth;
/* unused harmony export translations */
/* unused harmony export delayer */
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
    search: 'Search'
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

/***/ "./resources/assets/js/components/Vuestrap/utils/popoverMixins.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__NodeList_js__ = __webpack_require__("./resources/assets/js/components/Vuestrap/utils/NodeList.js");


/* harmony default export */ __webpack_exports__["a"] = ({
  props: {
    content: { type: String },
    effect: { type: String, default: 'fade' },
    header: { type: Boolean, default: true },
    placement: { type: String, default: 'top' },
    title: { type: String },
    trigger: { type: String }
  },
  data: function data() {
    return {
      top: 0,
      left: 0,
      show: false
    };
  },

  computed: {
    events: function events() {
      return { contextmenu: ['contextmenu'], hover: ['mouseleave', 'mouseenter'], focus: ['blur', 'focus'] }[this.trigger] || ['click'];
    }
  },
  methods: {
    beforeEnter: function beforeEnter() {
      var _this = this;

      this.position();
      setTimeout(function () {
        return _this.position();
      }, 30);
    },
    position: function position() {
      var _this2 = this;

      this.$nextTick(function () {
        var popover = _this2.$refs.popover || '';
        var trigger = _this2.$refs.trigger.children[0];
        switch (_this2.placement) {
          case 'top':
            _this2.left = trigger.offsetLeft - popover.offsetWidth / 2 + trigger.offsetWidth / 2;
            _this2.top = trigger.offsetTop - popover.offsetHeight;
            break;
          case 'left':
            _this2.left = trigger.offsetLeft - popover.offsetWidth;
            _this2.top = trigger.offsetTop + trigger.offsetHeight / 2 - popover.offsetHeight / 2;
            break;
          case 'right':
            _this2.left = trigger.offsetLeft + trigger.offsetWidth;
            _this2.top = trigger.offsetTop + trigger.offsetHeight / 2 - popover.offsetHeight / 2;
            break;
          case 'bottom':
            _this2.left = trigger.offsetLeft - popover.offsetWidth / 2 + trigger.offsetWidth / 2;
            _this2.top = trigger.offsetTop + trigger.offsetHeight;
            break;
          default:
            console.warn('Wrong placement prop');
        }
        popover.style.top = _this2.top + 'px';
        popover.style.left = _this2.left + 'px';
      });
    },
    toggle: function toggle(e) {
      if (e && this.trigger === 'contextmenu') e.preventDefault();
      this.show = !this.show;
      if (this.show) this.beforeEnter();
    }
  },
  mounted: function mounted() {
    var _this3 = this;

    var trigger = this.$refs.trigger.children[0];
    if (!trigger) return console.error('Could not find trigger v-el in your component that uses popoverMixin.');

    if (this.trigger === 'focus' && !~trigger.tabIndex) {
      trigger = Object(__WEBPACK_IMPORTED_MODULE_0__NodeList_js__["a" /* default */])('a,input,select,textarea,button', trigger);
      if (!trigger.length) {
        return;
      }
    }
    this.events.forEach(function (event) {
      Object(__WEBPACK_IMPORTED_MODULE_0__NodeList_js__["a" /* default */])(trigger).on(event, _this3.toggle);
    });
  },
  beforeDestroy: function beforeDestroy() {
    if (this._trigger) Object(__WEBPACK_IMPORTED_MODULE_0__NodeList_js__["a" /* default */])(this._trigger).off();
  }
});

/***/ })

});