<?php



return [

    // Page 1
    'introduction' => "The " . env('APP_NAME') . " Money Matters system is designed to provide your family some tools to gain and/or maintain control of your finances no matter what life throws at you.",

    'wizard-process' => "The next few screens will introduce you to the Money Matters components and walk you through setting up the system for your family. If you need to refer back to this information, it will be available in the " . __('application.page-menu') . ".",

    'navigation'         => 'Navigation',
    'navigation-details' => "You can access all the components of the Money Matters system from the navigation menu on the left. Click 'Settings' in the menu to show additional options that, while important to effectively using the system, shouldn't need to be accessed as often.",

    'overview'         => 'Money Matters',
    'overview-details' => "This overview screen will show your monthly spending habits, letting you see how effective your spending habits are over time. Here, you'll also be able to see how well you've been saving for life's biggest expenses along with a breakdown of your spending habits by category.",

    'cash-flow-plans-details' => "Cash flow plans are where you'll plan your family's monthly budget and track your expenses.
        As the month progresses, you'll get real-time insights into how well you're sticking to your plan, as well as how efficiently you're utilizing your discretionary budget. You'll be able to identify opportunities to save money each month and know where you are able to make changes to your plan when the unexpected happens.",

    'merchant-details' => "Merchants represent all the people and companies you do business with (everything from your favorite grocery store or gas station to the phone company and your DMV).
        The Merchants component lets you see your expenditures for each Merchant over time, allowing you to identify trends and helping to accurately forecast future expenses.",

    'piggy-bank-details' => "Piggy Banks represent savings goals your family wants to achieve, whether it's a new TV, a dream vacation, or a down payment on buying the home of your dreams.
        Enter them here, dedicate an amount of your income to them every month, and watch your dreams become a reality!",


    // Page 2
    'income-sources-details' => "To begin, let's gather some information on where your family's income comes from.
        While each family is different, reliable monthly income generally comes from salary/wages from employment or from running a business. If applicable, Income Sources would also include income from investment properties, retirement income, and annuities.
        The Income Sources you enter here will automatically populate to each month's Cash Flow Plan and will serve as the foundation for your family's budget for the month.",
    'income-sources-details-other-income' => "What you want to enter here are the reliable, monthly sources of income for your family that you can use to make a plan for all of your monthly expenses. One-time sources of income (from things like holding a yard sale) can be entered on each Cash Flow Plan.",
    'income-sources-prompt' => "Go ahead and enter the name of each of your family's monthly Income Source along with how much you expect to earn from each.
        For example, you might enter \"Acme Packing Company salary\" and \"" . \App\formatCurrency(3500, false) . "\" for your monthly salary, or \"Rental Income for 4th Ave. home\" and \"" . \App\formatCurrency(1200, false) . "\" for income from a rental property.",
    'income-sources-review-note' => "You'll be able to review and edit your Income Sources whenever you need to from the 'Settings' menu.",
    'income-sources-next' => "Once you've entered your Income Sources, go ahead and continue on to the next section.",


    // Page 3
    '' => "",

];
