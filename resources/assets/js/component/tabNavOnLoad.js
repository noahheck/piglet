/**
 * js/component/tabNavOnLoad.js
 */

let $ = require('jquery');

$(function() {
    let hash = location.hash;

    if (!hash) {
        return;
    }

    let navTabsList = $('.nav-tabs');

    if (navTabsList.length === 0) {
        return;
    }

    navTabsList.find('a').each(function() {
        jThis = $(this);

        if (jThis.attr('href') === hash) {
            jThis.click();
        }
    });
});
