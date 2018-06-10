/**
 * js/family/tasks._form.js
 */

let $ = require('jquery');

$('#deleteTaskForm').submit(function(e) {
    if (!confirm("Are you sure you want to delete this task?")) {
        return false;
    }
});

$(function() {
    $("#title").focus();
});
