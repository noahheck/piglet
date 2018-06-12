/**
 * js/component/pageMenu.js
 */

let $ = require('jquery');

$(function() {
    $("#pageMenuDropdownTrigger").click(function() {
        $(this).toggleClass("fa-chevron-down fa-chevron-up");

        $("#pageMenuDropdownContent").slideToggle(150);
    })
});
