/**
 * js/family/cash-flow-plans/piggy-banks/_form.js
 */

let $ = require('jquery');

$(function() {

    var amountField = $('#projected');

    $('#piggy_bank_id').change(function() {
        let $option = $(this).find('option:selected');

        let monthlyContribution = $option.data('monthlyContribution');

        if (!monthlyContribution) {
            return;
        }

        amountField.val(monthlyContribution);
    });

});
