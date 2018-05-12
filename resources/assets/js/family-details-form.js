/**
 * js/family-details-form.js
 */

var $ = require('jquery');

$('#showChangePhotoFormButton').click(function() {
    $(this).hide();
    $('#familyPhotoInputContainer').removeClass('d-none');
});
