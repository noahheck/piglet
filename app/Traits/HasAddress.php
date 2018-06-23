<?php

namespace App\Traits;

trait HasAddress
{
    public function getAddressAttribute()
    {
        if (!$this->address1 && !$this->address2 && !$this->city && !$this->state && !$this->zip) {
            return '';
        }

        $responseValues = [];

        if ($this->address1) {
            $responseValues[] = $this->address1;
        }

        if ($this->address2) {
            $responseValues[] = $this->address2;
        }

        if ($this->city) {
            $cityStateZip = ($this->state || $this->zip) ? $this->city . ', ' : $this->city;

            $cityStateZip .= ($this->state && $this->zip) ? $this->state . ' ' : $this->state;

            $cityStateZip .= $this->zip;

            $responseValues[] = $cityStateZip;
        }

        return implode("\n", $responseValues);
    }
}
