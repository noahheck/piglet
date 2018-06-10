/**
 * js/app.js
 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes               libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

let $ = require("jquery");
        require('./bootstrap');
        require('bootstrap-datepicker');

let ajax = require('Services/ajax');



$(function() {

    $('.dismissable-popover').click(() => {return false;}).popover({
        trigger: 'focus'
    });

    $('.datepicker').datepicker({
        autoclose: true
    });


    /*
    let route = {

        // url: '/ajax-test',
        name: 'test.ajax.post',
        params: {name: 'noah'}
    };

    ajax.post(route, {}).then((response) => {
        console.log(response);
    });
    /**/

});
