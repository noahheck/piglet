<?php

namespace App\Traits\Family;

use App\Family\SettingsEntry;

trait StoresSettings
{
    protected $fetched = false;

    protected $settings;

    protected $defaults = [
        'money-matters.pocket-money-amount' => '100.00',
    ];

    protected function fetchSettings()
    {
        if (!$this->fetched) {
            $this->settings = SettingsEntry::all();

            $this->fetched = true;
        }
    }

    public function hasSetting($setting)
    {
        $this->fetchSettings();

        return $this->settings->where('setting', $setting)->count() > 0;
    }

    public function getSetting($setting)
    {
        return $this->hasSetting($setting) ? $this->settings->where('setting', $setting)->first()->value : $this->defaults[$setting];
    }

    public function setSetting($setting, $value)
    {

    }
}
