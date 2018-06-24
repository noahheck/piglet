/**
 * js/family/money-matters/nav.js
 */

let $ = require('jquery');

$('#settingsItem').click(function() {

    let jThis = $(this);
    let action = 'show';

    if (jThis.hasClass('settingsActive')) {
        action = 'hide';
    }

    $(this).toggleClass('settingsActive');

    if (action === 'show') {
        $('.settings-item').show();
    } else {
        $('.settings-item').hide();
    }

});
