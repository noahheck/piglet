/**
 * js/services/routing.js
 */

let $ = require('jquery');

let routing = {};

let family  = $("meta[name='family-id']").attr('content');

routing.getUrl = function(route, params) {

    if (typeof route === 'object') {

        if (route.url) {
            return route.url;
        }

        params = (route.params) ? route.params : params;
        route  = route.name;
    }

    params = (params) ? params : {};

    if (family) {
        params.family = family;
    }

    return window.route(route, params);
};

module.exports = routing;
