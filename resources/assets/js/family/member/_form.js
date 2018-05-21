/**
 * js/family/member/edit.js
 */

var $ = require('jquery');

$("#showChangePhotoFormButton").click(function() {

    $(this).hide();
    $("#memberPhotoInputContainer").removeClass('d-none');
});
