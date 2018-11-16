/**
 * js/services/meta.js
 *
 * Loads content from html meta tags with the data-piglet attribute (i.e. those created with the Blade directive)
 * - loads all tags into memory on page load and wraps in the closure to prevent modification
 */

let $ = require('jquery');

let metaData = {};
let meta     = {};

meta.get = function(name, fallback) {

    return (metaData[name]) ? metaData[name] : fallback;
};

$(function() {
    $("meta[data-piglet]").each(function() {
        let $this   = $(this);
        let name    = $this.attr('name');
        let content = $this.attr('content');

        if ($this.data('json')) {
            content = JSON.parse(content);
        }

        metaData[name] = content;
    });
});

module.exports = meta;
