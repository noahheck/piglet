/**
 * js/family/cash-flow-plans/show.js
 */

let $        = require('jquery');
let meta     = require('Services/meta');
let jsCookie = require('js-cookie');


let cashFlowPlanId = false;

function getCashFlowPlanId() {
    if (!cashFlowPlanId) {
        cashFlowPlanId = meta.get('cash-flow-plan-id');
    }

    return cashFlowPlanId;
}


let cfpCookieName             = 'cfp-id';
let scrollCookieName          = 'cfp-scroll';
let expandedTargetsCookieName = 'cfp-targets';


let currentCookieCFP = jsCookie.get(cfpCookieName);

if (currentCookieCFP !== getCashFlowPlanId()) {
    jsCookie.set(cfpCookieName, getCashFlowPlanId());
    jsCookie.set(scrollCookieName, 0);
    jsCookie.set(expandedTargetsCookieName, []);
}



$(function() {

    let $window = $(window);

    // Expand the sections that were expanded on the last request
    if (jsCookie.getJSON(expandedTargetsCookieName)) {
        $(jsCookie.getJSON(expandedTargetsCookieName)).each(function() {
            $('#' + this).show();
        });
    }

    // Scroll to the position the window was scrolled to on the last request
    if (jsCookie.get(scrollCookieName)) {
        $window.scrollTop(jsCookie.get(scrollCookieName));
    }

    $window.scroll(() => {
        jsCookie.set(scrollCookieName, $window.scrollTop());
    });



    $('.toggle-entries-list').click(function(e) {
        e.preventDefault();

        let $this = $(this);

        let target = $this.data('toggleTarget');

        let $target = $('#' + target);


        // Maintain the open sections across requests
        expandedTargets = jsCookie.getJSON(expandedTargetsCookieName);

        if ($target.is(':visible')) {
            expandedTargets.splice(expandedTargets.indexOf(target), 1);
        } else {
            expandedTargets.push(target);
        }

        jsCookie.set(expandedTargetsCookieName, expandedTargets);


        $target.slideToggle(200);

        $this.find('.list-item-display-action').toggle();
    });

});
