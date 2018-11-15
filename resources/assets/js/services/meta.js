/**
 * js/services/meta.js
 */

let $ = require('jquery');

let meta = {};

meta.get = function(name, fallback) {

    let selector = "meta[name='" + name + "']";

    let $meta = $(selector);

    if (!$meta.length) {
        return fallback;
    }

    return $meta.attr('content');
};

module.exports = meta;
