/**
 * controllers/day_loader_controller.js
 */

import { Controller } from "stimulus"

let $     = require("jquery")
let ajax  = require("Services/ajax");
let event = require('Services/event');

export default class extends Controller {

    static get targets() {
        return ["link"]
    }

    connect() {

    }

    async loadDayView(e) {

        let ee = event(e);

        if (ee.openingInNewWindow()) {
            return;
        }

        ee.preventDefault();

        let url = $(this.linkTarget).attr("href")

        let response = await ajax.get({url: url});

        $('#calendar_dayDetails').html(response.data.content);
    }
}
