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

    $('#enableSupportAccess').click(function(e) {
        if (!confirm("Are you sure you want to enable support access to your family?\n\n" +
            "This will allow our support staff to access your family's information to help troubleshoot issues you're having with the application.\n\n" +
            "You can disable this functionality at anytime by returning here and choosing the appropriate option from the menu."
        )) {
            e.preventDefault();

            return false;
        }
    });

    $('#unarchiveFamily').click(function(e) {
        if (!confirm("Are you sure you want to un-archive this family?")) {
            e.preventDefault();

            return false;
        }
    });
});
