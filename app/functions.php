<?php

namespace App;

function formatCurrency($amount = null, $withFormatting = null) {
    return \Auth::user()->formatCurrency($amount, $withFormatting);
}


function formatDate(\DateTime $date = null) {
    return \Auth::user()->formatDate($date);
}


function flashMessage($category, $message) {
    return \Session::flash($category, $message);
}


function flashSuccess($key, $replace = []) {
    $message = \__($key, $replace);

    return flashMessage('success', $message);
}

function flashWarning($key, $replace = []) {
    $message = \__($key, $replace);

    return flashMessage('warning', $message);
}

function flashError($key, $replace = []) {
    $message = \__($key, $replace);

    return flashMessage('error', $message);
}

function flashInfo($key, $replace = []) {
    $message = \__($key, $replace);

    return flashMessage('info', $message);
}
