/**
 * js/component/pageMenu.js
 */

let $     = require('jquery');
let event = require('Services/event');

$(function() {

    let $dropdownContent = $("#pageMenuDropdownContent");

    $("#pageMenuContainer .dropdown-trigger").click(function() {
        $dropdownContent.slideToggle(150);
    });

    window.addEventListener("click", function(e) {

        if (!$dropdownContent.is(":visible") || event.inside(e, 'pageMenuContainer')) {
            return false;
        }

        $dropdownContent.slideToggle(150);
    });

    $("#pageMenuDeleteForm").submit(function() {
        if (!confirm("Are you sure you want to delete this?")) {
            return false;
        }
    })
});
