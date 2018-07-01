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

let pageMenu   = require('Component/pageMenu');
let domSearch  = require('Component/domSearch');
let moneyField = require('Component/moneyField');

let phone = require('Services/phone');
let ajax  = require('Services/ajax');


$(function() {

    $('.dismissable-popover').click(() => {return false;}).popover({
        trigger: 'focus'
    });

    $('.datepicker').datepicker({
        autoclose: true
    });

    $('.dom-search').each(function() {
        let jThis = $(this);

        domSearch.attach(jThis, {searchItems: jThis.data('searchItems')});
    });

    $('.money-field').each(function() {
        moneyField.attach(this);
    });


    $('.phone-field').keyup(function() {
        let jThis = $(this);

        jThis.val(phone.format(jThis.val()));
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
