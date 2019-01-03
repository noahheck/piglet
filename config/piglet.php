<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported timezones
    |--------------------------------------------------------------------------
    |
    | Lists the timezones available in the app - This list should (will) grow
    | over time, but it can be kept cleaner for now by limiting the options to
    | only those that are likely to be used.
    |
    */
    'timezones' => [
        'America/New_York'    => 'Eastern',
        'America/Chicago'     => 'Central',
        'America/Denver'      => 'Mountain',
        'America/Phoenix'     => 'Mountain (no DST)',
        'America/Los_Angeles' => 'Pacific',
        'America/Anchorage'   => 'Alaska',
        'America/Adak'        => 'Hawaii',
        'America/Honolulu'    => 'Hawaii (no DST)',
    ],

    'url' => 'https://github.com/noahheck/piglet',

    'races' => [
        'American Indian or Alaska Native',
        'Asian',
        'Black or African American',
        'Native Hawaiian or Other Pacific Islander',
        'White',
        'Other',
    ],
];
