@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - {{ $taskList->title }}
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.taskLists.css') }}" />
@endsection

@section('scripts')
{{--    <script src="{{ asset("js/family.taskLists.show.js") }}"></script>--}}
@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.taskLists.index', [$family]) => 'Task Lists',
        ],
        'location'   => $taskList->title,
    ])

    <div class="row">
        <div class="col">
            <h2 class="{{ (!$taskList->active) ? 'text-muted' : '' }}">
                {{ $taskList->title }}
                <a href="{{ route('family.taskLists.edit', [$family, $taskList]) }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-pencil-square-o"></span>
                    Edit
                </a>
            </h2>

            @if($taskList->dueDate)
                <p class="{{ ($taskList->isActive() && $taskList->isOverdue() && !$taskList->canBeArchived()) ? 'isOverdue' : '' }}">Due: <span class="dueDate">{{ Auth::user()->formatDate($taskList->dueDate) }}</span></p>
            @endif

            @if ($taskList->canBeArchived())
                <form method="POST" action="{{ route('family.taskList.archive', [$family, $taskList]) }}">

                    @csrf

                    <button type="submit" class="btn btn-info btn-sm">
                        <span class="fa fa-archive"></span>
                        Archive
                    </button>

                </form>
            @endif

            @if ($taskList->archived)
                <form method="POST" action="{{ route('family.taskList.restore', [$family, $taskList]) }}">

                    @csrf

                    <button type="submit" class="btn btn-light btn-sm">
                        <span class="fa fa-refresh"></span>
                        Restore
                    </button>

                </form>
            @endif

            <p>{!! nl2br(e($taskList->details)) !!}</p>

            <hr>

            <h4>Tasks ({{ $taskList->taskStats()['completed'] }} / {{ $taskList->taskStats()['total'] }})</h4>

            <a href="{{ route('family.tasks.create', [$family, $taskList]) }}" class="btn btn-sm btn-primary">
                <span class="fa fa-plus-circle"></span> Add Task
            </a>

            <div class="row mt-4">

                <div class="col-12 col-sm-10 offset-sm-1">

                    <div class="activeTasks" id="activeTasks">

                        <h4 class="sr-only">Active Tasks</h4>

                        @foreach ($taskList->activeTasks() as $task)

                            @include ('family.taskLists._task', ['task' => $task])

                        @endforeach

                    </div>

                    <hr>

                    <div class="completedTasks" id="completedTasks">

                        <h4 class="sr-only">Completed Tasks</h4>

                        @foreach ($taskList->completedTasks() as $task)

                            @include ('family.taskLists._task', ['task' => $task])

                        @endforeach

                    </div>

                    @if ($taskList->hasInactiveTasks())

                        <hr>

                        <div class="inactiveTasks" id="inactiveTasks">

                            <h4 class="sr-only">Inactive Tasks</h4>

                            @foreach ($taskList->inactiveTasks() as $task)

                                @include ('family.taskLists._task', ['task' => $task])

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>

@endsection
