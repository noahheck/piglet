/**
 * js/component/modal.js
 */

let $ = require('jquery');

let modal = {};

let appModal;

$(function(){
    appModal = $('#applicationModal').modal({show: false});
});


modal.setTitle = function(title) {
    let modalTitle = appModal.find('#modalTitle');
    if (!title) {
        title = modalTitle.data('defaultTitle');
    }
    modalTitle.text(title);
};


modal.setContent = function(content) {
    let modalBody = appModal.find('#modalBody');
    modalBody.empty().html(content);
};


modal.display = function(title, content) {

    modal.setTitle(title);
    modal.setContent(content);

    appModal.modal('show');
};

module.exports = modal;
