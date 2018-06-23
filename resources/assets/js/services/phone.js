/**
 * js/services/phone.js
 */

// let $ = require('jquery');

let phone = {};

phone.format = function(number) {

    let stripped = number.replace(/\D/g, '');

    if (!stripped) {
        return '';
    }

    let numChars = stripped.length;
    let newValue = "";

    if (numChars <= 3) {
        newValue = stripped;
    } else if (numChars <= 7) {
        newValue = stripped.substring(0, 3) + "-" + stripped.substring(3);
    } else if (numChars <= 10) {
        newValue = "(" + stripped.substring(0, 3) + ") " + stripped.substring(3, 6) + "-" + stripped.substring(6);
    } else if (numChars > 10) {
        newValue = "(" + stripped.substring(0, 3)  + ") "
            +        stripped.substring(3, 6)
            + "-"  + stripped.substring(6, 10)
            + " x" + stripped.substring(10);
    }

    return newValue;

};

module.exports = phone;
