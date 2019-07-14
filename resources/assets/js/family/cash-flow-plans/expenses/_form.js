/**
 * js/family/cash-flow-plans/recurring-expenses/_form.js
 */

let $           = require('jquery');
let categoryMap = require('Component/category-subcategory-select-map');

$(function() {

    let categorySelect = $('#category_id');
    let subCategorySelect = $('#sub_category');

    $('#actual').focus();

    $('#showAdditionalFields').click(function() {
        $('#additionalFields').slideToggle(null, () => {

            $('#description').focus();
        });
        $(this).toggleClass('shown');

    });

    categoryMap.attach('#category_id', '#sub_category');

    $('#expense_group_id').change(function() {
        let option = $(this).find('option:selected');

        let category    = option.data('category');
        let subCategory = option.data('subCategory');

        categorySelect.val(category).change();

        subCategorySelect.val(subCategory);
    });

    $('#merchant_id').change(function() {
        let option = $(this).find('option:selected');

        let category    = option.data('category');
        let subCategory = option.data('subCategory');

        let expenseGroupOption = $('#expense_group_id').find('option:selected');
        let expenseGroupCategory = expenseGroupOption.data('category');
        let expenseGroupSubCategory = expenseGroupOption.data('subCategory');



        let curCategory = categorySelect.val();

        if (   (!expenseGroupCategory && category)
            || (expenseGroupCategory != curCategory)
            || !curCategory
        ) {
            categorySelect.val(category).change();
        }

        let curSubCategory = subCategorySelect.val();

        if (   !expenseGroupSubCategory
            || (expenseGroupSubCategory != curSubCategory)
            || !curSubCategory
        ) {
            subCategorySelect.val(subCategory);
        }
    });

});
