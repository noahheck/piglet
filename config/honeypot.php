<?php

use Spatie\Honeypot\SpamResponder\BlankPageResponder;

return [

    /*
     * Here you can specify name of the honeypot field. Any requests that submit a non-empty
     * value for this name will be discarded. Make sure this name does not
     * collide with a form field that is actually used.
     */
    'name_field_name' => 'gender',

    /*
     * When this is activated there will be a random string added
     * to the name_field_name. This improves the
     * protection against bots.
     */
    'randomize_name_field_name' => true,

    /*
     * This field contains the name of a form field that will be used to verify
     * if the form wasn't submitted too quickly. Make sure this name does not
     * collide with a form field that is actually used.
     */
    'valid_from_field_name' => 'valid_from',

    /*
     * If the form is submitted faster then this amount of seconds
     * the form submission will be considered invalid.
     */
    'amount_of_seconds' => 2,

    /*
     * This class is responsible for sending a response to request that
     * are detected as being spammy. By default a blank page is shown.
     *
     * A valid responder is any class that implements
     * `Spatie\Honeypot\SpamResponder\SpamResponder`
     */
    'respond_to_spam_with' => BlankPageResponder::class,

    /*
     * This switch determines if the honeypot protection should be activated.
     */
    'enabled' => true,
];
