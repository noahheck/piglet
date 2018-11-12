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
    'lifestyle-expenses-details' => "Lifestyle expenses refer to the funds your family allocates to the things that make life worth living. After all, we're not here to simply pay bills before we die. Having a plan for the life you want to live now, and in the future, can be key to helping create a life of enjoyment and fulfillment.
        Often times, these things can seem either too far off and ambiguous, or approaching too soon and unattainable. What's important is that you make sure to prioritize these items in your monthly budget.
        Your family should also reevaluate these items as situations in life change. For example, if you're focused on paying off debt, you might prefer to enter a smaller amount for each category now, then increase your contributions to each after you've eliminated that debt.",
    'lifestyle-expenses-advisor-note' => "Working with a financial advisor is a great way to identify different strategies for how to fund these items.",
    'lifestyle-expenses-prompt' => "Go ahead and fill in an appropriate default amount for each Lifestyle Expense below.",
    'lifestyle-expenses-review-note' => "You'll be able to review and edit your Lifestyle Expense amounts later from the 'Settings' menu.",
    'lifestyle-expenses-next' => "Once you've entered your Lifestyle Expenses, go ahead and continue on to the next section.",

    // Page 4
    'recurring-expenses-details' => "Death, taxes, and bills. All families have expenses they're responsible for each month: rent/mortgage payments, electricity, gas, cable, vehicle payments, insurance, the list could go on.
        And let's face it, nobody likes paying the bills. It's stressful, things get lost in the mail, it's time consuming, and just flat out no fun watching your hard earned money walk out the door each month.
        The good news is that if we make a plan each month for how we're going to address all of these things, the process of paying the bills can become much less stressful with fewer surprises and less doom and gloom. You'll know ahead of time where your money is going, so saying goodbye to it doesn't taste so sour.",
    'recurring-expenses-prompt' => "Fill in the name of the merchant you send each of the following monthly bills to, along with how much your family expects to pay each month. These items will automatically fill in on each month's Cash Flow Plan, so you can see ahead of time where your money is going.",
    'recurring-expenses-prompt-note' => "If any of these items doesn't apply to your family, simply leave them blank and they won't appear on your Cash Flow Plan.
        In addition, if you make one payment for more than one category below (such as paying one bill for both your Internet and television service), choose just one category to fill in with the merchant and the total for both categories.",
    'recurring-expenses-review-note' => "It would be impossible for us to list all of the monthly expenses for every family, so has been just a starter set that should apply to most families. If your family has additional monthly expenses, you'll want to make sure to enter them as well.
        You'll be able to review and edit your Recurring Expenses later from the 'Settings' menu.",
    'recurring-expenses-next' => "Once you've entered your Recurring Expenses, go ahead and continue on to the next section.",

    'recurring-expenses-housing'  => 'Housing',
    'recurring-expenses-mortgage' => 'Mortgage',
    'recurring-expenses-rent'     => 'Rent',
    'recurring-expenses-hoa'      => 'HOA Dues',

    'recurring-expenses-utilities'   => 'Utilities',
    'recurring-expenses-electricity' => "Electricity",
    'recurring-expenses-gas'         => "Gas",
    'recurring-expenses-water'       => "Water",
    'recurring-expenses-phone'       => "Phone",
    'recurring-expenses-cable'       => "Cable",
    'recurring-expenses-internet'    => "Internet",

    'recurring-expenses-transportation' => "Transportation",
    'recurring-expenses-bus'            => "Bus Pass",
    'recurring-expenses-car1'           => "Car Payment",
    'recurring-expenses-car2'           => "Car Payment",

    'recurring-expenses-insurance'  => "Insurance",
    'recurring-expenses-medical'    => "Medical",
    'recurring-expenses-dental'     => "Dental",
    'recurring-expenses-vision'     => "Vision",
    'recurring-expenses-life'       => "Life",
    'recurring-expenses-automobile' => "Automobile",

    // Page 5
    'expense-groups-details' => "Much of the rest of the expenses our families have each month can be combined together to be managed as a group, rather than as individual transactions. This gives us the benefit of having manageable line items on our budget while at the same time providing the freedom to use those funds how we see fit.
        Also, because life generally seems to happen when we're alive, unforeseen things come up in during the month no matter how hard we try to budget for everything. Car batteries mysteriously die, your child's new best friend (who you had never heard of before) is having a birthday party that just has to be attended, or your crazy cousin is visiting from out of town and you get volunteered to do the entertaining.
        That's why it's a good idea to provide a little wiggle room in your budget each month. Allocate a small amount each month for the things that always just seem to 'Come Up'.",
    'expense-groups-prompt'  => "Go ahead and fill in the appropriate amounts your family typically allocates to each of the following expense groups each month.
        Also, for each expense group, go ahead and enter a couple of your family's favorite places to spend that part of your budget.",

    'expense-groups-review-note' => "You'll be able to review and edit your Expense Groups later from the 'Settings' menu.",
    'expense-groups-next' => "Once you've entered your Expense Groups, go ahead and continue on to the next section.",

    'expense-groups-food'           => "Food",
    'expense-groups-food-details'   => "Delicious and (hopefully) Nutritious",
    'expense-groups-grocers'        => "Grocery Stores",
    'expense-groups-add-grocer'     => "Add New Grocery Store",
    'expense-groups-restaurants'    => "Restaurants",
    'expense-groups-add-restaurant' => "Add New Restaurant",

    'expense-groups-gas'            => "Fuel",
    'expense-groups-gas-details'    => "To take you on all your adventures (even if that's just to the office)",
    'expense-groups-gasstations'    => "Gas Stations",
    'expense-groups-add-gasstation' => "Add New Gas Station",

    'expense-groups-household'             => "Household",
    'expense-groups-household-details'     => "Cleaning supplies, laundry detergent, and everything that keeps you going",
    'expense-groups-householdsuppliers'    => "Homegoods Store",
    'expense-groups-add-householdsupplier' => "Add New Homegoods Store",

    'expense-groups-stuff'         => "Stuff That Comes Up",
    'expense-groups-stuff-details' => "Because Life Happens When You Go On Living",



];
