/**
 * js/family/money-matters/nav.js
 */

let $ = require('jquery');

let currentPage = 1;
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

$(function() {

    pages = $('.wizard-page');

    numPages = pages.length;

    nextButton     = $('#wizard_button_forward');
    previousButton = $('#wizard_button_back');

    nextButton.click(nextPage);
    previousButton.click(previousPage);

    showPage(1);
});
