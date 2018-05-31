/**
 * js/family/member/edit.js
 */

let $ = require('jquery');

$("#showChangePhotoFormButton").click(function() {

    $(this).hide();
    $("#memberPhotoInputContainer").removeClass('d-none');
});
