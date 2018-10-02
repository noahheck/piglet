/**
 * js/family/cash-flow-plans/show.js
 */

let $ = require('jquery');

$(function() {

    $('.toggle-recurring-expenses-list').click(function(e) {

        e.preventDefault();

        let $this = $(this);

        let target = $(this).data('toggleTarget');

        $('#' + target).slideToggle(200);

        $this.find(".fa").toggleClass('fa-eye fa-eye-slash');

        $this.find('.action').text(
            ($this.find('.action').text() === "View Expenses") ? "Hide Expenses" : "View Expenses"
        );

    });

});
