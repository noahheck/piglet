/**
 * js/services/currency.js
 */

// let $ = require('jquery');

let currency = {};

/**
 * Strips non-numeric characters, then formats with up to 2 decimal places
 *
 * @param number
 * @returns string
 */
currency.format = function(number) {

    let formattedNumber = number.replace(/[^0-9.]/gi, '').toString();

    // Has (at least one) decimal point
    let positionOfDecimal = formattedNumber.indexOf('.');

    if (positionOfDecimal !== -1) {

        let charsBeforeDecimal = formattedNumber.substr(0, positionOfDecimal + 1);

        let charsAfterDecimal = formattedNumber.substr(positionOfDecimal + 1).replace(/\./g, '');

        let fullString = charsBeforeDecimal + '' + charsAfterDecimal;

        formattedNumber = fullString.substr(0, positionOfDecimal + 3);
    }

    return formattedNumber;

};

module.exports = currency;
