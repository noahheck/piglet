/**
 * js/app.js
 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes               libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { Application } from "stimulus"
import { definitionsFromContext } from "stimulus/webpack-helpers"

const application = Application.start()
const context     = require.context("./controllers", true, /\.js$/)
application.load(definitionsFromContext(context))



let $ = window.jquery = window.$ = require("jquery");


window.moment = require('moment');

require('moment-timezone');



        require('./bootstrap');
        require('popper.js');


        require('bootstrap-datepicker');

        require('tempusdominus-bootstrap-4');

        require('styled-notifications');

let jsCookie = require('js-cookie');


// require('@fortawesome/fontawesome-free/js/all.min.js')

import Chart from 'chart.js';

import "styled-notifications/dist/notifications.css";

// import "@fortawesome/fontawesome-free/css/all.min.css";

let pageMenu     = require('Component/pageMenu');
let help         = require('Component/help');
let domSearch    = require('Component/domSearch');
let moneyField   = require('Component/moneyField');
let tabNavOnLoad = require('Component/tabNavOnLoad');
let copyValue    = require('Component/copyValue');

let notify       = require('Component/notify');

let phone = require('Services/phone');
let ajax  = require('Services/ajax');


$(function() {

    $('.dismissable-popover').click(() => {return false;}).popover({
        trigger: 'focus'
    });

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        disableTouchKeyboard: true,
        todayBtn: 'linked',
        clearBtn: true
    });

    $('.timepicker').each(function() {

        let $this = $(this);

        $this.attr('data-target', '#' + $this.attr('id'));
        $this.attr('data-toggle', 'datetimepicker');

        $this.datetimepicker({
            format: 'LT'
        });

        $this.focusout(function() {
            $this.datetimepicker('hide');
        });

    });

    // Not implemented yet
    /*
        $('.datetime-picker').each(function() {
            $(this).datetimepicker();
        });
    */

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

});
