/**
 * js/family/merchants/_form.js
 */

let $ = require('jquery');

function showAppropriateSubCategories() {
    let catId = $('#default_category_id').val();

    let defaultSubCategory = $('#default_sub_category');
    let options            = $('.sub-category');

    options.hide();

    if (!catId) {
        defaultSubCategory.val('');
        return;
    }

    let selOption = $('#default_sub_category option:selected');

    if (selOption.data('categoryId') != catId) {
        defaultSubCategory.val('');
    }

    options.each(function() {
        let jThis = $(this);

        if (jThis.data('categoryId') == catId) {
            jThis.show();
        }
    });
}

$(function() {

    $('#name').focus();

    $('#default_category_id').change(showAppropriateSubCategories);

    showAppropriateSubCategories();
});
