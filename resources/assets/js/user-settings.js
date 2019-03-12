/**
 * js/user-settings.js
 */

let $ = require('jquery');
let meta = require('Services/meta');

$(function() {

    let colorField = $('#background_color');

    $('#restoreBackgroundColorButton').click(() => {
        colorField.val(meta.get('default-background-color')).change();
    });

    colorField.change(() => {
        $('body').css('backgroundColor', colorField.val());
    });

});
