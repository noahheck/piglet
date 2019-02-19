/**
 * family/calendar/month.js
 */

let $     = require('jquery');
let ajax  = require('Services/ajax');
let event = require('Services/event');

async function loadDayDetailsFromUrl(url) {

    try {
        let response = await ajax.get({url: url});

        $('#calendar_dayDetails').html(response.data.content);
    } catch (e) {
        console.log(e);
    }

}

$(function() {
    $('.day-link').click(function(e) {

        let ee = event(e);

        if (ee.openingInNewWindow()) {
            return;
        }

        ee.preventDefault();

        loadDayDetailsFromUrl($(this).attr('href'));
    });
});
