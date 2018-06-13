/**
 * js/component/pageMenu.js
 */

let $ = require('jquery');

$(function() {

    $("#pageMenuContainer .dropdown-trigger").click(function() {
        $("#pageMenuDropdownContent").slideToggle(150);
    });

    $("#pageMenuDeleteForm").submit(function() {
        if (!confirm("Are you sure you want to delete this?")) {
            return false;
        }
    })
});
