/**
 * js/family/recurring-expenses/_form.js
 */

let $           = require('jquery');
let categoryMap = require('Component/category-subcategory-select-map');

$(function() {
    $('#name').focus();

    categoryMap.attach('#category_id', '#sub_category');

});
