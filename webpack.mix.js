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
    .sass('resources/assets/sass/app.scss', 'public/css')

    .js('resources/assets/js/home.js', 'public/js')

    .js('resources/assets/js/user-settings.js', 'public/js')
    .js('resources/assets/js/user-settings-password.js', 'public/js')
    .sass('resources/assets/sass/user-settings.scss', 'public/css')


    .js('resources/assets/js/family-details-form.js', 'public/js')
    .sass('resources/assets/sass/family/form.scss', 'public/css/family')


    .sass('resources/assets/sass/family/home.scss', 'public/css/family')


    .sass('resources/assets/sass/family/member/show.scss', 'public/css/family.member.show.css')

    .js('resources/assets/js/family/member/_form.js', 'public/js/family.member._form.js')
    .sass('resources/assets/sass/family/member/_form.scss', 'public/css/family.member._form.css')

    .sass('resources/assets/sass/family/member/home.scss', 'public/css/family/member')


    .js('resources/assets/js/family/taskLists/home.js',  'public/js/family.taskLists.home.js')
    .js('resources/assets/js/family/taskLists/_form.js', 'public/js/family.taskLists._form.js')
    .js('resources/assets/js/family/tasks/_form.js',     'public/js/family.tasks._form.js')
    .sass('resources/assets/sass/family/taskLists.scss', 'public/css/family.taskLists.css')


    // Things to put in vendor file
    .extract(['jquery', 'bootstrap'])



    .disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            "Services": path.resolve(__dirname, "resources/assets/js/services/"),
            "Css":      path.resolve(__dirname, "resources/assets/sass/")
        }
    }
});
