/**
 * js/user-settings.js
 */

let $ = require('jquery');
let meta = require('Services/meta');

$(function() {

    $('#restoreBackgroundColorButton').click(() => {
        $('#background_color').val(meta.get('default-background-color'));
    });

});
