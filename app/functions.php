<?php

namespace App;

function formatCurrency($amount = null, $withFormatting = null) {
    return \Auth::user()->formatCurrency($amount, $withFormatting);
}
