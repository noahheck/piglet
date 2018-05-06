<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('formError', function($expression) {
            return '<?php if ($errors->any()) {echo "<div class=\'alert alert-danger\'>Looks like something went wrong:</div>";} ?>';
        });

        Blade::directive('formSuccess', function($expression) {
            return '<?php if (Session::has(' . $expression . ')) { echo "<div class=\"alert alert-success alert-dismissible fade show\">" . Session::get(' . $expression . ') . "<button type=\'button\' class=\'close\' data-dismiss=\'alert\' aria-label=\'Close\'><span aria-hidden=\'true\'>&times;</span></button></div>";} ?>';
        });

        Blade::directive('fieldError', function($expression) {

            $field = $expression;

            return '<?php if ($errors->has(' . $field . ')) { echo "<span class=\"text-danger\">" . $errors->first(' . $field . ') . "</span>";} ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
