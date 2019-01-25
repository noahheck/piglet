/**
 * js/component/moneyField.js
 *
 * Took keycodes from https://css-tricks.com/snippets/javascript/javascript-keycodes/
 */

let $ = require('jquery');

let moneyField = {};

function isControlCode(code) {
    let controlCodes = [
        8, 9, 13, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 91, 92,
        112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 144, 145
    ];

    return controlCodes.indexOf(code) !== -1;
}

function isCodeAllowed(code, hasDecimal) {

    if (isControlCode(code)) {
        return true;
    }

    if (!hasDecimal && [110, 190].indexOf(code) !== -1) {
        // Decimal point hasn't been added to the field yet
        return true;
    }

    if ((code >= 35 && code <= 57) || (code >= 96 && code <= 105)) {
        return true;
    }

    return false;
}

moneyField.attach = function(element) {

    $(element).keydown(function(e) {
        let curVal = $(this).val();
        let hasDecimal = curVal.match(/\./);

        let charCode = (e.which) ? e.which : e.keyCode;

        if (isControlCode(charCode)) {
            return true;
        }

        if (!isCodeAllowed(charCode, hasDecimal)) {
            return false;
        }

        // Limit the content to 2 decimal places
        if (hasDecimal) {

            // Account for 0-based indexing
            let decimalPosition = curVal.indexOf('.') + 1;

            let curCursorPosition = e.target.selectionStart;

            // Cursor is on the left side of the decimal
            if (curCursorPosition < decimalPosition) {
                return true;
            }

            let numCharsAfterDecimal = curVal.length - decimalPosition;

            // Already 2 characters after decimal
            if (numCharsAfterDecimal >= 2) {
                return false;
            }
        }
    });

};

module.exports = moneyField;
