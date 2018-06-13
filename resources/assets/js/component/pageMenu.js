/**
 * js/component/pageMenu.js
 */

let $ = require('jquery');

$(function() {
    $("#pageMenuContainer .dropdown-trigger").click(function() {
        $("#pageMenuDropdownContent").slideToggle(150);
    })
});
