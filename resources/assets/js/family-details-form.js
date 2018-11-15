/**
 * js/family-details-form.js
 */

let $ = require('jquery');


$(() => {

    $('#family_name').focus();

    $('#showChangePhotoFormButton').click(function() {
        $(this).hide();
        $('#familyPhotoInputContainer').removeClass('d-none');
    });
});
