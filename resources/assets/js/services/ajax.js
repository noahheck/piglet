/**
 * js/services/ajax.js
 */

let $ = require('jquery');

let ajax = {};


function ajaxRequest(method, route, data) {
    return new Promise((resolve, reject) => {

        let ajaxData = {
            url     : route,
            dataType: 'json',
            data    : data,
            type    : method,
            success : function(response) {
                if (!response.success) {
                    // Do something to log the error (at least)
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


ajax.post = function(route, data) {
    return ajaxRequest('POST', route, data);
};

ajax.get = function(route, data) {
    return ajaxRequest('GET', route, data);
};

module.exports = ajax;
