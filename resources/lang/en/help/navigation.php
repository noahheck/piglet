<?php

$__app_name = config('app.name');

return [
    'navigation' => 'Navigation',
    'main-navigation' => 'Top-level Navigation',
    'main-navigation-details' => <<<EOT
<p>Along the top of the screen, you'll find the main navigation bar. From here, you are able to access various areas of the application:</p>
<ol>
    <li>The {$__app_name} Homepage, Pricing, and Project information</li>
    <li>The Family home screen - you can return to your family's home screen at any time from here</li>
    <li>The User options menu - here, you can access your account settings, review the privacy policy and terms of use, view the application help system, or log out of the application</li>
</ol>
EOT
    ,
    'family-navigation' => 'Navigating within the Family application',
    'family-navigation-details' => <<<EOT
<p>The family navigation bar shows your current location within the suite of application tools, along with quick links back to each page you've visited to get to your current location.</p>
<p>Most pages also present a dropdown menu providing options for interacting with the current page (for example, if you're looking at a merchant, the page menu will provide an option for editing that merchant).</p>
<p>You'll also be able to access the help documentation for the current page from the page menu.</p>
EOT
    ,
];
