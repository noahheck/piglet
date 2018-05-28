@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - {{ $taskList->title }}
@endsection

@section('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/home.css') }}" />--}}
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
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
                <p>Due {{ Auth::user()->formatDate($taskList->dueDate) }}</p>
            @endif

            <p>{!! nl2br(e($taskList->details)) !!}</p>

            <hr style="width: 75%;">

            <h5>
                <a href="{{ route('family.tasks.create', [$family, $taskList]) }}">
                    <span class="fa fa-plus-circle"></span> Add Task
                </a>
            </h5>

            @foreach ($taskList->tasks as $task)

                <p>
                    <input type="checkbox">
                    <a href="{{ route('family.tasks.edit', [$family, $taskList, $task]) }}">
                        {{ $task->title }}
                    </a>
                    @if ($task->dueDate)
                        <small class="text-muted">{{ Auth::user()->formatDate($task->dueDate) }}</small>
                    @endif

                    @if ($task->member)
                        {!! $task->member->icon() !!}
                    @endif
                </p>

            @endforeach

        </div>
    </div>

@endsection
