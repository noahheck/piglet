@extends('layouts.app')

@section('title')
 - {{ $family->name }} Tasks - Edit Task
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />--}}
@endpush

@push('scripts')
    <script src="{{ mix("js/family.tasks._form.js") }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.taskLists.index', [$family]) => 'Task Lists',
            route('family.taskLists.show', [$family, $taskList]) => $taskList->title,
        ],
        'location'   => 'Edit Task',
        'menu' => [
            ['type' => 'delete', 'href' => route('family.tasks.destroy', [$family, $taskList, $task]), 'text' => 'Delete Task'],
        ]
    ])

    <div class="row">
        <div class="col">
            <h2>
                Edit task
            </h2>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6">
            <h4>{{ $taskList->title }}</h4>

            @if ($taskList->dueDate)
                <p class="text-muted">{{ App\formatDate($taskList->dueDate) }}</p>
            @endif

            <p>{!! nl2br(e($taskList->details)) !!}</p>

        </div>

        <div class="col-12 col-sm-6">

            @include('family.tasks._form', [
                'legend'       => 'Edit task details',
                'action'       => route('family.tasks.update', [$family, $taskList, $task]),
                'method'       => 'PUT',
                'cancelRoute'  => route('family.taskLists.show', [$family, $taskList]),
                'showComplete' => true,
            ])

        </div>

    </div>


@endsection
