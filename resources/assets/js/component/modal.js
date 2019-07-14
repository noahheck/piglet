/**
 * js/component/modal.js
 */

let $ = require('jquery');

let modal = {};

let appModal;

function hashTitle(title) {
    return title.replace(/\s+/gi, '-').toLowerCase();
}

$(function(){
    appModal = $('#applicationModal').modal({show: false});


    appModal.on('hide.bs.modal', function() {
        if (window.location.hash === currentHash) {
            window.history.back();

            currentHash = '';
        }
    });

    $(window).on('popstate', function () {

        appModal.modal('hide');
    });

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

    if (appModal.data('bs.modal')._isShown) {
        appModal.animate({ scrollTop: 0 }, 'fast');
    }
};

let currentHash = '';

modal.display = function(title, content) {

    modal.setTitle(title);
    modal.setContent(content);

    let hashReadyTitle = hashTitle(title);
    currentHash = '#' +  hashReadyTitle;

    if (currentHash !== window.location.hash) {
        window.history.pushState('forward', null, '#' + hashReadyTitle);
    }

    appModal.modal('show');
};



module.exports = modal;
