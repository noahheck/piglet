/**
 * controllers/image_upload_preview_controller.js
 *
 * Technique for displaying the image preview from:
 *  https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
 */

import { Controller } from "stimulus"

let $ = require("jquery")

export default class extends Controller {

    static get targets () {
        return  [ "image", "input" ]
    }

    connect() {
    }

    preview() {
        console.log("Updating preview")
        console.log(this.inputTarget)

        if (!this.inputTarget.files ||!this.inputTarget.files[0]) {
            return ""
        }

        let image = this.imageTarget

        let reader = new FileReader();

        reader.onload = (e) => {
           $(image).attr('src', e.target.result).addClass("in-preview")

        }

        reader.readAsDataURL(this.inputTarget.files[0])
    }

}
