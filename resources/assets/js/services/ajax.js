/**
 * js/services/ajax.js
 */

let $       = require('jquery');
let routing = require('Services/routing');


let ajax = {};


function ajaxRequest(method, route, data) {
    return new Promise((resolve, reject) => {

        let ajaxData = {
            url     : routing.getUrl(route),
            dataType: 'json',
            data    : data,
            type    : method,
            success : function(response) {
                if (!response.success) {

                    if (response.errors.length > 0) {
                        alert(response.errors.join("\n"));
                    }

                    reject(response);
                }

                resolve(response);
            },
            error   : function(obj, error, exc) {
                // Probably want to do something more than this
                reject();
            },
            complete: function() {

            }
        };

        $.ajax(ajaxData);

    });
}

let csrf_token = $("meta[name='csrf-token']").attr('content');

ajax.post = function(route, data) {

    data = (data) ? data : {};

    /**
     * Ensure the csrf token is sent back with POST requests
     */
    data._token = csrf_token;

    return ajaxRequest('POST', route, data);
};

ajax.get = function(route, data) {
    return ajaxRequest('GET', route, data);
};

module.exports = ajax;
