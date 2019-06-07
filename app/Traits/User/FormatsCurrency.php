<?php

namespace App\Traits\User;

trait FormatsCurrency
{
    public function formatCurrency($amount = null, $withFormatting = true)
    {
        $minus     = '';
        $sigil     = '';
        $separator = '';

        if ($amount < 0) {
            $amount = abs($amount);
            $minus = '-';
        }

        if ($withFormatting) {
            $sigil     = '$';
            $separator = ',';
        }

        if (!$amount) {
            return ($withFormatting) ? $sigil . '0.00' : null;
        }

        $amount = preg_replace("/[^0-9\.]/", '', $amount);

        return $minus . $sigil . number_format($amount, 2, '.', $separator);
    }
}
