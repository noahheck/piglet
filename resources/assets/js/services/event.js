/**
 * assets/js/services/event.js
 */

let $ = require('jquery');

let event = {};

/**
 *
 * @param event window.event
 * @param elementId string
 * @returns {boolean}
 */
event.inside = function(event, elementId) {
    let $clickTarget = $(event.target);

    if ($clickTarget.attr('id') === elementId) {
        return true;
    }

    let clickedInside = false;

    $clickTarget.parents().each(function() {
        if ($(this).attr('id') === elementId) {
            clickedInside = true;
        }
    });

    return clickedInside;
};

module.exports = event;
