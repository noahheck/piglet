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


        /**
         * Outputs a meta tag with the provided name and content value - these tags are read in by the js meta service
         * to provide an easy interface to additional document details - json encodes and specifies json format for
         * arrays/objects (handled appropriately by js service)
         *
         * Usage:
         *
         *    @meta('number-of-tries', 5)
         *    @meta('family-id', $family->id)
         *    @meta('cash-flow-plan', $cashFlowPlan)
         */
        Blade::directive('meta', function($expression) {

            return '<?php 
                        $isJson = "0";
                        list ($name, $value) = [' . $expression . '];
                        if (is_array($value) || is_object($value)) {
                            $value = json_encode($value, JSON_HEX_APOS);
                            $isJson = "1";
                        }
                        echo "<meta data-piglet=\"1\" data-json=\"$isJson\" name=\"" . e($name) . "\" content=\'" . $value . "\'>";
                    ?>';
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
