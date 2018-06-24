/**
 * js/family/categories/index.js
 */

let $        = require('jquery');
let sortable = require('sortablejs');

let ajax      = require('Services/ajax');
let dataArray = require('Services/dataArray');

$(function() {

    sortable.create(document.getElementById('activeCategories'), {
        handle: '.sort-handle',
        onUpdate: function() {

            let orderedCategories = dataArray.build('#activeCategories .list-group-item', 'categoryId');

            let route = {name: 'family.categories.update-order'};

            ajax.post(route, {orderedCategories: orderedCategories}).then(function(response) {
                console.log(response);
            }).catch(function(response) {
                console.log(response);
            });
        }
    });

});
