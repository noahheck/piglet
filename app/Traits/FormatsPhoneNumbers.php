<?php

namespace App\Traits;

trait FormatsPhoneNumbers
{
    public function formatForDatabase($number)
    {
        return preg_replace("/(^1|\D)/", '', $number);
    }

    public function formatForOutput($number)
    {
        $formatted = '';

        $numChars = strlen($number);

        if ($numChars < 4) {
            // do nothing to number
            $formatted = $number;
        } elseif ($numChars <= 7) {
            // format w/out the area code attribute
            $formatted = substr($number, 0, 3) . '-' . substr($number, 3);
        } elseif ($numChars <= 10) {
            // format with area code
            $formatted = '(' . substr($number, 0, 3) . ') ' .
                substr($number, 3, 3) . '-' .
                substr($number, 6);
        } else {
            // format with area code and extension
            $formatted = '(' . substr($number, 0, 3) . ') ' .
                substr($number, 3, 3) . '-' .
                substr($number, 6, 4) . ' x' .
                substr($number, 10);
        }


        return $formatted;
    }
}
