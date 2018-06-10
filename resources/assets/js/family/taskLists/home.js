/**
 * js/family/taskLists/home.js
 */

let $ = require('jquery');

$('#showInactiveListsButton').click(function() {
    $(this).hide();

    $('#inactiveTaskLists').removeClass('d-none');
});
