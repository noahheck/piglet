/**
 * js/family/cash-flow-plans/recurring-expenses/_form.js
 */

let $ = require('jquery');

$(function() {

    $('#recurring_expense_id').change(function() {

        let option = $(this).find('option:selected');

        let name        = option.data('name');
        let merchant    = option.data('merchantId');
        let category    = option.data('category');
        let subCategory = option.data('subCategory');

        let amount      = option.data('defaultAmount');

        let detail      = option.data('description');

        $('#name').val(name);

        $('#merchant_id').val(merchant);
        $('#merchant_id_select').val(merchant);

        $('#category_id').val(category);
        $('#category_id_select').val(category);

        $('#sub_category').val(subCategory);

        $('#projected').val(amount);
        // $('#actual').val(amount);

        $('#detail').val(detail);

    });

    $('#copyFromProjected').click(function() {
        $('#actual').val(
            $('#projected').val()
        ).focus();
    });

});
