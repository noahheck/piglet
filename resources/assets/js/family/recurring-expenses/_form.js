/**
 * js/family/recurring-expenses/_form.js
 */

let $           = require('jquery');
let categoryMap = require('Component/category-subcategory-select-map');

$(function() {
    $('#name').focus();

    categoryMap.attach('#category_id', '#sub_category');

    $('#merchant_id').change(function() {
        let jOption = $(this).find('option:selected');

        let defaultCategory = jOption.data('defaultCategory');
        let defaultSubCategory = jOption.data('defaultSubCategory');

        $('#category_id').val(defaultCategory).change();// <- make sure to trigger the change so the sub-category values get populated first
        $('#sub_category').val(defaultSubCategory);
    });
});
