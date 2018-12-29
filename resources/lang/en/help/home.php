<?php

$__app_name = config('app.name');

$__navigation_url = route('help', 'navigation');
$__family_url     = route('help', 'family');

return [
    'welcome'  => 'Welcome to the ' . $__app_name . ' Help documentation!',
    'overview' => <<<EOT
<p>These pages are designed to help you learn about the various tools available in the {$__app_name} application. If you have any questions about how a tool is intended to be used, chances are pretty good that you'll find your answer here!</p>
<p>Use the menu to navigate to the topic you're interested in learning about.</p>

<div class="tip">
    <p>You can access the help documentation for many pages in the application without leaving your current view by accessing the 'Help' option from the Page Menu.</p>
    <p>Find out more on the <a href="{$__navigation_url}">Navigation</a> page!</p>
</div>

EOT
    ,
    'getting-started' => <<<EOT
<p>If you're new to {$__app_name}, here are some quick links to help you get up and going quickly:</p>
<ul>
    <li><a href="{$__navigation_url}">Navigation</a> - Learn how the interface is structured to help you move around the application easily</li>
    <li><a href="{$__family_url}">Family</a> - Learn how the application is organized around your family as well as how to set up your family</li>
</ul>
EOT
    ,

];
