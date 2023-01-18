<p>Dear {{ $user->firstName }},</p>

<p>Good morning! Here's what your day looks like:</p>

<p>----------</p>

@foreach ($familyEntryDetails as $details)

    <h3>
        <a href="{{ route("family.home", [$details['family']]) }}">
            {{ $details['family']->name }}
        </a>
    </h3>

    @foreach ($details['events'] as $event)
        @if ($loop->first)
            <h4>Today's Events</h4>
            <ul>
        @endif

        @if ($event->isBirthday())
            <li>
                <a href="{{ $event->url }}">
                    {{ \App\str_possessive($event->first_name) }} Birthday!
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('family.events.show', [$details['family'], $event]) }}">
                    {{ $event->title }} - {{ ($event->all_day) ? "All Day" : $event->time }}
                </a>
            </li>
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
            <li>
                <a href="{{ route('family.todos.show', [$details['family'], $todo]) }}">
                    {{ $todo->title }}
                </a>
            </li>
        @if ($loop->last)
            </ul>
        @endif
    @endforeach

    @foreach ($details['dueTodayTodos'] as $todo)
        @if ($loop->first)
            <h4>Today's To Dos</h4>
            <ul>
        @endif
            <li>
                <a href="{{ route('family.todos.show', [$details['family'], $todo]) }}">
                    {{ $todo->title }}
                </a>
            </li>
        @if ($loop->last)
            </ul>
        @endif
    @endforeach

    <p>----------</p>

@endforeach

<p>Enjoy your day!</p>

<p>{{ config('app.name') }} (the team)</p>

<p>P.S. Have something to tell us? Reply to this email and let us know what's on your mind!</p>
