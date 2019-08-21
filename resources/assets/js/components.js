// upload de arquivos
Vue.component('file-upload', () => import(/* webpackChunkName: "file-upload" */'./components/Arquivos/FileUpload.vue'));
// formularios
Vue.component('v-label', () => import(/* webpackChunkName: "v-label" */'./components/Form/Label.vue'));
Vue.component('v-toogle', () => import(/* webpackChunkName: "v-toogle" */'./components/Form/ToogleForm.vue'));
Vue.component('v-opm', () => import(/* webpackChunkName: "v-opm" */'./components/Form/OPM.vue'));
Vue.component('v-estado', () => import(/* webpackChunkName: "v-estado" */'./components/Form/Estados.vue'));
Vue.component('v-it-objeto-procedimento', () => import(/* webpackChunkName: "v-it-objeto-procedimento" */'./components/Form/ItObjetoProcedimento.vue'));
Vue.component('v-prioritario', () => import(/* webpackChunkName: "v-prioritario" */'./components/Form/Prioritario.vue'));
Vue.component('v-municipio', () => import(/* webpackChunkName: "v-municipio" */'./components/Form/Municipio.vue'));
Vue.component('v-ano', () => import(/* webpackChunkName: "v-ano" */'./components/Form/Ano.vue'));
Vue.component('v-show', () => import(/* webpackChunkName: "v-show" */'./components/Form/Show.vue'));
Vue.component('v-item-unique', () => import(/* webpackChunkName: "v-item-unique" */'./components/Form/ItemUnique.vue'));
Vue.component('vue-simple-suggest', () => import(/* webpackChunkName: "vue-simple-suggest" */'./components/Form/SugestRg.vue'));
// subformulários
Vue.component('v-proced-origem', () => import(/* webpackChunkName: "v-proced-origem" */'./components/SubForm/ProcedOrigem.vue'));
Vue.component('v-reus', () => import(/* webpackChunkName: "v-reus" */'./components/SubForm/Reus.vue'));
Vue.component('v-acusado', () => import(/* webpackChunkName: "v-acusado" */'./components/SubForm/Acusado.vue'));
Vue.component('v-acusado-rg', () => import(/* webpackChunkName: "v-acusado-rg" */'./components/SubForm/AcusadoRg.vue'));
Vue.component('v-acusado-unico', () => import(/* webpackChunkName: "v-acusado-unico" */'./components/SubForm/AcusadoUnico.vue'));
Vue.component('v-vitima', () => import(/* webpackChunkName: "v-vitima" */'./components/SubForm/Vitima.vue'));
Vue.component('v-membro', () => import(/* webpackChunkName: "v-membro" */'./components/SubForm/Membro.vue'));
Vue.component('v-defensor', () => import(/* webpackChunkName: "v-defensor" */'./components/SubForm/Defensor.vue'));
Vue.component('v-movimento', () => import(/* webpackChunkName: "v-movimento" */'./components/SubForm/Movimento.vue'));
Vue.component('v-sobrestamento', () => import(/* webpackChunkName: "v-sobrestamento" */'./components/SubForm/Sobrestamento.vue'));
Vue.component('v-arquivo', () => import(/* webpackChunkName: "v-arquivo" */'./components/SubForm/Arquivo.vue'));
// gráficos
Vue.component('efetivo-chart', () => import(/* webpackChunkName: "efetivo-chart" */'./components/Charts/Home/Efetivo.vue'));
Vue.component('procedimentos-chart', () => import(/* webpackChunkName: "procedimentos-chart" */'./components/Charts/Home/Procedimentos.vue'));
Vue.component('crpms-chart', () => import(/* webpackChunkName: "crpms-chart" */'./components/Charts/Pendencias/Crpms.vue'));
// FDI
Vue.component('v-cautelas', () => import(/* webpackChunkName: "v-cautelas" */'./components/FDI/Cautelas.vue'));
// Layout
Vue.component('v-tab-item', () => import(/* webpackChunkName: "v-tab-item" */'./components/Layout/TabItem.vue'));
Vue.component('v-tab-menu', () => import(/* webpackChunkName: "v-tab-menu" */'./components/Layout/TabMenu.vue'));
Vue.component('v-info-box', () => import(/* webpackChunkName: "v-info-box" */'./components/Layout/Home/InfoBox.vue'));
Vue.component('v-messages', () => import(/* webpackChunkName: "v-messages" */'./components/Layout/TopMenu/Messages.vue'));
Vue.component('v-notifications', () => import(/* webpackChunkName: "v-notifications" */'./components/Layout/TopMenu/Notifications.vue'));
Vue.component('v-tasks', () => import(/* webpackChunkName: "v-tasks" */'./components/Layout/TopMenu/Tasks.vue'));
//VUESTRAP
// Revisados
Vue.component('v-datepicker', () => import(/* webpackChunkName: "v-datepicker" */'./components/Vuestrap/Datepicker.vue'));
Vue.component('v-select', () => import(/* webpackChunkName: "v-select" */'./components/Vuestrap/Select.vue'));
Vue.component('v-checkbox', () => import(/* webpackChunkName: "v-checkbox" */'./components/Vuestrap/Checkbox.vue'));
Vue.component('v-tab', () => import(/* webpackChunkName: "v-tab" */'./components/Vuestrap/Tab.vue'));
Vue.component('v-tab-group', () => import(/* webpackChunkName: "v-tab-group" */'./components/Vuestrap/TabGroup.vue'));
Vue.component('v-tabs', () => import(/* webpackChunkName: "v-tabs" */'./components/Vuestrap/Tabs.vue'));
// Não revisados
Vue.component('v-accordion', () => import(/* webpackChunkName: "v-accordion" */'./components/Vuestrap/Accordion.vue'));
Vue.component('v-affix', () => import(/* webpackChunkName: "v-affix" */'./components/Vuestrap/Affix.vue'));
Vue.component('v-alert', () => import(/* webpackChunkName: "v-alert" */'./components/Vuestrap/Alert.vue'));
Vue.component('v-aside', () => import(/* webpackChunkName: "v-aside" */'./components/Vuestrap/Aside.vue'));
// Vue.component('v-button-group', () => import(/* webpackChunkName: "v-button-group" */'./components/Vuestrap/ButtonGroup.vue'));
Vue.component('v-carousel', () => import(/* webpackChunkName: "v-carousel" */'./components/Vuestrap/Carousel.vue'));
Vue.component('v-dropdown', () => import(/* webpackChunkName: "v-dropdown" */'./components/Vuestrap/Dropdown.vue'));
Vue.component('v-form-group', () => import(/* webpackChunkName: "v-form-group" */'./components/Vuestrap/FormGroup.vue'));
Vue.component('v-form-validator', () => import(/* webpackChunkName: "v-form-validator" */'./components/Vuestrap/FormValidator.vue'));
Vue.component('v-input', () => import(/* webpackChunkName: "v-input" */'./components/Vuestrap/Input.vue'));
Vue.component('v-modal', () => import(/* webpackChunkName: "v-modal" */'./components/Vuestrap/Modal.vue'));
Vue.component('v-navbar', () => import(/* webpackChunkName: "v-navbar" */'./components/Vuestrap/Navbar.vue'));
Vue.component('v-option', () => import(/* webpackChunkName: "v-option" */'./components/Vuestrap/Option.vue'));
Vue.component('v-panel', () => import(/* webpackChunkName: "v-panel" */'./components/Vuestrap/Panel.vue'));
Vue.component('v-popover', () => import(/* webpackChunkName: "v-popover" */'./components/Vuestrap/Popover.vue'));
Vue.component('v-progressbar', () => import(/* webpackChunkName: "v-progressbar" */'./components/Vuestrap/Progressbar.vue'));
Vue.component('v-radio', () => import(/* webpackChunkName: "v-radio" */'./components/Vuestrap/Radio.vue'));
Vue.component('v-slider', () => import(/* webpackChunkName: "v-slider" */'./components/Vuestrap/Slider.vue'));
Vue.component('v-spinner', () => import(/* webpackChunkName: "v-spinner" */'./components/Vuestrap/Spinner.vue'));
Vue.component('v-toggle-button', () => import(/* webpackChunkName: "v-toggle-button" */'./components/Vuestrap/ToggleButton.vue'));
Vue.component('v-tooltip', () => import(/* webpackChunkName: "v-tooltip" */'./components/Vuestrap/Tooltip.vue'));
Vue.component('v-typeahead', () => import(/* webpackChunkName: "v-typeahead" */'./components/Vuestrap/Typeahead.vue'));

