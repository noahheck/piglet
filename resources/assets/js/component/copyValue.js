/**
 * js/component/copyValue.js
 */

let $ = require('jquery');

let copyValue = {};

copyValue.attach = function(element, source, target) {

    $(element).click(function() {
        $(target).val($(source).val()).focus();
    });

};

module.exports = copyValue;
