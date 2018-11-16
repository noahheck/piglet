/**
 * js/services/routing.js
 */

let meta = require('Services/meta');


let routing = {};


routing.getUrl = function(route, params) {

    let family  = meta.get('family-id');

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
