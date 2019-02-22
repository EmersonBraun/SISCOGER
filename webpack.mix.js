let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*
 |--------------------------------------------------------------------------
 | Bibliotecas utilizadas (Os links podem mudar com o tempo, mas até o lançamento do sistema eram esses)
 |--------------------------------------------------------------------------
 |
 | Bootstrap https://getbootstrap.com/
 | Estilos do Admin lte
 | Easy autocomplete http://easyautocomplete.com/
 | jquery confim.js https://craftpip.github.io/jquery-confirm/
 | select2 https://select2.org/
 | Datatables https://datatables.net/
 | Datepicker JS https://jqueryui.com/datepicker/
 | Bootstrap time Picker
 | Fullcalendar https://fullcalendar.io/
 |
 */
// jquery
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');
// bootstrap
mix.copy('node_modules/bootstrap3/dist/js/bootstrap.js', 'public/js/bootstrap.js');
// font-awessome 3
mix.copyDirectory('node_modules/font-awesome/css', 'public/fonts/font-awesome/css/');

mix.js('resources/assets/js/app.js', 'public/js')
   .sourceMaps()
   .webpackConfig({
       devtool: 'source-map'
   })
   .options({
       processCssUrls: false
   });

mix.styles([
    'node_modules/easy-autocomplete/dist/easy-autocomplete.min.css',
    'node_modules/easy-autocomplete/dist/easy-autocomplete.themes.min.css',
    'node_modules/jquery-confirm/css/jquery-confirm.min.css',
    'node_modules/select2/dist/css/select2.css', 
    'node_modules/datatables.net-dt/css/jquery.dataTables.css',
    'public/plugins/datepicker/datepicker3.css',
    'node_modules/timepicker/dist/jquery.timepicker.css',
    'node_modules/fullcalendar/dist/fullcalendar.css',
    'public/css/auth.css',
    'public/css/estilo.css'
    ], 'public/css/styles.css');

// mix.scripts([
//     'public/js/admin.js',
//     'public/js/dashboard.js'
// ], 'public/js/all.js');


/*
mix.scripts([
        // JQuery 
        '../../../public/plugins/jquery/dist/jquery.min.js',
        // JQuery slimscroll
        '../../../public/plugins/jquery/dist/jquery.slimscroll.min.js',
        // JQuery bundle
        // '../../../public/plugins/bootstrap/dist/js/bootstrap.bundle.js',
        // Jquery UI
        '../../../public/plugins/jQueryUI/jquery-ui.min.js',
        // bootstrap https://getbootstrap.com/
        '../../../public/plugins/bootstrap/dist/js/bootstrap.min.js',
        // toaster
        '../../../public/plugins/toastr/toastr.js',
        // InputMask
        '../../../public/plugins/mask/dist/jquery.mask.js',
        '../../../public/plugins/input-mask/jquery.inputmask.js',
        '../../../public/plugins/input-mask/jquery.inputmask.date.extensions.js',
        '../../../public/plugins/input-mask/jquery.inputmask.extensions.js',
        // Minhas Funções
        '../../../public/js/funcoes.js',
        '../../../public/js/ajax.js',
    ], 'public/build/js/functions.js');

    mix.browserify('main.js');
    */

    /* 
    Totdas possibilidades desse Webpack >> Full API
    mix.js(src, output);
    mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
    mix.extract(vendorLibs);
    mix.sass(src, output);
    mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
    mix.fastSass('src', output); <-- Alias for mix.standaloneSass().
    mix.less(src, output);
    mix.stylus(src, output);
    mix.postCss(src, output, [require('postcss-some-plugin')()]);
    mix.browserSync('my-site.dev');
    mix.combine(files, destination);
    mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
    mix.copy(from, to);
    mix.copyDirectory(fromDir, toDir);
    mix.minify(file);
    mix.sourceMaps(); // Enable sourcemaps
    mix.version(); // Enable versioning.
    mix.disableNotifications();
    mix.setPublicPath('path/to/public');
    mix.setResourceRoot('prefix/for/resource/locators');
    mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
    mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
    mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
    mix.options({
      extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
      processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
      purifyCss: false, // Remove unused CSS selectors.
      uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
      postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
    });
    */