<?php

return [
    'welcome-to-appName' => 'Welcome to ' . config('app.name') . '!',
    'hook'               => 'Tools to keep your family organized so your energy can be spent on loving your life!',
    'ready-to-start'     => 'Ready to get started?',
    'sign-up-now'        => 'Sign Up Now',


    'project'                  => 'Project',
    'pricing'                  => 'Pricing',
    'greatest-hope-offer-free' => "Our greatest hope is that your family will find the software we write useful to you. With that in mind, the " . config('app.name') . " service is proud to be offered at no cost to you and your family.",
    'more-info-pricing'        => "Find out more about how (and why) we're able to offer the service for free on the <a href='" . route('pricing')  . "'>Pricing</a> page.",
    'pricing-features' => [
        'budgeting-tools'    => 'Budgeting Tools',
        'cash-flow-planning' => 'Cash Flow Planning',
        'expense-tracking'   => 'Expense Tracking',
        'savings-goal-tracking' => 'Savings Goal Tracking',
    ],


    'features' => 'Features',


    'money-matters' => 'Money Matters',
    'money-matters-features' => [
        'organize'      => 'Organize',
        'organize-desc' => "All your family's money habits together",
        'plan'          => 'Plan',
        'plan-desc'     => "Put your family's financial plan in place",
        'track'         => 'Track',
        'track-desc'    => 'Track your progress and make your plan work',
        'save'          => 'Save',
        'save-desc'     => "Save for and meet your family's financial goals",
    ],


    // Pricing page
    'pricing-hook'             => 'Clear, transparent, and no nonsense',

    'pricing-faqs' => [
        'really-free'   => 'Is it really free?',
        'really-free-a' => 'Yes!',

        'why'   => 'Why?',
        'why-a' => "The goal of this project was never to make money. Head on over to the <a href='" . route('project') . "'>Project</a> page to find out what some of our goals are with this project.",

        'why-pricing-page'   => 'Why did you make this pricing page then?',
        'why-pricing-page-a' => "To make sure there wouldn't be any questions about what costs may or may not arise from using " . config('app.name') . ".",

        'operation-costs'   => "What about server costs and maintenance? Don't those things cost money?",
        'operation-costs-a' => 'Certainly! The project has, however, been able to keep those costs to a minimum.',

        'ever-cost'   => 'Will there ever be a cost to use ' . config('app.name') . '?',
        'ever-cost-a' => "There will always be a free, hosted version of " . config('app.name') . ". If the world changes such that it's not possible to offer all of the features of " . config('app.name') . " without cost, all the functionality available for free up to that time will continue to be offered to existing users at no cost.
                    <br>
                    The source code for the project will forever be free and open source, so you will always be able to host the service on your own server and avoid any potential future costs (<a href='" . config('piglet.url') . "' target='_blank'>" . config('piglet.url') . "</a>).",

        'pretty-cool'   => "That's pretty cool! Thanks for doing this!",
        'pretty-cool-a' => 'Thanks! We think so, and hope the software we create is helpful to you and your family.',
    ],


    // Project page
    'project-hook' => 'What this is all about',
    'project-intro' => config('app.name') . " is a collection of tools designed to help families keep their activities organized so they can enjoy as much of life as possible.
                <br>
                These tools are created to help our family achieve our goals, and we feel that if they're able to help us, we should provide them to other families to help them achieve theirs as well.
                <br>
                " . config('app.name') . " is proud to provide a free implementation of the open-source <a href='" . config('piglet.url') . "' target='_blank'>Piglet project</a>.",

    'project-money-matters' => "In August of 2018, we celebrated our 10 year wedding anniversary. At dinner, I asked my wife what one thing she would change about our life together to that point, to which she quickly responded that she wished we had started working a budget together much sooner in our marriage.
                        <br>
                        The budgeting tools provided in " . config('app.name') . " represent the culmination of the different tools we've used to track our expenses for nearly a decade. Our first budgeting tool was just a simple spreadsheet, but having a system in place for us to easily review our expenses and forecast for the future proved to be invaluable.
                        <br>
                        Using our current set of tools has allowed us to have a great deal of insight into how we are putting our money to use every month, and keeping the communication around money open has removed so many stressors from our marriage.",

    'project-faqs' => [
        'really-free'   => 'Is it really free?',
        'really-free-a' => "<a href='" . route('pricing') . "'>Yes!</a>",

        'open-source-mean'   => 'What does open-source mean?',
        'open-source-mean-a' => "<a href='https://en.wikipedia.org/wiki/Open-source_software' target='_blank'>Open-source</a> means the source code for the application is available for other people to read, study, learn from, and improve. The source code for " . config('app.name') . " is <a href='" .  config('piglet.url') . "' target='_blank'>available online</a>. Please feel free to take a look!",

        'why-open-source'   => "Why is " . config('app.name') . " open source?",
        'why-open-source-a' => "There are many reasons. Most importantly, we wanted " . config('app.name') . " to help families achieve their goals, and we know we can't do that if you don't trust us with your information.
                    <br>
                    Having our source code available online, we can, for example, point you to <a href='https://github.com/noahheck/piglet/blob/master/app/Http/Middleware/VerifyFamilyAccess.php#L36' target='_blank'>this line of code</a> to show how we keep your data safe from unauthorized access.
                    <small class='text-muted'>(That line of code prevents the application from executing a request if the user making the request isn't listed as a member of your family; if you see any problems with how that's done, let us know and we'll get it fixed!)</small>",

        'why-name'   => "Why do you call it " . config('app.name') . "?",
        'why-name-a' => "There are only <a href='https://martinfowler.com/bliki/TwoHardThings.html' target='_blank'>two hard things in computer science</a>: cache invalidation and naming things. When we finally decide on a name we love, we have to make enough concessions about that name to be happy with a unique domain name we can afford (this is why we have services with <a href='https://www.fastcompany.com/3014582/why-startups-have-such-stupid-names' target='_blank'>really silly names</a>).
                    <br>
                    We feel lucky that we could get the rights to " . config('app.url') . " as a set of real words that convey what we are going for. We're glad you like it :)",

        'why-name-piglet'   => 'Why do you call it Piglet?',
        'why-name-piglet-a' => "Naming things is hard (see above). The night we <a href='https://github.com/noahheck/piglet/commit/e6617da9536fb2910733192e31598c2272ca60d4' target='_blank'>started this project</a>, while I was tucking my 7-year old into bed, I asked her what she thought the name of the project should be (she didn't quite understand why it was inappropriate to name it Microsoft Family). We tried to come up with a suitable code name for several minutes, but couldn't come up with anything.
                    <br>
                    Right when I was about to give up, my 2-year old son came to say goodnight to his sister. He asked me to hold his little stuffed pig toy while he gave his sister a hug, and that's where the name comes from.",

        'really-faqs'   => 'Are these really the Frequently Asked Questions?',
        'really-faqs-a' => "No. These are questions I want to answer right now before the service is even put online. They are part of the story and I enjoy telling it.
                    <br>
                    When I get my first question about the service, I'll put it here and answer it.",
    ],
];
