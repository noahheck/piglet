<?php

namespace App\Traits\User;

trait FormatsCurrency
{
    public function formatCurrency($amount = null, $withFormatting = true)
    {
        $sigil     = '';
        $separator = '';

        if ($withFormatting) {
            $sigil     = '$';
            $separator = ',';
        }

        if (!$amount) {
            return ($withFormatting) ? $sigil . '0.00' : null;
        }

        return $sigil . number_format($amount, 2, '.', $separator);
    }
}
