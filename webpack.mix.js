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

    .sass('resources/assets/sass/print.scss', 'public/css')

    .sass('resources/assets/sass/marketing.scss', 'public/css')

    .js('resources/assets/js/help.js', 'public/js')
    .sass('resources/assets/sass/help.scss', 'public/css')

    // .js('resources/assets/js/admin.js', 'public/js')
    .sass('resources/assets/sass/admin.scss', 'public/css')

    .js('resources/assets/js/home.js', 'public/js')
    .sass('resources/assets/sass/home.scss', 'public/css')

    .sass('resources/assets/sass/welcome.scss', 'public/css')

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
    .js('resources/assets/js/family/taskLists/show.js',  'public/js/family.taskLists.show.js')
    .js('resources/assets/js/family/taskLists/_form.js', 'public/js/family.taskLists._form.js')

    .js('resources/assets/js/family/tasks/_form.js',     'public/js/family.tasks._form.js')

    .sass('resources/assets/sass/family/taskLists.scss', 'public/css/family.taskLists.css')



    .js('resources/assets/js/family/calendar/month.js', 'public/js/family.calendar.month.js')
    .sass('resources/assets/sass/family/calendar/calendar.scss', 'public/css/family.calendar.calendar.css')


    .js('resources/assets/js/family/events/_form.js', 'public/js/family.events._form.js')



    .js('resources/assets/js/family/money-matters/nav.js',       'public/js/family.money-matters.nav.js')
    .sass('resources/assets/sass/family/money-matters/nav.scss', 'public/css/family.money-matters.nav.css')

    .sass('resources/assets/sass/family/money-matters/welcome.scss', 'public/css/family.money-matters.welcome.css')
    .js('resources/assets/js/family/money-matters/welcome.js', 'public/js/family.money-matters.welcome.js')


    .js('resources/assets/js/family/merchants/index.js', 'public/js/family.merchants.index.js')
    .js('resources/assets/js/family/merchants/_form.js', 'public/js/family.merchants._form.js')

    .sass('resources/assets/sass/family/piggy-banks/index.scss', 'public/css/family.piggy-banks.index.css')


    .js('resources/assets//js/family/categories/index.js',      'public/js/family.categories.index.js')
    .sass('resources/assets/sass/family/categories/index.scss', 'public/css/family.categories.index.css')
    .js('resources/assets/js/family/categories/_form.js', 'public/js/family.categories._form.js')

    .js('resources/assets/js/family/income-sources/_form.js', 'public/js/family.income-sources._form.js')

    .js('resources/assets/js/family/recurring-expenses/_form.js', 'public/js/family.recurring-expenses._form.js')

    .js('resources/assets/js/family/expense-groups/_form.js', 'public/js/family.expense-groups._form.js')

    .js('resources/assets/js/family/cash-flow-plans/show.js', 'public/js/family.cash-flow-plans.show.js')

    .sass('resources/assets/sass/family/cash-flow-plans/index.scss', 'public/css/family.cash-flow-plans.index.css')
    .sass('resources/assets/sass/family/cash-flow-plans/show.scss', 'public/css/family.cash-flow-plans.show.css')
    .sass('resources/assets/sass/family/cash-flow-plans/create.scss', 'public/css/family.cash-flow-plans.create.css')

    .js('resources/assets/js/family/cash-flow-plans/income-sources/index.js', 'public/js/family.cash-flow-plans.income-sources.index.js')
    .js('resources/assets/js/family/cash-flow-plans/income-sources/_form.js', 'public/js/family.cash-flow-plans.income-sources._form.js')

    .js('resources/assets/js/family/cash-flow-plans/piggy-banks/_form.js', 'public/js/family.cash-flow-plans.piggy-banks._form.js')

    .js('resources/assets/js/family/cash-flow-plans/recurring-expenses/_form.js', 'public/js/family.cash-flow-plans.recurring-expenses._form.js')

    .js('resources/assets/js/family/cash-flow-plans/expense-groups/_form.js', 'public/js/family.cash-flow-plans.expense-groups._form.js')

    .js('resources/assets/js/family/cash-flow-plans/expenses/_form.js', 'public/js/family.cash-flow-plans.expenses._form.js')
    .sass('resources/assets/sass/family/cash-flow-plans/expenses/_form.scss', 'public/css/family.cash-flow-plans.expenses._form.css')

    // Things to put in vendor file
    .extract(['jquery', 'bootstrap'])



    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
}

mix.webpackConfig({
    resolve: {
        alias: {
            "Services" : path.resolve(__dirname, "resources/assets/js/services/"),
            "Component": path.resolve(__dirname, "resources/assets/js/component/"),
            "Css"      : path.resolve(__dirname, "resources/assets/sass/")
        }
    }
});
