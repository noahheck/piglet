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

mix
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/home.js', 'public/js')

    // Things to put in vendor file
    .extract(['jquery', 'bootstrap'])

    .sass('resources/assets/sass/app.scss', 'public/css')


    .disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            "Services": path.resolve(__dirname, "resources/assets/js/services/")
        }
    }
});
