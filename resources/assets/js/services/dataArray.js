/**
 * js/services/dataArray.js
 */

let $ = require('jquery');

let dataArray = {};

dataArray.build = function(elements, attr) {

    return $(elements).map(function(i, element) {
        return $(element).data(attr);
    }).get();
};

module.exports = dataArray;
