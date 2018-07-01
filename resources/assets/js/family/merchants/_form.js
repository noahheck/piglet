/**
 * js/family/merchants/_form.js
 */

let $ = require('jquery');

function showAppropriateSubCategories() {

    let defaultCategory = $('#default_category_id');
    let catId           = defaultCategory.val();

    let defaultSubCategory = $('#default_sub_category');
    let curSubCategory     = defaultSubCategory.val();

    defaultSubCategory.val('').find('option').remove();
    defaultSubCategory.append(new Option('--', ''));

    if (!catId) {

        return;
    }

    let subCategories = defaultCategory.find('option:selected').data('options').split('|');

    for (let x = 0; x < subCategories.length; x++) {

        let subCategory = subCategories[x];

        defaultSubCategory.append(new Option(subCategory, subCategory));
    }

    defaultSubCategory.val(curSubCategory);
}

$(function() {

    $('#name').focus();

    $('#default_category_id').change(showAppropriateSubCategories);

    showAppropriateSubCategories();
});
