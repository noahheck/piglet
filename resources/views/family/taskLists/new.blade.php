@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - Create New
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />--}}
@endpush

@push('scripts')
    <script src="{{ mix("js/family.taskLists._form.js") }}"></script>
@endpush

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

    @include('family.taskLists._form', [
        'legend'      => 'Details',
        'action'      => route('family.taskLists.store', [$family]),
        'method'      => false,
        'cancelRoute' => route('family.taskLists.index', [$family]),
        'showDelete'  => false,
    ])

@endsection
