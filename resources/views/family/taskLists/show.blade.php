@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - {{ $taskList->title }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.taskLists.css') }}" />
@endpush

@push('scripts')
{{--    <script src="{{ mix("js/family.taskLists.show.js") }}"></script>--}}
@endpush

@section('content')

    @php

        $menu = [];

        if ($taskList->canBeArchived()) {
            $menu[] = [
                'type' => 'form'  , 'href' => route('family.taskList.archive', [$family, $taskList]), 'icon' => 'fa fa-archive', 'text' => 'Archive', 'id' => 'archiveList'
            ];
        }

        if ($taskList->archived) {
            $menu[] = [
                'type' => 'form'  , 'href' => route('family.taskList.restore', [$family, $taskList]), 'icon' => 'fa fa-refresh', 'text' => 'Restore', 'id' => 'restoreList'
            ];
        }

        $menu[] = ['type' => 'link', 'href' => route('family.tasks.create', [$family, $taskList]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add Task'];
        $menu[] = ['type' => 'link', 'href' => route('family.taskLists.edit', [$family, $taskList]), 'icon' => 'fa fa-pencil-square-o', 'text' => 'Edit'];

    @endphp

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.taskLists.index', [$family]) => 'Task Lists',
        ],
        'location'   => $taskList->title,
        'menu' => $menu,
    ])

    <div class="row">
        <div class="col">
            <h2 class="{{ (!$taskList->active) ? 'text-muted' : '' }}">
                {{ $taskList->title }}
            </h2>

            @if($taskList->dueDate)
                <p class="{{ ($taskList->isActive() && $taskList->isOverdue() && !$taskList->canBeArchived()) ? 'isOverdue' : '' }}">Due: <span class="dueDate">{{ App\formatDate($taskList->dueDate) }}</span></p>
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
