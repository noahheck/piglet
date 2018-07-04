/**
 * js/family/merchants/_form.js
 */

let $           = require('jquery');
let categoryMap = require('Component/category-subcategory-select-map');

/*function showAppropriateSubCategories() {

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

        if (curSubCategory === subCategory) {
            defaultSubCategory.val(curSubCategory);
        }
    }

}*/

$(function() {

    $('#name').focus();

    categoryMap.attach('#default_category_id', '#default_sub_category');

    // $('#default_category_id').change(showAppropriateSubCategories);
    //
    // showAppropriateSubCategories();
});
