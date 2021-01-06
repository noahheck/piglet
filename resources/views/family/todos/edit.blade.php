@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('todos.todos') }} - {{ $todo->title }} - {{ __('form.edit') }}
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
            route('family.todos.show', [$family, $todo]) => $todo->title,
        ],
        'location'   => __('form.edit'),
        'menu' => [
            ['type' => 'delete', 'href' => route('family.todos.destroy', [$family, $todo, 'return' => url()->previous()]), 'text' => __('form.delete') . ' ' . __('todos.todo')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.todos._form', [
                'action'      => route('family.todos.update', [$family, $todo]),
                'method'      => 'PUT',
                'cancelRoute' => old('return', url()->previous()),
            ])

        </div>

    </div>

@endsection
