Dear {{ $user->firstName }},

Good morning! Here's what your day looks like:

----------

@foreach ($familyEntryDetails as $details)

    @continue($details['events']->count() === 0)

    {{ $details['family']->name }}

    @foreach ($details['events'] as $event)
        {{ $event->title }} - {{ ($event->all_day) ? "All Day" : $event->time }}
    @endforeach

    ----------

@endforeach

Enjoy your day!

{{ config('app.name') }} (the team)

P.S. Have something to tell us? Reply to this email and let us know what's on your mind!
