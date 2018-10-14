<?php

namespace App\Traits\Family;

use App\Family;
use App\Family\SettingsEntry;

trait StoresSettings
{
    protected $fetched = false;

    protected $settings;

    protected $defaults = [
        Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT   => '100.00',
        Family::MONEY_MATTERS_RETIREMENT_AMOUNT     => '300.00',
        Family::MONEY_MATTERS_EDUCATION_AMOUNT      => '100.00',
        Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT => '100.00',
    ];

    public static function settingsValidations()
    {
        return [
            Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT   => 'numeric|nullable',
            Family::MONEY_MATTERS_RETIREMENT_AMOUNT     => 'numeric|nullable',
            Family::MONEY_MATTERS_EDUCATION_AMOUNT      => 'numeric|nullable',
            Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT => 'numeric|nullable',
        ];
    }

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
        if ($this->hasSetting($setting)) {
            return $this->settings->where('setting', $setting)->first()->value;
        }

        return array_key_exists($setting, $this->defaults) ? $this->defaults[$setting] : null;
    }

    public function setSetting($setting, $value)
    {
        $this->fetchSettings();

        $entry = $this->settings->where('setting', $setting)->first();

        if (!$entry) {
            $entry = new SettingsEntry();
            $entry->setting = $setting;

            $this->settings->push($entry);
        }

        $entry->value = $value;

        $entry->save();

        return true;
    }
}
