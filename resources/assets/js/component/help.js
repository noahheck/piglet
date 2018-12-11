/**
 * js/component/pageMenu.js
 */

let $    = require('jquery');
let ajax = require('Services/ajax');
let modal = require('Component/modal');

$(function() {

    $(".help-link").click(function(e) {

        // Allow the link to load in a new tab
        if (e.ctrlKey) {
            return;
        }

        e.preventDefault();

        let url = $(this).attr('href');

        ajax.get({url: url}).then(function(response) {
            console.log(response);

            modal.display('Help', response.data.content);
        });
    });

});
