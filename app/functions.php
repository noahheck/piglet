<?php

namespace App;

function formatCurrency($amount = null, $withFormatting = null) {
    return \Auth::user()->formatCurrency($amount, $withFormatting);
}



function formatDate(\DateTime $date = null) {
    return \Auth::user()->formatDate($date);
}

function formatDateTime(\DateTime $datetime, $format = null) {
    return \Auth::user()->formatDateTime($datetime, $format);
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


function stripQueryString($url) {
    if (!$index = strpos($url, '?')) {
        return $url;
    }

    return substr($url, 0, $index);
}

function urlWithQueryString($url, $queryParams) {
    $url = stripQueryString($url);

    $queryStringArguments = [];

    foreach ($queryParams as $key => $value) {
        $queryStringArguments[] = urlencode($key) . '=' . urlencode($value);
    }

    return $url . '?' . implode('&', $queryStringArguments);
}
