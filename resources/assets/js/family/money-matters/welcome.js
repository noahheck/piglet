/**
 * js/family/money-matters/nav.js
 */

let $ = require('jquery');

let currentPage = 2;
let numPages;
let pages;

let nextButton;
let previousButton;

function nextPage() {
    currentPage++;

    showPage(currentPage);
}

function previousPage() {
    currentPage--;

    showPage(currentPage);
}

function showPage(pageNumber) {
    pages.hide();

    $('#wizard_page_' + pageNumber).show();

    (pageNumber === numPages) ? nextButton.hide()     : nextButton.show();
    (pageNumber === 1)        ? previousButton.hide() : previousButton.show();
}



function cloneAndAddResourceRow(templateId, targetId) {
    let newRow = $('#' + templateId).clone(true);

    newRow.removeClass('template');
    newRow.attr('id', '');

    $('#' + targetId).append(newRow);
}



$(function() {

    pages = $('.wizard-page');

    numPages = pages.length;

    nextButton     = $('#wizard_button_forward');
    previousButton = $('#wizard_button_back');

    nextButton.click(nextPage);
    previousButton.click(previousPage);

    showPage(currentPage);

    $('.add-new-resource-button').click(function() {
        let $this = $(this);

        cloneAndAddResourceRow($this.data('template'), $this.data('target'));
    });

    $('.delete-resource-button').click(function() {

        console.log($(this).closest('.money-matters-resource'));

        $(this).closest('.money-matters-resource').remove();
    });
});
