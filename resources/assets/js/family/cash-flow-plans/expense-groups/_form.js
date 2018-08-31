/**
 * js/family/cash-flow-plans/recurring-expenses/_form.js
 */

let $           = require('jquery');
let categoryMap = require('Component/category-subcategory-select-map');

$(function() {

    let expenseGroupSelect = $('#expense_group_id');

    expenseGroupSelect.focus();

    categoryMap.attach('#category_id', '#sub_category');

    expenseGroupSelect.change(function() {

        let option = $(this).find('option:selected');

        let name        = option.data('name');
        let category    = option.data('category');
        let subCategory = option.data('subCategory');
        let amount      = option.data('defaultAmount');

        $('#name').val(name);

        $('#category_id').val(category).change();

        $('#sub_category').val(subCategory);

        $('#projected').val(amount);
    });

});
