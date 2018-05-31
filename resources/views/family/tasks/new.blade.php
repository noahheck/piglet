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

            <p>{!! nl2br(e($taskList->details)) !!}</p>

        </div>

        <div class="col-12 col-sm-6">

            @include('family.tasks._form', [
                'legend'      => 'New task details',
                'action'      => route('family.tasks.store', [$family, $taskList]),
                'method'      => false,
                'cancelRoute' => route('family.taskLists.show', [$family, $taskList]),
            ])

        </div>

    </div>

@endsection