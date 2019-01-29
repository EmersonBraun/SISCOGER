var elixir = require('laravel-elixir');

// require('laravel-elixir-vueify');

elixir(function(mix){
    mix.styles([
        // bootstrap https://getbootstrap.com/
        '../../../node_modules/bootstrap/dist/css/bootstrap.css',
        // Jquery UI
        '../../../node_modules/jquery-ui-dist/jquery-ui.css',
        // font awsome https://fontawesome.com/?from=io
        '../../../public/vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css',
        //ionic icons https://ionicons.com/
        '../../../public/vendor/adminlte/vendor/Ionicons/css/ionicons.min.css',
        // estilos do Admin lte
        '../../../public/vendor/adminlte/dist/css/AdminLTE.min.css',
        // Datepicker JS https://jqueryui.com/datepicker/
        '../../../public/vendor/plugins/datepicker/datepicker3.css',
        // Daterange picker (calendário em imput com período de tempo)
        '../../../public/vendor/plugins/daterangepicker/daterangepicker-bs3.css',
        // Bootstrap Color Picker
        '../../../public/vendor/plugins/colorpicker/bootstrap-colorpicker.min.css',
        // Bootstrap time Picker
        '../../../public/vendor/plugins/timepicker/bootstrap-timepicker.min.css',
        // Easy autocomplete
        '../../../public/vendor/plugins/EasyAutocomplete/easy-autocomplete.min.css',
        '../../../public/vendor/plugins/EasyAutocomplete/easy-autocomplete.themes.min.css',
        // jquery confim.js https://craftpip.github.io/jquery-confirm/
        '../../../node_modules/jquery-confirm/dist/jquery-confirm.min.css',
        // tema do admilte para o select2
        '../../../bower_components/select2-dark-adminlte-theme/dist/select2-adminlte.css',
        // meus estilos
        '../../../public/css/estilo.css'
    ], 'public/build/css/styles.css');

    // mix.browserify('main.js');
});