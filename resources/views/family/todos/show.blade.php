@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('todos.todos') }} - {{ $todo->title }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.todos.index', [$family]) => __('todos.todos'),
        ],
        'location'   => $todo->title,
        'menu' => [
            ['type' => 'link', 'href' => route('family.todos.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('todos.add-new-todo')],
            ['type' => 'link', 'href' => route('family.todos.edit', [$family, $todo]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            <h2>{{ $todo->title }}</h2>

            <dl>
                <dt>{{ __('todos.due_date') }}</dt>
                <dd>{{ $todo->due_date }}</dd>

                <dt>{{ __('todos.created_by') }}</dt>
                <dd>{!! $todo->createdBy->icon(['mr-2']) !!} {{ $todo->createdBy->name }}</dd>
            </dl>

            <p>
                {!! nl2br(e($todo->details)) !!}
            </p>

        </div>

    </div>

@endsection
