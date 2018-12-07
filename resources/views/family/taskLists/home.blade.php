@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.taskLists.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix("js/family.taskLists.home.js") }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => 'Task Lists',
        'menu' => [
            ['type' => 'link'  , 'href' => route('family.taskLists.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New'],
        ]
    ])

    <div class="row">
        <div class="col">
            <h2>
                Task Lists
            </h2>
        </div>
    </div>

    @if ($taskLists->count() > 0)

        <h3>Active Task Lists</h3>

        <div class="row justify-content-center">

            @foreach($taskLists as $list)

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a class="card taskList {{ ($list->isOverdue()) ? 'isOverdue' : '' }} {{ ($list->isDueToday()) ? 'isDueToday' : '' }}" href="{{ route('family.taskLists.show', [$family, $list]) }}">
                        <div class="card-body">
                            <h5 class='card-title'>{{ $list->title }}</h5>
                            <p class="dueDate">{{ App\formatDate($list->dueDate) }}{{ ($list->isOverdue()) ? ' - Overdue' : '' }}</p>
                            <p class="taskStats">{{ $list->taskStats()['completed'] }} / {{ $list->taskStats()['total'] }}</p>
                        </div>
                    </a>
                </div>

            @endforeach

        </div>

    @endif

    @if ($inactiveAndArchived->count() > 0)

        <h4 class="mt-5">
            Inactive / Archived Task Lists

            <button type="button" class="btn btn-sm btn-light" id="showInactiveListsButton">
                Show Inactive / Archived Lists
            </button>
        </h4>

        <div class="row justify-content-center d-none" id="inactiveTaskLists">

            @foreach ($inactiveAndArchived as $list)

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a class="card inactiveTaskList" href="{{ route('family.taskLists.show', [$family, $list]) }}">
                        <div class="card-body">
                            <h5 class='card-title'>
                                <span class="fa {{ ($list->archived) ? 'fa-check-square-o' : 'fa-minus-square-o' }}"></span>
                                {{ $list->title }}
                            </h5>
                        </div>
                    </a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
