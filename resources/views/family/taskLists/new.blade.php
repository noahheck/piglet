@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - Create New
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
        'location'   => 'Add New',
    ])

    <div class="row">
        <div class="col">
            <h2>
                Add new task list
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-6">

            <form action="{{ route('family.taskLists.store', [$family]) }}" method="POST" class="has-bold-labels">

                @csrf

                {{--@if ($method)
                    @method($method)
                @endif--}}

                <fieldset>
                    <legend>Details</legend>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $taskList->title) }}">
                        @fieldError('title')
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" class="form-control" placeholder="Details">{{ old('details', $taskList->details) }}</textarea>
                        @fieldError('details')
                    </div>

                    <div class="form-group">
                        <label for="dueDate">Due Date <small class="text-muted">mm/dd/yyyy</small></label>
                        <input type="text" name="dueDate" id="dueDate" class="form-control dateField" placeholder="Due Date" value="{{ old('dueDate', Auth::user()->formatDate($taskList->dueDate)) }}">
                        @fieldError('dueDate')
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="active" id="active" {{ ($taskList->active) ? ' checked' : '' }}>
                        <label for="active">Active</label>
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ route('family.taskLists.index', [$family]) }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

@endsection
