@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists - Create New
@endsection

@section('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/home.css') }}" />--}}
@endsection

@section('scripts')
    <script src="{{ asset("js/family.taskLists._form.js") }}"></script>
@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.taskLists.index', [$family]) => 'Task Lists',
            route('family.taskLists.show', [$family, $taskList]) => $taskList->title,
        ],
        'location'   => __('form.edit'),
    ])

    <div class="row">
        <div class="col">
            <h2>
                {{ $taskList->title }}
            </h2>
        </div>
    </div>

    @include('family.taskLists._form', [
        'legend'      => 'Edit Details',
        'action'      => route('family.taskLists.update', [$family, $taskList]),
        'method'      => 'PUT',
        'cancelRoute' => route('family.taskLists.show', [$family, $taskList]),
        'showDelete'  => true,
    ])

@endsection
