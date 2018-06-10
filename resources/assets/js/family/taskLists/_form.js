/**
 * js/family/taskLists/_form.js
 */

let $ = require('jquery');

$("#deleteTaskListForm").submit(function(e) {

    if (!confirm("Are you sure you want to delete this task list?")) {

        return false;
    }

});

$(function() {
    $("#title").focus();
});
