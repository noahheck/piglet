<?php

$__app_name = config('app.name');

$__family_help_url = route('help', 'family');

$__family_members_homescreen_image = asset("img/help/family-members/family_members.png");

$__family_members_edit_image = asset("img/help/family-members/edit_family_member.png");

$__family_members_login_image = asset("img/help/family-members/family_member_login.png");

return [
    'family-members' => 'Family Members',
    'introduction' => <<<EOT
<p>Everything in {$__app_name} is focused on your family. All of the interactions for working with your family members are accessible from the Family Members option at the <a href="{$__family_help_url}" class="help-link">Family Home screen</a>.</p>
<div class="image-container">
    <img src="{$__family_members_homescreen_image}" alt="The family member home screen showing the members of the family with their names and photos.">
</div>
<p>Use the Add Family Member option from the Page Menu to add each member of your family to your account.</p>
EOT
    ,
    'family-member-details' => 'Family Member Details',
    'family-member-details-details' => <<<EOT
<p>We provide places to collect the normal things you'd expect (like name, gender, and date of birth) along with other identifying information (hair color, height, weight, birthmarks/tattoos/piercings). Feel free to enter as much of this information as you wish.</p>
<p>You can also choose to upload a photo for each family member that will be displayed when you are interacting with that person throughout the application.</p>
<p>You are also able to designate a color to distinguish family members from one another.</p>
<div class="image-container">
    <img src="{$__family_members_edit_image}" alt="The edit family member screen showing fields to collect the family member's name, birthdate, and gender as well as an input to upload a photo of that person.">
</div>
EOT
    ,
    'family-members-login' => 'Inviting Family Members To Login',
    'family-members-login-details' => <<<EOT
<p>Using the "Login" tab, you can invite the members of your family to log in to {$__app_name} in order to share the application tools and processes with you.</p>
<p>To invite them, simply check the box labeled "Allow this member to log in" and provide their email address. Once done, they'll receive an email invitation to create an account for {$__app_name} and join your family.</p>
<div class="image-container">
    <img src="{$__family_members_login_image}" alt="The edit family member screen showing the Login tab which will allow the family member to log into the application and interact with the family information.">
</div>
<p>If you need to prevent a previously invited family member from logging into your family, you can simply return to the "Login" tab and uncheck the "Allow this member to log in" and they will no longer be able to access your family information.</p>
<div class="note">
    <p>You are unable to uncheck the option to allow yourself to login. Doing so might lock you out of the application permanently.</p>
</div>
EOT
    ,


/*<p>The tools provided by {$__app_name} are designed to help keep a household organized. At the heart of the household is your family, so we make your family the heart of the application.</p>
<p>The structure of each family is different. Whether you're just getting started on your own in life, happily married, a single parent, or retired, we're sure you'll find the tools we create helpful for you.</p>*/
//    ,
    /*'setting-up' => 'Creating Your Family',
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
EOT*/

];
