/**
 * js/family/money-matters/nav.js
 */

let $ = require('jquery');

let currentPage = 1;
let numPages;
let pages;

let nextButton;
let previousButton;
let finishButton;

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

    finishButton.hide();

    (pageNumber === numPages) ? nextButton.hide() && finishButton.show()    : nextButton.show();
    (pageNumber === 1)        ? previousButton.hide()                       : previousButton.show();
}



function cloneAndAddResourceRow(templateId, targetId) {
    let newRow = $('#' + templateId).clone(true);

    newRow.removeClass('template');
    newRow.attr('id', '');

    $('#' + targetId).append(newRow);

    newRow.find("input[type='text']").first().focus();
}



$(function() {

    pages = $('.wizard-page');

    numPages = pages.length;

    nextButton     = $('#wizard_button_forward');
    previousButton = $('#wizard_button_back');
    finishButton   = $('#wizard_button_finish');

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
