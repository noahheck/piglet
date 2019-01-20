<?php

$__app_name = config('app.name');

$__navigation_url = route('help', 'navigation');

$__family_homescreen_image = asset("img/help/family/home_screen.png");

$__current_cfp_image = asset("img/help/family/current_cfp.png");

return [
    'family' => 'Family',
    'introduction' => <<<EOT
<p>The tools provided by {$__app_name} are designed to help keep a household organized. At the heart of the household is your family, so we make your family the heart of the application.</p>
<p>The structure of each family is different. Whether you're just getting started on your own in life, happily married, a single parent, or retired, we're sure you'll find the tools we create helpful for you.</p>
EOT
    ,
    'setting-up' => 'Creating Your Family',
    'setting-up-details' => <<<EOT
<p>When you first create your family, you'll be able to provide your family name. You might prefer to use your family's actual name, or feel free to be clever and come up with something a little more eccentric. You an also upload a family photo to display on your family's home screen.</p>
<div class="image-container">
    <img src="{$__family_homescreen_image}" alt="The family home screen showing the family photo and the family's name">
</div>
<p>When it's time to upload a new family photo (or you come up with your new clever family nickname!), you can edit these details by clicking the "Edit Details" button at the bottom of the page (or by selecting the option from the page menu).</p>
<div class="note">
    <p>If you were invited to join the family by someone else, this was (probably) already done for you. You'll be able to edit the family details if you were given permission to.</p>
</div>
EOT
    ,
    'homescreen' => 'The Family Home Screen',
    'homescreen-details' => <<<EOT
<p>The Family Home Screen acts as the hub for all activity within {$__app_name}. From here, you're able to access the different tools available.</p>
<p>You can easily return to this screen at any time by selecting the "Home" option either from the main navigation bar or from the family navigation bar. See the <a href="{$__navigation_url}" class="help-link">Navigation</a> page for more details.</p>
EOT
    ,
    'current-cfp' => "Your Family's Current Cash Flow Plan",
    'current-cfp-details' => <<<EOT
<p>From the Family Home Screen, you also have access to see your family's progress toward the current month's Cash Flow Plan. Here, you can quickly see how much of your budget has been appropriated across all your expense categories.</p>
<p>Here, you're also able to easily add expenses to your expense groups throughout the month, which makes keeping your Cash Flow Plan up to date a breeze!</p> 
<div class="image-container">
    <img src="{$__current_cfp_image}" alt="A colorful graph showing the how much of the family's total income has been appropriated for the current month; also showing a listing of expense groups with a display of their individual appropriation progress with buttons for quickly adding expenses to each group.">
</div>
EOT

];
