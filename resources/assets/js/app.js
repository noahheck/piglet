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

        require('styled-notifications');

        // require('@fortawesome/fontawesome-free/js/all.min.js')

import Chart from 'chart.js';

import "styled-notifications/dist/notifications.css";

// import "@fortawesome/fontawesome-free/css/all.min.css";

let pageMenu     = require('Component/pageMenu');
let domSearch    = require('Component/domSearch');
let moneyField   = require('Component/moneyField');
let tabNavOnLoad = require('Component/tabNavOnLoad');
let copyValue    = require('Component/copyValue');

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

    $('.copy-value').each(function() {
        let $this = $(this);
        copyValue.attach($this, $this.data('copySource'), $this.data('copyTarget'));
    });



    $('.piglet-chart').each(function() {
        let $this = $(this);

        let chartData = $this.data('chartData');

        let myChart = new Chart($this, chartData);

        $this.data('chart', myChart);
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
