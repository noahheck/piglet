/**
 * js/family/cash-flow-plans/income-sources/index.js
 */

let $ = require('jquery');

$(function() {

    let hash = location.hash;

    if (hash === '#actual') {
        $('#actualTab').click();
    } else if (hash === '#budget') {
        $('#budgetTab').click();
    }

});
