webpackJsonp([6,29],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_js__ = __webpack_require__("./resources/assets/js/mixins.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Datepicker__ = __webpack_require__("./resources/assets/js/components/Vuestrap/Datepicker.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Datepicker___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Vuestrap_Datepicker__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    mixins: [__WEBPACK_IMPORTED_MODULE_0__mixins_js__["a" /* default */]],
    components: { Datepicker: __WEBPACK_IMPORTED_MODULE_1__Vuestrap_Datepicker__["Datepicker"] },
    props: {
        unique: { type: Boolean, default: false },
        idp: { type: String, default: '' }
    },
    data: function data() {
        return {
            motivo: '',
            motivo_outros: '',
            inicio_data: '',
            doc_controle_inicio: '',
            publicacao_inicio: '',
            termino_data: '',
            doc_controle_termino: '',
            publicacao_termino: '',
            sobrestamentos: [],
            motivos: ['Férias Acusado', 'Férias Comissão', 'Incidente de Insanidade', 'Substituição', 'Laudos/Perícia', 'Deslinde Criminal', 'outros'],
            only: false,
            edit: ''
        };
    },
    mounted: function mounted() {
        this.verifyOnly;
        this.listSobrestamento();
        this.dadosSession();
    },

    computed: {
        verifyOnly: function verifyOnly() {
            if (this.unique == true) {
                this.only = true;
            } else {
                this.only = false;
            }
        },
        outros: function outros() {
            var outros = this.motivo !== 'outros' ? 'col-lg-12 col-md-12 col-xs-12' : 'col-lg-6 col-md-6 col-xs-6';
            return outros;
        }
    },
    methods: {
        listSobrestamento: function listSobrestamento() {
            var _this = this;

            var urlIndex = this.getBaseUrl + 'api/sobrestamento/list/' + this.dproc + '/' + this.idp;
            if (this.dproc && this.idp) {
                axios.get(urlIndex).then(function (response) {
                    _this.sobrestamentos = response.data;
                    // console.log(response.data)
                }).then(this.clear(false)) //limpa a busca
                .catch(function (error) {
                    return console.log(error);
                });
            }
        },
        createSobrestamento: function createSobrestamento() {
            var _this2 = this;

            var urlCreate = this.getBaseUrl + 'api/sobrestamento/store';

            var formData = document.getElementById('formData');
            var data = new FormData(formData);

            axios.post(urlCreate, data).then(function () {
                _this2.sobrestamentos.push({
                    motivo: data.get('motivo'),
                    motivo_outros: data.get('motivo_outros'),
                    inicio_data: data.get('inicio_data'),
                    doc_controle_inicio: data.get('doc_controle_inicio'),
                    publicacao_inicio: data.get('publicacao_inicio'),
                    termino_data: data.get('termino_data'),
                    doc_controle_termino: data.get('doc_controle_termino'),
                    publicacao_termino: data.get('publicacao_termino'),
                    rg: _this2.rg
                });
                _this2.clear(false);
            }).catch(function (error) {
                return console.log(error);
            });
        },
        replaceSobrestamento: function replaceSobrestamento(sobrestamento) {
            this.motivo = sobrestamento.motivo, this.motivo_outros = sobrestamento.motivo_outros, this.inicio_data = sobrestamento.inicio_data, this.doc_controle_inicio = sobrestamento.doc_controle_inicio, this.publicacao_inicio = sobrestamento.publicacao_inicio, this.termino_data = sobrestamento.termino_data, this.doc_controle_termino = sobrestamento.doc_controle_termino, this.publicacao_termino = sobrestamento.publicacao_termino, this.edit = sobrestamento.id_sobrestamento;

            // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
            this.add = true;
        },
        editSobrestamento: function editSobrestamento() {
            var _this3 = this;

            var urledit = this.getBaseUrl + 'api/sobrestamento/edit/' + this.edit;

            var formData = document.getElementById('formData');
            var data = new FormData(formData);

            axios.post(urledit, data).then(function () {
                _this3.listSobrestamento();
                _this3.clear(false);
            }).catch(function (error) {
                return console.log(error);
            });
        },
        removeSobrestamento: function removeSobrestamento(id, index) {
            var urlDelete = this.getBaseUrl + 'api/sobrestamento/destroy/' + id;
            axios.delete(urlDelete).then(this.sobrestamentos.splice(index, 1)).then(this.clear(false)).catch(function (error) {
                return console.log(error);
            });
        },
        clear: function clear(add) {
            this.add = add;
            this.motivo = '', this.motivo_outros = '', this.inicio_data = '', this.doc_controle_inicio = '', this.publicacao_inicio = '', this.termino_data = '', this.doc_controle_termino = '', this.publicacao_termino = '', this.edit = '';
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
    // translations (lang = 'en') {
    //     let text = {
    //     daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    //     limit: 'Limit reached ({{limit}} items max).',
    //     loading: 'Loading...',
    //     minLength: 'Min. Length',
    //     months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    //     notSelected: 'Nothing Selected',
    //     required: 'Required',
    //     search: 'Search'
    //     }
    //     return window.VueStrapLang ? window.VueStrapLang(lang) : text
    // },
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
    // window.removeEventListner('click', this._blur)
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-56b234ca\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/Vuestrap/Datepicker.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.datepicker[data-v-56b234ca] {\n  position: relative;\n  display: inline-block;\n}\ninput.datepicker-input.with-reset-button[data-v-56b234ca] {\n  padding-right: 25px;\n}\n.datepicker > button.close[data-v-56b234ca] {\n  position: absolute;\n  top: 0;\n  right: 0;\n  outline: none;\n  z-index: 2;\n  display: block;\n  width: 34px;\n  height: 34px;\n  line-height: 34px;\n  text-align: center;\n}\n.datepicker > button.close[data-v-56b234ca]:focus {\n  opacity: .2;\n}\n.datepicker-popup[data-v-56b234ca] {\n  position: absolute;\n  border: 1px solid #ccc;\n  border-radius: 5px;\n  background: #fff;\n  margin-top: 2px;\n  z-index: 1000;\n  box-shadow: 0 6px 12px rgba(0,0,0,0.175);\n}\n.datepicker-inner[data-v-56b234ca] {\n  width: 218px;\n}\n.datepicker-body[data-v-56b234ca] {\n  padding: 10px 10px;\n}\n.datepicker-ctrl p[data-v-56b234ca],\n.datepicker-ctrl span[data-v-56b234ca],\n.datepicker-body span[data-v-56b234ca] {\n  display: inline-block;\n  width: 28px;\n  line-height: 28px;\n  height: 28px;\n  border-radius: 4px;\n}\n.datepicker-ctrl p[data-v-56b234ca] {\n  width: 65%;\n}\n.datepicker-ctrl span[data-v-56b234ca] {\n  position: absolute;\n}\n.datepicker-body span[data-v-56b234ca] {\n  text-align: center;\n}\n.datepicker-monthRange span[data-v-56b234ca] {\n  width: 48px;\n  height: 50px;\n  line-height: 45px;\n}\n.datepicker-item-disable[data-v-56b234ca] {\n  background-color: white!important;\n  cursor: not-allowed!important;\n}\n.decadeRange span[data-v-56b234ca]:first-child,\n.decadeRange span[data-v-56b234ca]:last-child,\n.datepicker-item-disable[data-v-56b234ca],\n.datepicker-item-gray[data-v-56b234ca] {\n  color: #999;\n}\n.datepicker-dateRange-item-active[data-v-56b234ca]:hover,\n.datepicker-dateRange-item-active[data-v-56b234ca] {\n  background: rgb(50, 118, 177)!important;\n  color: white!important;\n}\n.datepicker-monthRange[data-v-56b234ca] {\n  margin-top: 10px\n}\n.datepicker-monthRange span[data-v-56b234ca],\n.datepicker-ctrl span[data-v-56b234ca],\n.datepicker-ctrl p[data-v-56b234ca],\n.datepicker-dateRange span[data-v-56b234ca] {\n  cursor: pointer;\n}\n.datepicker-monthRange span[data-v-56b234ca]:hover,\n.datepicker-ctrl p[data-v-56b234ca]:hover,\n.datepicker-ctrl i[data-v-56b234ca]:hover,\n.datepicker-dateRange span[data-v-56b234ca]:hover,\n.datepicker-dateRange-item-hover[data-v-56b234ca] {\n  background-color : #eeeeee;\n}\n.datepicker-weekRange span[data-v-56b234ca] {\n  font-weight: bold;\n}\n.datepicker-label[data-v-56b234ca] {\n  background-color: #f8f8f8;\n  font-weight: 700;\n  padding: 7px 0;\n  text-align: center;\n}\n.datepicker-ctrl[data-v-56b234ca] {\n  position: relative;\n  height: 30px;\n  line-height: 30px;\n  font-weight: bold;\n  text-align: center;\n}\n.month-btn[data-v-56b234ca] {\n  font-weight: bold;\n  -webkit-user-select:none;\n  -moz-user-select:none;\n  -ms-user-select:none;\n  user-select:none;\n}\n.datepicker-preBtn[data-v-56b234ca] {\n  left: 2px;\n}\n.datepicker-nextBtn[data-v-56b234ca] {\n  right: 2px;\n}\n.btne[data-v-56b234ca]{\n    cursor: pointer;\n}\n\n", ""]);

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

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0fffa8f8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-lg-12 col-md-12 col-xs-12 card" }, [
    _vm._m(0),
    _vm._v(" "),
    !_vm.only
      ? _c(
          "div",
          { staticClass: "card-body", class: _vm.add ? "bordaform" : "" },
          [
            !_vm.add
              ? _c("div", [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-block",
                      on: {
                        click: function($event) {
                          _vm.add = !_vm.add
                        }
                      }
                    },
                    [
                      _c("i", { staticClass: "fa fa-plus" }),
                      _vm._v(" Adicionar sobrestamento")
                    ]
                  )
                ])
              : _c("div", [
                  _c(
                    "div",
                    { staticClass: "row", attrs: { id: "ligacaoForm1" } },
                    [
                      _c(
                        "form",
                        { attrs: { id: "formData", name: "formData" } },
                        [
                          _c("input", {
                            attrs: { type: "hidden", name: "procc" },
                            domProps: { value: _vm.dproc }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "id_" + _vm.dproc },
                            domProps: { value: _vm.idp }
                          }),
                          _vm._v(" "),
                          _c("input", {
                            attrs: { type: "hidden", name: "rg" },
                            domProps: { value: _vm.rg }
                          }),
                          _vm._v(" "),
                          _c("div", { class: _vm.outros }, [
                            _c("label", { attrs: { for: "data" } }, [
                              _vm._v("Motivo")
                            ]),
                            _c("br"),
                            _vm._v(" "),
                            _c(
                              "select",
                              {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.motivo,
                                    expression: "motivo"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { name: "motivo" },
                                on: {
                                  change: function($event) {
                                    var $$selectedVal = Array.prototype.filter
                                      .call($event.target.options, function(o) {
                                        return o.selected
                                      })
                                      .map(function(o) {
                                        var val =
                                          "_value" in o ? o._value : o.value
                                        return val
                                      })
                                    _vm.motivo = $event.target.multiple
                                      ? $$selectedVal
                                      : $$selectedVal[0]
                                  }
                                }
                              },
                              _vm._l(_vm.motivos, function(m, index) {
                                return _c(
                                  "option",
                                  {
                                    key: index,
                                    domProps: {
                                      value: m,
                                      selected: m == _vm.motivo
                                    }
                                  },
                                  [_vm._v(_vm._s(m))]
                                )
                              }),
                              0
                            )
                          ]),
                          _vm._v(" "),
                          _vm.motivo == "outros"
                            ? _c(
                                "div",
                                { staticClass: "col-lg-6 col-md-6 col-xs-6" },
                                [
                                  _c("label", { attrs: { for: "data" } }, [
                                    _vm._v("Motivo outros")
                                  ]),
                                  _c("br"),
                                  _vm._v(" "),
                                  _c("input", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value: _vm.motivo_outros,
                                        expression: "motivo_outros"
                                      }
                                    ],
                                    staticClass: "form-control",
                                    attrs: { type: "text", name: "motivo" },
                                    domProps: { value: _vm.motivo_outros },
                                    on: {
                                      input: function($event) {
                                        if ($event.target.composing) {
                                          return
                                        }
                                        _vm.motivo_outros = $event.target.value
                                      }
                                    }
                                  })
                                ]
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c("label", { attrs: { for: "inicio_data" } }, [
                                _vm._v("Data de início")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c("v-datepicker", {
                                attrs: {
                                  name: "inicio_data",
                                  placeholder: "dd/mm/aaaa",
                                  "clear-button": ""
                                },
                                model: {
                                  value: _vm.inicio_data,
                                  callback: function($$v) {
                                    _vm.inicio_data = $$v
                                  },
                                  expression: "inicio_data"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "doc_controle_inicio" } },
                                [_vm._v("N° Documento")]
                              ),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.doc_controle_inicio,
                                    expression: "doc_controle_inicio"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "doc_controle_inicio",
                                  placeholder: "Ex: Despacho n° 2.144/2018"
                                },
                                domProps: { value: _vm.doc_controle_inicio },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.doc_controle_inicio =
                                      $event.target.value
                                  }
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "publicacao_inicio" } },
                                [_vm._v("Publicação início")]
                              ),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.publicacao_inicio,
                                    expression: "publicacao_inicio"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "publicacao_inicio",
                                  placeholder: "Ex: Despacho n° 2.144/2018"
                                },
                                domProps: { value: _vm.publicacao_inicio },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.publicacao_inicio = $event.target.value
                                  }
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c("label", { attrs: { for: "termino_data" } }, [
                                _vm._v("Data de Término")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c("v-datepicker", {
                                attrs: {
                                  name: "termino_data",
                                  placeholder: "dd/mm/aaaa",
                                  "clear-button": ""
                                },
                                model: {
                                  value: _vm.termino_data,
                                  callback: function($$v) {
                                    _vm.termino_data = $$v
                                  },
                                  expression: "termino_data"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "doc_controle_termino" } },
                                [_vm._v("N° Documento")]
                              ),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.doc_controle_termino,
                                    expression: "doc_controle_termino"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "doc_controle_termino",
                                  placeholder: "Ex: Despacho n° 2.144/2018"
                                },
                                domProps: { value: _vm.doc_controle_termino },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.doc_controle_termino =
                                      $event.target.value
                                  }
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-4 col-md-4 col-xs-4" },
                            [
                              _c(
                                "label",
                                { attrs: { for: "publicacao_termino" } },
                                [_vm._v("Publicação Término")]
                              ),
                              _c("br"),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.publicacao_termino,
                                    expression: "publicacao_termino"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "publicacao_termino",
                                  placeholder: "Ex: Despacho n° 2.144/2018"
                                },
                                domProps: { value: _vm.publicacao_termino },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.publicacao_termino = $event.target.value
                                  }
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-6 col-md-6 col-xs-6" },
                            [
                              _c("label", [_vm._v("Cancelar")]),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-danger btn-block",
                                  on: {
                                    click: function($event) {
                                      return _vm.clear(false)
                                    }
                                  }
                                },
                                [
                                  _c("i", {
                                    staticClass: "fa fa-times",
                                    staticStyle: { color: "white" }
                                  })
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-lg-6 col-md-6 col-xs-6" },
                            [
                              _vm.edit
                                ? [
                                    _c("label", [_vm._v("Editar")]),
                                    _c("br"),
                                    _vm._v(" "),
                                    _c(
                                      "a",
                                      {
                                        staticClass:
                                          "btn btn-success btn-block",
                                        attrs: {
                                          disabled:
                                            !_vm.motivo ||
                                            (_vm.motivo == "outros" &&
                                              !_vm.motivo_outros.length)
                                        },
                                        on: { click: _vm.editSobrestamento }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fa fa-plus",
                                          staticStyle: { color: "white" }
                                        })
                                      ]
                                    )
                                  ]
                                : [
                                    _c("label", [_vm._v("Adicionar")]),
                                    _c("br"),
                                    _vm._v(" "),
                                    _c(
                                      "a",
                                      {
                                        staticClass:
                                          "btn btn-success btn-block",
                                        attrs: {
                                          disabled:
                                            !_vm.motivo ||
                                            (_vm.motivo == "outros" &&
                                              !_vm.motivo_outros.length)
                                        },
                                        on: { click: _vm.createSobrestamento }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fa fa-plus",
                                          staticStyle: { color: "white" }
                                        })
                                      ]
                                    )
                                  ]
                            ],
                            2
                          )
                        ]
                      )
                    ]
                  )
                ])
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "card-footer" }, [
      _vm.sobrestamentos.length
        ? _c("div", { staticClass: "row bordaform" }, [
            _c("div", { staticClass: "col-sm-12" }, [
              _c("table", { staticClass: "table table-hover" }, [
                _c("thead", [
                  _c("tr", [
                    _c("th", { staticClass: "col-sm-2" }, [_vm._v("#")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-sm-1" }, [_vm._v("Início")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-sm-2" }, [
                      _vm._v("Doc.Início")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-sm-1" }, [_vm._v("Término")]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-sm-2" }, [
                      _vm._v("Doc.Término")
                    ]),
                    _vm._v(" "),
                    _c("th", { staticClass: "col-sm-2" }, [_vm._v("Motivo")]),
                    _vm._v(" "),
                    _vm.admin
                      ? _c("th", { staticClass: "col-sm-2" }, [
                          _vm._v("Editar/Apagar")
                        ])
                      : _c("th", { staticClass: "col-sm-2" }, [
                          _vm._v("Editar")
                        ])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.sobrestamentos, function(sobrestamento, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [_vm._v(_vm._s(index + 1))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(sobrestamento.inicio_data))]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(sobrestamento.doc_controle_inicio))
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(sobrestamento.termino_data))]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(sobrestamento.doc_controle_termino))
                      ]),
                      _vm._v(" "),
                      sobrestamento.motivo !== "outros"
                        ? _c("td", [_vm._v(_vm._s(sobrestamento.motivo))])
                        : _c("td", [
                            _vm._v(_vm._s(sobrestamento.motivo_outros))
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
                                staticClass: "btn btn-success",
                                staticStyle: { color: "white" },
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    return _vm.replaceSobrestamento(
                                      sobrestamento
                                    )
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-edit" })]
                            ),
                            _vm._v(" "),
                            _vm.admin
                              ? _c(
                                  "a",
                                  {
                                    staticClass: "btn btn-danger",
                                    staticStyle: { color: "white" },
                                    attrs: { type: "button" },
                                    on: {
                                      click: function($event) {
                                        return _vm.removeSobrestamento(
                                          sobrestamento.id_sobrestamento,
                                          index
                                        )
                                      }
                                    }
                                  },
                                  [_c("i", { staticClass: "fa fa-trash" })]
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
        : _vm._e(),
      _vm._v(" "),
      !_vm.sobrestamentos.length && _vm.only
        ? _c("div", [_c("h6", [_vm._v("Não há registtros")])])
        : _vm._e()
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h5", [_c("b", [_vm._v("Sobrestamento")])])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0fffa8f8", module.exports)
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
    _c("div", { staticClass: " input-group", staticStyle: { width: "86%" } }, [
      _c("input", {
        staticClass: "form-control",
        class: { "with-reset-button": _vm.clearButton },
        attrs: { type: "text", placeholder: _vm.placeholder, name: _vm.name },
        domProps: { value: _vm.val },
        on: {
          click: _vm.inputClick,
          input: function($event) {
            return this.$emit("input", $event.target.val)
          }
        }
      }),
      _vm._v(" "),
      _c("div", { staticClass: "input-group-append" }, [
        !_vm.val
          ? _c(
              "span",
              {
                staticClass: "btne input-group-text",
                on: {
                  click: function($event) {
                    _vm.val = _vm.today()
                  }
                }
              },
              [_vm._v("Hoje ")]
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.clearButton && _vm.val
          ? _c(
              "span",
              {
                staticClass: "btne input-group-text",
                on: {
                  click: function($event) {
                    _vm.val = ""
                  }
                }
              },
              [_vm._v("   X   ")]
            )
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

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7eef8845", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Sobrestamento.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Sobrestamento.vue");
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

/***/ "./resources/assets/js/components/SubForm/Sobrestamento.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0fffa8f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"syntax-dynamic-import\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0fffa8f8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/SubForm/Sobrestamento.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0fffa8f8"
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
Component.options.__file = "resources/assets/js/components/SubForm/Sobrestamento.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0fffa8f8", Component.options)
  } else {
    hotAPI.reload("data-v-0fffa8f8", Component.options)
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

/***/ "./resources/assets/js/mixins.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
    data: function data() {
        return {
            action: '',
            dproc: '',
            dref: '',
            dano: '',
            add: false,
            admin: false,
            rg: '',
            roles: [],
            permissions: []
        };
    },

    computed: {
        getBaseUrl: function getBaseUrl() {
            // URL completa
            var getUrl = window.location;
            // dividir em array
            var pathname = getUrl.pathname.split('/');
            this.action = pathname[3];
            this.dproc = pathname[2];
            this.dref = pathname[4];
            this.dano = pathname[5] || false;

            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + pathname[1] + '/';

            return baseUrl;
        }
    },
    methods: {
        dadosSession: function dadosSession() {
            var session = this.$root.getSessionData();
            this.admin = session.is_admin;
            this.rg = session.rg;
            this.permissions = session.permissions;
            this.roles = session.roles;
        }
    }
});

/***/ })

});