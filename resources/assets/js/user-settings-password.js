/**
 * js/user-settings-password.js
 */

let $ = require('jquery');


let p1 = $("#user-settings_password");
let p2 = $("#user-settings_password-confirmation");

let newPasswordLength   = $("#newPasswordLengthError");
let newPasswordMismatch = $("#newPasswordsMismatchError");

p1.keydown(function() {
    newPasswordLength.addClass("d-none");
    newPasswordMismatch.addClass("d-none");
});

p1.blur(function() {
    newPasswordLength.addClass("d-none");

    let newPassword = p1.val();

    if (newPassword && newPassword.length < 8) {
        newPasswordLength.removeClass("d-none");
    }
});

p2.blur(function() {
    newPasswordMismatch.addClass("d-none");

    let pass1 = p1.val();
    let pass2 = p2.val();

    if (pass1 && pass2 && pass1 !== pass2) {
        newPasswordMismatch.removeClass("d-none");
    }
});

$("#user-settings_password-form").submit(function() {

    let hasError = false;

    let pass1 = p1.val();
    let pass2 = p2.val();

    if (pass1.length < 8) {
        newPasswordLength.removeClass("d-none");

        hasError = true;
    }

    if (pass1 !== pass2) {
        newPasswordMismatch.removeClass("d-none");
        p1.focus();

        hasError = true;
    }

    if (hasError) {

        return false;
    }
});
