/**
 * js/component/category-subcategory-select-map.js
 */

let $ = require('jquery');

let selectMap = {};

function showAppropriateSubCategories(categoryField, subCategoryField) {

    let defaultCategory = $(categoryField);
    let catId           = defaultCategory.val();

    let defaultSubCategory = $(subCategoryField);
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
}

selectMap.attach = function(categoryField, subCategoryField) {

    $(categoryField).change(function() {
        showAppropriateSubCategories(categoryField, subCategoryField);
    });

    $(function() {
        showAppropriateSubCategories(categoryField, subCategoryField);
    });

};

module.exports = selectMap;
