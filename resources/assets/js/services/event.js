/**
 * assets/js/services/event.js
 */

let $ = require('jquery');

let event = function(e) {

    let event = e;
    let o     = {};

    /**
     * Tells whether the target of the event is or is a child of the provided element
     * @param elementId
     * @returns {boolean}
     */
    o.inside = function(elementId) {
        let $clickTarget = $(event.target);

        if ($clickTarget.attr('id') === elementId) {
            return true;
        }

        let clickedInside = false;

        $clickTarget.parents().each(function() {
            if ($(this).attr('id') === elementId) {
                clickedInside = true;

                return false;
            }
        });

        return clickedInside;
    };

    /**
     * Tells whether a link click event is attempting to be opened in a new tab/window
     * @returns {boolean}
     */
    o.openingInNewWindow = function() {

        let response = false;

        if (event.ctrlKey || event.shiftKey) {
            return true;
        }

        return response;
    };

    /**
     * Calls preventDefault on the root event
     * @returns {o}
     */
    o.preventDefault = function() {
        event.preventDefault();

        return this;
    };

    return o;
};



module.exports = event;
