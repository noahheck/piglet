@extends('layouts.app')

@section('title')
 - {{ $family->name }} Tasks - Create New
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
            route('family.taskLists.show', [$family, $taskList]) => $taskList->title,
        ],
        'location'   => 'Add New Task',
    ])

    <div class="row">
        <div class="col">
            <h2>
                Add new task
            </h2>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6">
            <h4>{{ $taskList->title }}</h4>

            @if ($taskList->dueDate)
                <p class="text-muted">{{ Auth::user()->formatDate($taskList->dueDate) }}</p>
            @endif

            <p>{{ $taskList->details }}</p>

        </div>

        @php
            $action = route('family.tasks.store', [$family, $taskList]);
            $method = false;
            $legend = 'New task details';
            $cancelRoute = route('family.taskLists.show', [$family, $taskList]);
        @endphp

        <div class="col-12 col-sm-6">

            <form action="{{ $action }}" method="POST" class="has-bold-labels">

                @csrf

                @if ($method)
                    @method($method)
                @endif

                <fieldset>
                    <legend>{{ $legend }}</legend>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $task->title) }}">
                        @fieldError('title')
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" class="form-control" placeholder="Details">{{ old('details', $task->details) }}</textarea>
                        @fieldError('details')
                    </div>

                    <div class="form-group">
                        <label for="dueDate">Due Date <small class="text-muted">mm/dd/yyyy</small></label>
                        <input type="text" name="dueDate" id="dueDate" class="form-control dateField" placeholder="Due Date" value="{{ old('dueDate', Auth::user()->formatDate($task->dueDate)) }}">
                        @fieldError('dueDate')
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="active" id="active" {{ ($task->active) ? ' checked' : '' }}>
                        <label for="active">Active</label>
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ $cancelRoute }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

    {{--@include('family.taskLists._form', [
        'legend'      => 'Details',
        'action'      => route('family.taskLists.store', [$family]),
        'method'      => false,
        'cancelRoute' => route('family.taskLists.index', [$family]),
    ])--}}

@endsection
