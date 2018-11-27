@extends('layouts.marketing')

@section('marketing')

    <div class="text-center">

        <h1>Project</h1>
        <h3 class="text-muted">What this is all about</h3>

        <hr>

    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 project-details">

            <p class="text-center">
                <span class="fa-stack fa-3x">
                    <span class="fa fa-circle fa-stack-2x color-red"></span>
                    <span class="fa fa-heart fa-stack-1x color-white"></span>
                </span>
            </p>

            <p>
                {{ config('app.name') }} is a collection of tools designed to help families keep their activities organized so they can enjoy as much of life as possible.
                <br>
                These tools are created to help our family achieve our goals, and we feel that if they're able to help us, we should provide them to other families to help them achieve theirs as well.
                <br>
                {{ config('app.name') }} is proud to provide a free implementation of the open-source <a href="{{ config('piglet.url') }}" target="_blank">Piglet project</a>.
            </p>

            <div class="card shadow">

                <div class="card-body">
                    <h3 class="text-centssser">
                        <span class="fa-stack fa-1x">
                            <span class="fa fa-circle fa-stack-2x color-green"></span>
                            <span class="fa fa-usd fa-stack-1x color-white"></span>
                        </span>
                        Money Matters
                    </h3>

                    <p>
                        In August of 2018, we celebrated our 10 year wedding anniversary. At dinner, I asked my wife what one thing she would change about our life together to that point, to which she quickly responded that she wished we had started working a budget together much sooner in our marriage.
                        <br>
                        The budgeting tools provided in {{ config('app.name') }} represent the culmination of the different tools we've used to track our expenses for nearly a decade. Our first budgeting tool was just a simple spreadsheet, but having a system in place for us to easily review our expenses and forecast for the future proved to be invaluable.
                        <br>
                        Using our current set of tools has allowed us to have a great deal of insight into how we are putting our money to use every month, and keeping the communication around money open has removed so many stressors from our marriage.
                    </p>
                </div>

            </div>

        </div>

        <div class="col-12 col-md-10 project-faqs">

            <hr>

            <h3>Project FAQs</h3>

            <dl>

                <dt>Is it really free?</dt>
                <dd>
                    <a href="{{ route('pricing') }}">Yes!</a>
                </dd>

                <dt>What does open-source mean?</dt>
                <dd>
                    <a href="https://en.wikipedia.org/wiki/Open-source_software" target="_blank">Open-source</a> means the source code for the application is available for other people to read, study, learn from, and improve. The source code for {{ config('app.name') }} is <a href="{{ config('piglet.url') }}" target="_blank">available online</a>. Please feel free to take a look!
                </dd>

                <dt>Why is {{ config('app.name') }} open source?</dt>
                <dd>
                    There are many reasons. Most importantly, we wanted {{ config('app.name') }} to help families achieve their goals, and we know we can't do that if you don't trust us with your information.
                    <br>
                    Having our source code available online, we can, for example, point you to <a href="https://github.com/noahheck/piglet/blob/master/app/Http/Middleware/VerifyFamilyAccess.php#L29" target="_blank">this line of code</a> to show how we keep your data safe from unauthorized access.
                    <small class="text-muted">(That line of code prevents the application from executing a request if the user making the request isn't listed as a member of your family; if you see any problems with how that's done, let us know and we'll get it fixed!)</small>
                </dd>

                <dt>Why do you call it {{ config('app.name') }}?</dt>
                <dd>
                    There are only <a href="https://martinfowler.com/bliki/TwoHardThings.html" target="_blank">two hard things in computer science</a>: cache invalidation and naming things. When we finally decide on a name we love, we have to make enough concessions about that name to be happy with a unique domain name we can afford (this is why we have services with <a href="https://www.fastcompany.com/3014582/why-startups-have-such-stupid-names" target="_blank">really silly names</a>).
                    <br>
                    We feel lucky that we could get the rights to {{ config('app.url') }} as a set of real words that convey what we are going for. We're glad you like it :)

                </dd>

                <dt>Why do you call it Piglet?</dt>
                <dd>
                    Naming things is hard (see above). The night we <a href="https://github.com/noahheck/piglet/commit/e6617da9536fb2910733192e31598c2272ca60d4" target="_blank">started this project</a>, while I was tucking my 7-year old into bed, I asked her what she thought the name of the project should be (she didn't quite understand why it was inappropriate to name it Microsoft Family). We tried to come up with a suitable code name for several minutes, but couldn't come up with anything.
                    <br>
                    Right when I was about to give up, my 2-year old son came to say goodnight to his sister. He asked me to hold his little stuffed pig toy while he gave his sister a hug, and that's where the name comes from.
                </dd>

                <dt>Are these really the Frequently Asked Questions?</dt>
                <dd>
                    No. These are questions I want to answer right now before the service is even put online. They are part of the story and I enjoy telling it.
                    <br>
                    When I get my first question about the service, I'll put it here and answer it.
                </dd>

            </dl>

        </div>

    </div>

@endsection
