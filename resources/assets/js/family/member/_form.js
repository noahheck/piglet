/**
 * js/family/member/edit.js
 */

let $ = require('jquery');

$("#showChangePhotoFormButton").click(function() {

    $(this).hide();
    $("#memberPhotoInputContainer").removeClass('d-none');
});




function isLoginChecked() {
    return $("#allow_login").is(":checked");
}

function toggleLoginDetails() {

    let action = isLoginChecked() ? "show" : "hide";

    $("#loginDetails").collapse(action);
}




$(function() {

    $("#allow_login").change(function() {
        toggleLoginDetails();
        if (isLoginChecked()) {
            $("#login_email").focus();
        }

    });

    toggleLoginDetails();

});
