<p>Dear {{ $user->firstName }},</p>

<p>Good morning! Here's what your day looks like:</p>

<p>----------</p>

@foreach ($familyEntryDetails as $details)

    @continue($details['events']->count() === 0)

    <h4>{{ $details['family']->name }}</h4>

    @foreach ($details['events'] as $event)
        @if ($event->isBirthday())
            <p>{{ \App\str_possessive($event->first_name) }} Birthday!</p>
        @else
            <p>{{ $event->title }} - {{ ($event->all_day) ? "All Day" : $event->time }}</p>
        @endif
    @endforeach

    <p>----------</p>

@endforeach

<p>Enjoy your day!</p>

<p>{{ config('app.name') }} (the team)</p>

<p>P.S. Have something to tell us? Reply to this email and let us know what's on your mind!</p>
