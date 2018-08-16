/**
 * js/family/cash-flow-plans/income-sources/_form.js
 */

let $ = require('jquery');

$(function() {

    $('#income_source_id').change(function() {

        let option = $(this).find('option:selected');

        let name   = option.data('name');
        let amount = option.data('defaultAmount');

        $('#name').val(name);
        $('#projected').val(amount);
        $('#actual').val(amount);

    });

});
