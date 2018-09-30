<?php

namespace App;

function formatCurrency($amount = null, $withFormatting = null) {
    return \Auth::user()->formatCurrency($amount, $withFormatting);
}


function formatDate(\DateTime $date = null) {
    return \Auth::user()->formatDate($date);
}
