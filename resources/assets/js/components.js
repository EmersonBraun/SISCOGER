// upload de arquivos
Vue.component('file-upload', () => import(/* webpackChunkName: "file-upload" */'./components/Arquivos/FileUpload.vue'));
// formularios
Vue.component('v-label', () => import(/* webpackChunkName: "v-label" */'./components/Form/Label.vue'));
Vue.component('v-opm', () => import(/* webpackChunkName: "v-opm" */'./components/Form/OPM.vue'));
Vue.component('v-municipio', () => import(/* webpackChunkName: "v-municipio" */'./components/Form/Municipio.vue'));
Vue.component('v-ano', () => import(/* webpackChunkName: "v-ano" */'./components/Form/Ano.vue'));
Vue.component('v-item-unique', () => import(/* webpackChunkName: "v-item-unique" */'./components/Form/ItemUnique.vue'));
// subformulários
Vue.component('v-proced-origem', () => import(/* webpackChunkName: "v-proced-origem" */'./components/SubForm/ProcedOrigem.vue'));
Vue.component('v-acusado', () => import(/* webpackChunkName: "v-acusado" */'./components/SubForm/Acusado.vue'));
Vue.component('v-acusado-rg', () => import(/* webpackChunkName: "v-acusado-rg" */'./components/SubForm/AcusadoRg.vue'));
Vue.component('v-acusado-unico', () => import(/* webpackChunkName: "v-acusado-unico" */'./components/SubForm/AcusadoUnico.vue'));
Vue.component('v-vitima', () => import(/* webpackChunkName: "v-vitima" */'./components/SubForm/Vitima.vue'));
Vue.component('v-membro', () => import(/* webpackChunkName: "v-membro" */'./components/SubForm/Membro.vue'));
Vue.component('v-defensor', () => import(/* webpackChunkName: "v-defensor" */'./components/SubForm/Defensor.vue'));
Vue.component('v-movimento', () => import(/* webpackChunkName: "v-movimento" */'./components/SubForm/Movimento.vue'));
Vue.component('v-sobrestamento', () => import(/* webpackChunkName: "v-sobrestamento" */'./components/SubForm/Sobrestamento.vue'));
Vue.component('v-arquivo', () => import(/* webpackChunkName: "v-arquivo" */'./components/SubForm/Arquivo.vue'));

// FDI
Vue.component('v-cautelas', () => import(/* webpackChunkName: "v-cautelas" */'./components/FDI/Cautelas.vue'));
// Layout
Vue.component('v-tab-item', () => import(/* webpackChunkName: "v-tab-item" */'./components/Layout/TabItem.vue'));
Vue.component('v-tab-menu', () => import(/* webpackChunkName: "v-tab-menu" */'./components/Layout/TabMenu.vue'));
//VUESTRAP
// Revisados
Vue.component('v-datepicker', () => import(/* webpackChunkName: "v-datepicker" */'./components/Vuestrap/Datepicker.vue'));
Vue.component('v-select', () => import(/* webpackChunkName: "v-select" */'./components/Vuestrap/Select.vue'));
Vue.component('v-checkbox', () => import(/* webpackChunkName: "v-checkbox" */'./components/Vuestrap/Checkbox.vue'));
// Não revisados
/*Vue.component('v-accordion', function (resolve) {require(['vue-strap']).accordion});
Vue.component('v-affix', function (resolve) {require(['vue-strap']).affix});
Vue.component('v-alert', function (resolve) {require(['vue-strap']).alert});
Vue.component('v-aside', function (resolve) {require(['vue-strap']).aside});
Vue.component('v-button-group', function (resolve) {require(['vue-strap']).buttonGroup});
Vue.component('v-carousel', function (resolve) {require(['vue-strap']).carousel});
Vue.component('v-dropdown', function (resolve) {require(['vue-strap']).dropdown});
Vue.component('v-form-group', function (resolve) {require(['vue-strap']).formGroup});
Vue.component('v-form-validator', function (resolve) {require(['vue-strap']).formValidator});
Vue.component('v-input', function (resolve) {require(['vue-strap']).input});
Vue.component('v-modal', function (resolve) {require(['vue-strap']).modal});
Vue.component('v-navbar', function (resolve) {require(['vue-strap']).navbar});
Vue.component('v-option', function (resolve) {require(['vue-strap']).option});
Vue.component('v-panel', function (resolve) {require(['vue-strap']).panel});
Vue.component('v-popover', function (resolve) {require(['vue-strap']).popover});
Vue.component('v-progressbar', function (resolve) {require(['vue-strap']).progressbar});
Vue.component('v-radio', function (resolve) {require(['vue-strap']).radio});
Vue.component('v-slider', function (resolve) {require(['vue-strap']).slider});
Vue.component('v-spinner', function (resolve) {require(['vue-strap']).spinner});
Vue.component('v-tab', function (resolve) {require(['vue-strap']).tab});
Vue.component('v-tab-group', function (resolve) {require(['vue-strap']).tabGroup});
Vue.component('v-tabs', function (resolve) {require(['vue-strap']).tabs});
Vue.component('v-toggle-button', function (resolve) {require(['vue-strap']).toggleButton});
Vue.component('v-tooltip', function (resolve) {require(['vue-strap']).tooltip});
Vue.component('v-typeahead', function (resolve) {require(['vue-strap']).typeahead});*/

