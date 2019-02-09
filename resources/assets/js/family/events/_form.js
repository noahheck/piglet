/**
 * js/family/events/_form.js
 */

let $ = require('jquery');

let timeField;
let allDayField;

function toggleTimeField() {

    timeField.prop('disabled', false);

    if (allDayField.is(':checked')) {
        timeField.prop('disabled', true);
    }
}

$(function() {

    timeField = $('#time');
    allDayField = $('#all_day');

    allDayField.change(toggleTimeField);

    toggleTimeField();
});
