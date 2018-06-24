/**
 * js/component/domSearch.js
 */

let $ = require('jquery');

let domSearch = {};

domSearch.attach = function(element, config) {

    let searchItems = config.searchItems;

    $(element).keyup(function() {

        let itemsToSearch = $(searchItems);

        let searchString = $(this).val();

        if (!searchString) {
            itemsToSearch.show();

            return;
        }

        let regex = new RegExp(searchString, 'i');

        itemsToSearch.each(function() {

            let jItem = $(this);

            let content = (jItem.data('searchContent')) ? jItem.data('searchContent') : jItem.text();

            if (!regex.test(content)) {
                jItem.hide();

                return;
            }

            jItem.show();
        });
    });

};

module.exports = domSearch;
