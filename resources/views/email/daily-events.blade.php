<p>Dear {{ $user->firstName }},</p>

<p>Good morning! Here's what your day looks like:</p>

<p>----------</p>

@foreach ($familyEntryDetails as $details)

    <h3>{{ $details['family']->name }}</h3>

    @foreach ($details['events'] as $event)
        @if ($loop->first)
            <h4>Today's Events</h4>
            <ul>
        @endif

        @if ($event->isBirthday())
            <li>{{ \App\str_possessive($event->first_name) }} Birthday!</li>
        @else
            <li>{{ $event->title }} - {{ ($event->all_day) ? "All Day" : $event->time }}</li>
        @endif

        @if ($loop->last)
            </ul>
        @endif
    @endforeach

    @foreach ($details['overdueTodos'] as $todo)
        @if ($loop->first)
            <h4>Overdue To Dos</h4>
            <ul>
        @endif
            <li>{{ $todo->title }}</li>
        @if ($loop->last)
            </ul>
        @endif
    @endforeach

    @foreach ($details['dueTodayTodos'] as $todo)
        @if ($loop->first)
            <h4>Today's To Dos</h4>
            <ul>
        @endif
            <li>{{ $todo->title }}</li>
        @if ($loop->last)
            </ul>
        @endif
    @endforeach

    <p>----------</p>

@endforeach

<p>Enjoy your day!</p>

<p>{{ config('app.name') }} (the team)</p>

<p>P.S. Have something to tell us? Reply to this email and let us know what's on your mind!</p>
