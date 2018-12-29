/**
 * js/component/pageMenu.js
 */

let $     = require('jquery');
let ajax  = require('Services/ajax');
let modal = require('Component/modal');
let notify = require('Component/notify');

$(function() {

    $(".help-link").click(function(e) {

        // Allow the link to load in a new tab
        if (e.ctrlKey) {
            return;
        }

        e.preventDefault();

        let url = $(this).attr('href');

        ajax.get({url: url}).then(function(response) {
            modal.display('Help', '<div class="help-content">' + response.data.content + '</div>');
        }).catch(function() {
            notify.error("Oh man, it looks like we can't find the help section for this page.");
        });
    });

});
