/**
 * controllers/toggle_new_merchant_controller.js
 *
 * Show the embedded inline form field to add a new merchant from a different form (expense group, etc)
 */

import { Controller } from "stimulus"

let $ = require("jquery")

export default class extends Controller {

    static get targets () {
        return  [ "newGroup", "existingGroup", "merchantId", "newMerchantName" ]
    }

    connect() {
    }

    showNewMerchant() {
        $(this.existingGroupTarget).toggleClass('d-none');
        $(this.merchantIdTarget).val('');

        $(this.newGroupTarget).toggleClass('d-none');
        $(this.newMerchantNameTarget).focus();
    }

    cancelNewMerchant() {
        $(this.existingGroupTarget).toggleClass('d-none');

        $(this.newGroupTarget).toggleClass('d-none');
        $(this.newMerchantNameTarget).val('');

        $(this.merchantIdTarget).focus();

    }

}
