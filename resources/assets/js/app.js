/**
 * js/app.js
 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes               libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

var $ = require("jquery");

require('./bootstrap');

$(function() {

    $(".dismissable-popover").click(() => {return false;}).popover({
        trigger: 'focus'
    });

    console.log("Hello");

});
