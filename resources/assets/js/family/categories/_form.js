/**
 * js/family/categories/_form.js
 */

let $ = require('jquery');
let sortable = require('sortablejs');

function addSubCategory() {
    let newCategoryTextBox = $("#newSubCategory");
    let newCategory = newCategoryTextBox.val();

    if (!newCategory) {
        return;
    }

    let li = $("#newSubCategoryTemplate").clone(true, true);

    li.find('.category-title').text(newCategory);
    li.find('input').val(newCategory);

    $('#subCategories').append(li);

    newCategoryTextBox.val('').focus();
}

$(function() {
    $('#name').focus();

    $("#newSubCategory").keypress(function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();

            addSubCategory();
        }
    });

    $("#addNewSubCategory").click(addSubCategory);

    sortable.create(document.getElementById('subCategories'), {
        handle: '.sort-handle'
    });

    $('.sub-category-item .delete-icon').click(function() {
        $(this).parent().remove();
    });

});
