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

let ajax = require('Services/ajax');



$(function() {

    $(".dismissable-popover").click(() => {return false;}).popover({
        trigger: 'focus'
    });

    console.log("Hello");

    /*ajax.get("/ajax-test", {}).then((response) => {
        console.log(response);
    });*/

});
