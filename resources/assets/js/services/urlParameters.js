/**
 * js/services/urlParameters.js
 */

const urlParams = new URLSearchParams(window.location.search);


let urlParameters = {};

urlParameters.has = function(name) {
    return urlParams.has(name);
};

urlParameters.get = function(name) {
    return urlParams.get(name);
};

module.exports = urlParameters;