<?php

namespace App\Traits;

trait HasUnchangeableProperties
{
    /**
     * Implementers should define array of unchangeable properties (properties that should not be able to be modified
     * after the model is created
     */
    //protected $unchangeable = [];

    public function getUnchangeableProperties()
    {
        return $this->unchangeable;
    }

    public function getUpdateableProperties()
    {
        return array_diff($this->fillable, $this->unchangeable);
    }

    public function getUpdateableValidations()
    {
        return array_intersect_key($this->getValidations(), array_flip($this->getUpdateableProperties()));
    }
}
