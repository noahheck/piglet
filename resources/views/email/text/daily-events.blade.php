Dear {{ $user->firstName }},

Good morning! Here's what your day looks like:

----------

@foreach ($familyEntryDetails as $details)

    {{ $details['family']->name }}

    @foreach ($details['events'] as $event)
        @if ($loop->first)
            Today's Events
        @endif
        @if ($event->isBirthday())
            {{ \App\str_possessive($event->first_name) }} Birthday!
        @else
            {{ $event->title }} - {{ ($event->all_day) ? "All Day" : $event->time }}
        @endif
    @endforeach

    @foreach ($details['overdueTodos'] as $todo)
        @if ($loop->first)
            Overdue To Dos
        @endif
        - {{ $todo->title }}

    @endforeach

    @foreach ($details['dueTodayTodos'] as $todo)
        @if ($loop->first)
            Today's To Dos
        @endif
        - {{ $todo->title }}
    @endforeach

    ----------

@endforeach

Enjoy your day!

{{ config('app.name') }} (the team)

P.S. Have something to tell us? Reply to this email and let us know what's on your mind!
