/**
 * js/component/notify.js
 */

const successNotification = window.createNotification({
    theme: 'success',
    showDuration: 4000
});

const infoNotification = window.createNotification({
    theme: 'info',
    showDuration: 12000
});

const warningNotification = window.createNotification({
    theme: 'warning',
    showDuration: 0
});

const errorNotification = window.createNotification({
    theme: 'error',
    showDuration: 0
});



let notify = {};

notify.success = function(message) {
    successNotification({message: message});
};

notify.info = function(message) {
    infoNotification({message: message});
};

notify.warning = function(message) {
    warningNotification({message: message});
};

notify.error = function(message) {
    errorNotification({message: message});
};

module.exports = notify;
