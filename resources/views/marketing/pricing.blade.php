@extends('layouts.marketing')

@section('marketing')

    <div class="text-center">

        <h1>Pricing</h1>
        <h3 class="text-muted">Clear, transparent, and no nonsense</h3>

        <hr>

    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">

            <div class="card border-0 shadow">

                <div class="card-body color-white bg-red text-center">

                    <h4 class="card-title text-center">
                        <span class="fa fa-dollar"></span>
                        Pricing
                    </h4>

                </div>

                <div class="card-body">

                    <p class="display-2 text-center">
                        $0
                    </p>

                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="fa fa-check color-green"></span> Budgeting Tools</li>
                    <li class="list-group-item"><span class="fa fa-check color-green"></span> Cash Flow Planning</li>
                    <li class="list-group-item"><span class="fa fa-check color-green"></span> Expense Tracking</li>
                    <li class="list-group-item"><span class="fa fa-check color-green"></span> Savings Goal Tracking</li>
                </ul>

            </div>

        </div>

        <div class="col-12 col-md-10 pricing-faqs">

            <hr>

            <h3>Pricing FAQs</h3>

            <dl>

                <dt>Is it really free?</dt>
                <dd>Yes!</dd>

                <dt>Why?</dt>
                <dd>The goal of this project was never to make money. Head on over to the <a href="{{ route('project') }}">Project</a> page to find out what some of our goals are with this project.</dd>

                <dt>Why did you make this pricing page then?</dt>
                <dd>To make sure there wouldn't be any questions about what costs may or may not arise from using {{ config('app.name') }}.</dd>

                <dt>What about server costs and maintenance? Don't those things cost money?</dt>
                <dd>Certainly! The project has, however, been able to keep those costs to a minimum.</dd>

                <dt>Will there ever be a cost to use {{ config('app.name') }}?</dt>
                <dd>
                    There will always be a free, hosted version of {{ config('app.name') }}. If the world changes such that it's not possible to offer all of the features of {{ config('app.name') }} without cost, all the functionality available for free up to that time will continue to be offered to existing users at no cost.
                    <br>
                    The source code for the project will forever be free and open source, so you will always be able to host the service on your own server and avoid any potential future costs (<a href="{{ config('piglet.url') }}" target="_blank">{{ config('piglet.url') }}</a>).
                </dd>

                <dt>That's pretty cool! Thanks for doing this!</dt>
                <dd>
                    Thanks! We think so, and hope the software we create is helpful to you and your family.
                </dd>

            </dl>

        </div>

    </div>

@endsection
