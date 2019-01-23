/**
 * js/component/pageMenu.js
 */

let $        = require('jquery');
let ajax     = require('Services/ajax');
let modal    = require('Component/modal');
let notify   = require('Component/notify');
let pageMenu = require('Component/pageMenu');

function loadHelp(url) {
    ajax.get({url: url}).then(function(response) {

        let content = $('<div class="help-content">' + response.data.content + '</div>');

        // This allows the links in the embedded help docs to load in the current view
        content.find('a.help-link').click(function(e) {
            clickHelpLink(this, e);
        });

        help.augmentMarkup(content);

        modal.display('Help', content);
    }).catch(function() {
        notify.error("Oh man, it looks like we can't find the help section for this page.");
    }).finally(function() {
        pageMenu.close();
    });
}

function clickHelpLink(link, e) {
    // Allow the link to load in a new tab
    if (e.ctrlKey || e.shiftKey) {
        pageMenu.close();
        return;
    }

    e.preventDefault();

    let url = $(link).attr('href');

    loadHelp(url);
}

$(function() {

    $(".load-help-link").click(function(e) {
        clickHelpLink(this, e);
    });

});



let help = {};

help.augmentMarkup = function(content) {

    let augmentedContent = $(content);

    augmentedContent.find('.tip').prepend("<h5>Tip!</h5>");
    augmentedContent.find('.note').prepend("<h5>Note</h5>");

    return augmentedContent;
};

module.exports = help;
