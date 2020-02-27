const mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js').version();

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.styl$/,
                loader: ['style-loader', 'css-loader', 'stylus-loader', {
                    loader: 'vuetify-loader',
                    options: {
                        theme: path.resolve('./node_modules/vuetify/src/stylus/theme.styl')
                    }
                }]
            }
        ]
    }
})

// Override mix internal webpack output configuration 
mix.config.webpackConfig.output = {
    chunkFilename: 'js/components/[name].bundle.js',
    publicPath: '/siscoger/public/',
};
