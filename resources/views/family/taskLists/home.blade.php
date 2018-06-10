@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.taskLists.css') }}" />
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => 'Task Lists',
    ])

    <div class="row">
        <div class="col">
            <h2>
                Task Lists
                <a href="{{ route('family.taskLists.create', [$family]) }}" class='btn btn-sm btn-primary'>
                    <span class="fa fa-plus-circle"></span> Add New
                </a>
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">

        @foreach($taskLists as $list)

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a class="card taskList {{ ($list->isOverdue()) ? 'isOverdue' : '' }}" href="{{ route('family.taskLists.show', [$family, $list]) }}">
                    <div class="card-body">
                        <h5 class='card-title'>{{ $list->title }}</h5>
                        <p class="dueDate">{{ Auth::user()->formatDate($list->dueDate) }}{{ ($list->isOverdue()) ? ' - Overdue' : '' }}</p>
                        <p class="taskStats">{{ $list->taskStats()['completed'] }} / {{ $list->taskStats()['total'] }}</p>
                    </div>
                </a>
            </div>

        @endforeach

    </div>

@endsection
